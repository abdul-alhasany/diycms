<?php
/*
+===============================================================================+
|      					DIY-CMS V1.1 Copyright © 2011   						|
|   	--------------------------------------------------------------   		|
|                    				BY                    						|
|              				ABDUL KAHHAR AL-HASANY            					|
|   																	   		|
|      					Web: http://www.diy-cms.com      						|
|   	--------------------------------------------------------------   		|
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR	|
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,		|
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE	|
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER		|
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING		|
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS	|
* IN THE SOFTWARE.																|
+===============================================================================+
*/
 
 
 include("modules/" . $mod->module . "/settings.php");
 include("includes/upload.class.php");
 
 $blogid = set_id_int('blogid');
 
 $global_edit_perm   = $mod->setting('edit_all_posts', $_COOKIE['cgroup']);
 $user_edit_perm     = $mod->setting('edit_own_post', $_COOKIE['cgroup']);
 $approve_posts_perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);
 
 $post_detailes = $diy_db->query("SELECT * FROM diy_blogs where blog_id='$blogid' order by blog_id");
 $row           = $diy_db->dbarray($post_detailes);
 
 $maximum_edit_time	= get_group_setting('maximum_post_edit_time');
 $edit_time = check_edit_time($row['date_added'],$maximum_edit_time);
 
 if (($global_edit_perm == '') && (($user_edit_perm == '') || ($edit_time !='1')))
   {
     error_message($lang['EDITPOST_EDIT_NOT_ALLOWED']);
   }
 
 $maximum_letters = get_group_setting('maximum_posts_letters');
 $editor_type     = get_group_setting('editor_type');
 
 $index_middle = $mod->nav_bar($lang['EDITPOST_POST_HEAD']);
 
 if ($_POST['submit']) 
   { 


     extract($_POST);
     $fullarr = array(
         $title,
         $post
     );
     
     if (!required_entries($fullarr))
       {
         error_message($lang['LANG_ERROR_VALIDATE']);
       }
     
     
     if (!maximum_allowed($post, $maximum_letters))
       {
         error_message($error_mxs);
       }
     
$upload = new handle_upload_files;
	  $upload->check_upload_file('replace');
	  $upload->check_upload_file('attachment');
	
     $post =  format_post($post);
     
     // Check if the post is to be deleted	
     if ($delete_post == "1")
       {
         if ($approve_posts_perm)
           {
             $diy_db->query("DELETE FROM diy_blogs WHERE blog_id='$blogid'");
             $diy_db->query("DELETE FROM diy_blogs_comments WHERE blog_id='$blogid'");
             
$result = $diy_db->query("SELECT * FROM diy_blogs WHERE blog_id='$blogid'");
             while ($row = $diy_db->dbarray($result))
               {
                 extract($row);
                 $post_upload = $diy_db->query("SELECT * FROM diy_upload
									WHERE post_id='$commentid'
									AND location = 'post'
									AND module='blog'");
				while($files = $diy_db->dbarray($post_upload))
				{			
				$filename = get_file_path("$files[upid].blog");
				@unlink($filename);
				$diy_db->query("DELETE FROM diy_upload WHERE upid='$files[upid]'");
				}
               }
             
             info_message($lang['EDITPOST_COMMENT_DELETED_SUCCESSFULLY'], "mod.php?mod=blog");
             
           }
         else
           {
             info_message($lang['EDITPOST_NOT_ALLOWED'], "mod.php?mod=blog&modfile=viewpost&blogid=$blogid");
           }
       }
	   
     
     // Check if the post has been moved in order to update all the comments of the post 
     
     $cat_result = $diy_db->query("SELECT cat_id,comments_no FROM diy_blogs WHERE blog_id = '$blogid'");
     while ($cat_row = $diy_db->dbarray($cat_result));
       {
         $diy_db->query("UPDATE diy_blogs_comments set cat_id='$cat_row[cat_id]' WHERE blog_id = '$blogid'");
       }
     
     $result = $diy_db->query("UPDATE diy_blogs SET cat_id = '$cat_id',
                                                    title = '$title',
                                                    post = '$post',
                                                    draft = '$draft',
													allow_comments = '$allow_comments',
													tags = '$tags'
													WHERE blog_id = '$blogid'");
     
     
     if ($result)
       {
$upload->edit_uploaded_files($upload_id, 'replace', $delete, 'attachment', $blogid, 'post');
		 $check_files = $upload->check_existing_upload($blogid, 'post');
	   if($check_files)
       $diy_db->query("UPDATE diy_blogs SET has_attachment =1 WHERE blog_id = '$blogid'");
	    
         if ($subscribe == '0')
           {
             $diy_db->query("DELETE FROM diy_subscriptions where postid='$blogid' AND module = 'blog'");
           }
         else
           {
             $alert_query = $diy_db->query("SELECT * FROM diy_subscriptions where postid='$blogid' AND module = 'blog'");
             if ($diy_db->dbnumrows($alert_query) == 0)
               {
                 $diy_db->query("INSERT INTO diy_subscriptions values ('', '$userid', '$blogid', 'no','blog')");
               }
           }
         
         
       info_message($lang['EDITPOST_POST_EDITED_SUCCESSFULLY'], "mod.php?mod=blog&modfile=viewpost&blogid=$blogid");
         
         
       }
     else
       {
         info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
       }
     
   }
 else
   {
     $form = new form;
     
     if ($approve_posts_perm)
       {
         $edit_post .= $form->deleteform("delete_post");
       }
     
     $cat_result = $diy_db->query("SELECT * FROM diy_blogs_cat ORDER BY cat_id");
     while ($cat_row = $diy_db->dbarray($cat_result))
       {
         $catid             = $cat_row['cat_id'];
         $cat_title         = $cat_row['cat_title'];
         $cat_array[$catid] = $cat_title;
       }
     
	// extract $post_detalis query in the top of this page
     extract($row);
     
     $edit_post .= $form->inputform($lang['EDITPOST_TITLE'], "text", "title", "*", "$title");
     $edit_post .= $form->selectform($lang['EDITPOST_SELECT_CAT'], "cat_id", $cat_array, "$cat_id", '*');
     
     
     $info = array(
         'smiles' => 'on',
         'count' => "$maximum_letters",
         'required' => 'yes',
         'editor' => "$editor_type"
     );
     $edit_post .= $form->textarea($lang['EDITPOST_POST'], "post", "$post", $info);
	 $edit_post .= $form->inputform($lang['EDITPOST_TAGS'], "text", "tags", "", "$tags");


	 if ($has_attachment != '0')
       {
         $edit_post .= $form->edit_upload("Attachments", $blogid, 'post');
       }
     else
       {
         $edit_post .= $form->files_upload($lang['EDITPOST_UPLOAD_FILE'], "attachment[]");
       }
	   
	 $edit_post .= $form->radio_selection($lang['EDITPOST_ALLOW_COMMENTS'], 'allow_comments','',$allow_comments);
	 $edit_post .= $form->radio_selection($lang['EDITPOST_SAVE_DRAFT'], 'draft', '', $draft);
	 $edit_post .= $form->radio_selection($lang['EDITPOST_SUBSCRIBE'], 'subscribe');
	 
     $edit_post .= $form->hiddenform("userid", "$userid");
     $form_array = array(
         "action" => "mod.php?mod=blog&modfile=editpost&blogid=$blogid",
         "title" => $lang['EDITPOST_POST_HEAD'],
         "name" => 'editpost',
         "content" => $edit_post,
         "submit" => 'Submit'
     );
     
     $index_middle .= $form->form_table($form_array);
   }
 echo $index_middle;
?>