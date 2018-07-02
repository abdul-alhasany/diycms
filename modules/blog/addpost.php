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
 
 $add_perm        = $mod->setting('add_post', $_COOKIE['cgroup']);
 $maximum_letters = get_group_setting('maximum_posts_letters');
 $editor_type     = get_group_setting('editor_type');
 $mod->permission($add_perm);
 
 $index_middle = $mod->nav_bar($lang['ADDPOST_POST_HEAD']);
 
 if ($_POST['submit']) {
     require_once('includes/email.class.php');
     extract($_POST);
     
     $fullarr = array(
         $title,
         $post
     );
     
     if (!required_entries($fullarr)) {
         error_message($lang['LANG_ERROR_VALIDATE']);
     }
     
     if ($_COOKIE['cid'] == 0 or $_COOKIE['cid'] == $CONF['Guest_id']) {
         $name = $_POST['username'];
         if (!required_entries($name)) {
             error_message($lang['LANG_ERROR_VALIDATE']);
         }
     } else {
         $name = $_COOKIE['cname'];
     }
     
     if (!maximum_allowed($post, $maximum_letters)) {
         error_message($error_mxs);
     }
     
     $post =  format_post($post);
          
     $allow = $mod->setting('wait', $_COOKIE['cgroup']);
     
     
     $upload = new handle_upload_files;
	$upload->check_upload_file('attachment');
     
     $userid    = $_COOKIE['cid'];
     $timestamp = time();
	 $Spams  = new Spams();
    if( $Spams->checkSpams() == false )
    {
        info_message(LANG_ERROR_WAIT_SECONDS,"mod.php?mod=blog&modfile=addpost");
    }
	
     $result    = $diy_db->query("INSERT INTO diy_blogs (user_id,
                                                    cat_id,
                                                    username,
                                                    title,
													date_added ,
                                                    post,
                                                    draft,
													allow_comments,
													tags
												)
                                              values
                                                    ('$userid',
                                                    '$cat_id',
                                                    '$name',
                                                    '$title',
													'$timestamp',
													'$post',
                                                    '$draft',
													'$allow_comments',
													'$tags'
													)");
     
     if ($result) {
         $blogid = $diy_db->insertid();
         
         $mail = new email;
         $mail->send_to_moderate($cat_id);

$file_attachment = $upload->upload_files('attachment', $blogid, 'post');
         if ($file_attachment) {
            $diy_db->query("UPDATE diy_blogs SET has_attachment =1 WHERE blog_id = '$blogid'");
         }
		 
         $diy_db->query("UPDATE diy_blogs_cat SET countopic=countopic+1 WHERE cat_id = '$cat_id'");
         $diy_db->query("UPDATE diy_users SET all_posts = all_posts+1 WHERE userid = '$userid'");
         if ($subscribe == '1') {
             $diy_db->query("INSERT INTO diy_subscriptions values ('', '$userid', '$blogid', 'no','blog')");
         }
         

      info_message($lang['ADDPOST_POST_ADDED_SUCCESSFULLY'], "mod.php?mod=blog&modfile=viewpost&blogid=$blogid");
         
     } else {
         info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
     }
     
 } else {
     $form = new form;
     
     $result = $diy_db->query("SELECT * FROM diy_blogs_cat order by cat_id");
     while ($row = $diy_db->dbarray($result)) {
         $catid             = $row['cat_id'];
         $cat_title         = $row['cat_title'];
         $cat_array[$catid] = $cat_title;
     }
     if ($_COOKIE['cname'] == 'Guest') {
         $add_post .= $form->inputform($lang['ADDPOST_USERNAME'], "text", "username", "*");
     }
     $add_post .= $form->inputform($lang['ADDPOST_TITLE'], "text", "title", "*");
     $add_post .= $form->selectform($lang['ADDPOST_SELECT_CAT'], "cat_id", $cat_array, '', '*');
     
     
     $info = array(
         'smiles' => 'on',
         'count' => "$maximum_letters",
         'required' => 'yes',
         'editor' => "$editor_type"
     );
     $add_post .= $form->textarea($lang['ADDPOST_POST'], "post", "", $info);
     $add_post .= $form->inputform($lang['ADDPOST_TAGS'], "text", "tags");
     
$add_post .= $form->files_upload($lang['ADDPOST_UPLOAD_FILE'], "attachment[]");
	 
	 $add_post .= $form->radio_selection($lang['ADDPOST_ALLOW_COMMENTS'], 'allow_comments','','1');
	 $add_post .= $form->radio_selection($lang['ADDPOST_SAVE_DRAFT'], 'draft');
	 $add_post .= $form->radio_selection($lang['ADDPOST_SUBSCRIBE'], 'subscribe');
	 
     $form_array = array(
         "action" => "mod.php?mod=blog&modfile=addpost",
         "title" => $lang['ADDPOST_POST_HEAD'],
         "name" => 'add_post',
         "content" => $add_post,
         "submit" => 'Submit'
     );
     
     $index_middle .= $form->form_table($form_array);
 }
 echo $index_middle;
?>