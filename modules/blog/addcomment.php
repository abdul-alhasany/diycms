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
 
 $blogid = set_id_int('blogid');
 $cat_id = set_id_int('cat_id');
 
 $add_perm        = $mod->setting('add_comment', $_COOKIE['cgroup']);
 $maximum_letters = get_group_setting('maximum_posts_letters');
 $editor_type     = get_group_setting('editor_type');
 $mod->permission($add_perm);
 
 
 $index_middle = $mod->nav_bar($lang[ADDCOMMENT_COMMENT_HEAD]);
 
 $submit = $_POST['submit'];
 if ($submit) {
     require_once('includes/email.class.php');
     extract($_POST);
     
     if ($CONF['mach_ip'] == 1) {
         $this_url = explode('/', $_SERVER['HTTP_HOST']);
         $reff_url = explode('/', $_SERVER['HTTP_REFERER']);
         
         if ($this_url[0] !== $reff_url[2])
             info_message('You can not add comment from outside our website', "index.php");
     }
     
     if (!required_entries($post)) {
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
     $allow_value = ($allow) ? 'no' : 'yes';
     
     
     $userid    = $_COOKIE['cid'];
     $timestamp = time();
	$Spams  = new Spams();
    if( $Spams->checkSpams() == false )
    {
        info_message(LANG_ERROR_WAIT_SECONDS,"mod.php?mod=blog&modfile=viewpost&blogid=$blogid");
    }
     $result    = $diy_db->query("INSERT INTO diy_blogs_comments (blog_id,
													user_id,
                                                    cat_id,
                                                    username,
                                                    title,
													date_added ,
                                                    comment,
                                                    allow
												)
                                              values
                                                    ('$blogid',
													'$userid',
                                                    '$cat_id',
                                                    '$name',
                                                    '$title',
													'$timestamp',
													'$post',
                                                    '$allow_value'
													)");
     
     if ($result) {
         $commentid = $diy_db->insertid();
         
         
         $diy_db->query("UPDATE diy_blogs_cat SET countcomm=countcomm+1 WHERE cat_id = '$cat_id'");
         $diy_db->query("UPDATE diy_blogs SET comments_no=comments_no+1, lastuserid ='$userid' WHERE blog_id = '$blogid'");
         $diy_db->query("UPDATE diy_users SET all_posts = all_posts+1 WHERE userid = '$userid'");
         
         $mail = new email;
         $mail->send_to_users('blog_id', $userid, $post_id, $url, $H);
         
         if ($allow_value == 'no') {
             info_message($lang['ADDCOMMENT_COMMENT_NEED_APPROVAL'], "mod.php?mod=blog");
         } else {
             info_message($lang['ADDCOMMENT_POST_ADDED_SUCCESSFULLY'], "mod.php?mod=blog&modfile=viewpost&blogid=$blogid");
         }
         
     } else {
         info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
     }
     
 } else {
     $form = new form;
     
     
     if ($_COOKIE['cname'] == 'Guest') {
         $add_comment .= $form->inputform($lang['ADDCOMMENT_USERNAME'], "text", "username", "*");
     }
     $add_comment .= $form->inputform($lang['ADDCOMMENT_TITLE'], "text", "title");
     
     if (isset($_GET['qoute'])) {
         $qoute     = intval($_GET['qoute']);
         $result    = $diy_db->query("SELECT username,comment FROM diy_blogs_comments WHERE commentid='$qoute'");
         $row       = $diy_db->dbarray($result);
         $post_text = "  [QUOTE]BY :" . $row['username'] . "\n" . $row['comment'] . "[/QUOTE] \n";
     }
     
     
     $info = array(
         'smiles' => 'on',
         'count' => "$maximum_letters",
         'required' => 'yes',
         'editor' => "$editor_type"
     );
     $add_comment .= $form->textarea($lang['ADDCOMMENT_COMMENT'], "post", "$post_text", $info);
     
     $form_array = array(
         "action" => "mod.php?mod=blog&modfile=addcomment&blogid=$blogid&cat_id=$cat_id",
         "title" => "$lang[ADDCOMMENT_COMMENT_HEAD]",
         "name" => 'add_comment',
         "content" => $add_comment,
         "submit" => 'Submit'
     );
     
     $index_middle .= $form->form_table($form_array);
 }
 echo $index_middle;
?>