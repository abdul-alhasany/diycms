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

$blogid    = set_id_int('blogid');
$commentid = set_id_int('commentid');

$global_edit_perm   = $mod->setting('edit_all_posts', $_COOKIE['cgroup']);
$user_edit_perm     = $mod->setting('edit_own_post', $_COOKIE['cgroup']);
$approve_posts_perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);


 $post_detailes = $diy_db->query("SELECT * FROM diy_blogs_comments WHERE comment_id='$commentid' AND blog_id='$blogid' order by comment_id");
 $row           = $diy_db->dbarray($post_detailes);
 
 $maximum_edit_time	= get_group_setting('maximum_post_edit_time');
 $edit_time = check_edit_time($row['date_added'], $maximum_edit_time);
 
 if (($global_edit_perm == '') && (($user_edit_perm == '') || ($edit_time !='1')))
{
    error_message($lang['EDITCOMMENT_EDIT_NOT_ALLOWED']);
}

$maximum_letters = get_group_setting('maximum_posts_letters');
$editor_type     = get_group_setting('editor_type');


$index_middle = $mod->nav_bar($lang['EDITCOMMENT_POST_HEAD']);

if ($_POST['submit'])
{
	
    extract($_POST);
    
    if (!required_entries($post))
    {
        error_message($lang['LANG_ERROR_VALIDATE']);
    }
    
    
    if (!maximum_allowed($post, $maximum_letters))
    {
        error_message($error_mxs);
    }
    
    $post = format_post($post);
    
    
    // Check if the comment delete checkbox is checked and delete the comment
    if ($delete_comment == "1")
    {
        if ($approve_posts_perm)
        {
            $comment_delete = $diy_db->query("DELETE FROM diy_blogs_comments
										  WHERE blog_id='$blogid'
										  AND comment_id ='$commentid'");
										  
        info_message($lang['EDITCOMMENT_COMMENT_DELETED_SUCCESSFULLY'], "mod.php?mod=blog&modfile=viewpost&blogid=$blogid");    
        }
        else
        {
        info_message($lang['EDITCOMMENT_NOT_ALLOWED'], "mod.php?mod=blog&modfile=viewpost&blogid=$blogid");
        }
    }

	
    $result = $diy_db->query("UPDATE diy_blogs_comments SET title = '$title',
                                                    comment = '$post',
                                                    allow = '$allow'
                                                    where comment_id = '$commentid'
                                                    AND blog_id = '$blogid'");
    
    
    if ($result)
    {
        $url = get_comment_url($blogid, $commentid);
        info_message($lang['EDITCOMMENT_POST_EDITED_SUCCESSFULLY'], $url);
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
        $edit_post .= $form->deleteform("delete_comment");
    }
   
    // extract $post_details query at the top of this page
    extract($row);
    
    $edit_post .= $form->inputform($lang['EDITCOMMENT_TITLE'], "text", "title", "*", "$title");
    
    $info = array(
        'smiles' => 'on',
        'count' => "$maximum_letters",
        'required' => 'yes',
        'editor' => "$editor_type"
    );
    $edit_post .= $form->textarea($lang['EDITCOMMENT_COMMENT'], "post", $comment, $info);
    
    if ($approve_posts_perm)
    {
        $admin_array = array(
            'yes' => "Yes",
            'no' => "No"
        );
        $edit_post .= $form->radio_selection($lang['EDITCOMMENT_ALLOW_POST'], "allow", $admin_array, "$allow");
    }
    else
    {
        $edit_post .= $form->hiddenform("allow", "$allow");
    }
    $edit_post .= $form->hiddenform("userid", "$userid");
    $form_array = array(
        "action" => "mod.php?mod=blog&modfile=editcomment&blogid=$blogid&commentid=$commentid",
        "title" => $lang['EDITCOMMENT_POST_HEAD'],
        "name" => 'editpost',
        "content" => $edit_post,
        "submit" => 'Submit'
    );
    
    $index_middle .= $form->form_table($form_array);
}
echo $index_middle;
?> 