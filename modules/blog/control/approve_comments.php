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

 if (RUN_MODULE !== true) {
     die("<center><h3>Not Allowed!</h3></center>");
 }
 
 include("modules/" . $mod->module . "/settings.php");
 
 $index_middle = $mod->nav_bar($lang['APPROVE_COMMENTS_UNAPPROVED_COMMENTS']);
 
 $perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);
 $mod->permission($perm);
 
 
 $start =(!isset($_GET['start'])) ? '0' : $_GET['start'];
 
 // Check if there is any action taken
 // First check if the posts are approved

 if ($_POST['approve']) {

     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $commentid) {
			 $result = $diy_db->query("UPDATE diy_blogs_comments set allow = 'yes' where comment_id='$commentid'");
         }
         if ($result)
         info_message($lang['APPROVE_COMMENTS_SELECTED_POSTS_APPROVED'], "mod.php?mod=blog&dir=control&modfile=approve_comments");
     } else {
         error_message($lang['APPROVE_COMMENTS_NO_POSTS_SELECTED'], "mod.php?mod=blog&dir=control&modfile=approve_comments");
     }
 }
 
 // Check if the posts are deleted	
 if ($_POST['delete']) {
   
     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $commentid) {
             $result = $diy_db->query("DELETE FROM diy_blogs_comments WHERE comment_id='$commentid'");
         }
         if ($result)
         info_message($lang['APPROVE_COMMENTS_SELECTED_POSTS_DELETED'], "mod.php?mod=blog&dir=control&modfile=approve_comments");
     } else {
         info_message($lang['APPROVE_COMMENTS_NO_POSTS_SELECTED'], "mod.php?mod=blog&dir=control&modfile=approve_comments");
     }
 }

 $perpage = 50;
 $result  = $diy_db->query("SELECT * FROM diy_blogs_comments WHERE
                                allow != 'yes' ORDER BY comment_id DESC
                                LIMIT  $start,$perpage");
 
 while ($row = $diy_db->dbarray($result)) {
     extract($row);
     
     eval("\$approve_posts_row .= \" " . $mod->gettemplate('blog_control_unapproved_comments_row') . "\";");
 }
 
 
 eval("\$index_middle .= \" " . $mod->gettemplate('blog_control_unapproved_comments') . "\";");
 
 
 
 $numrows = $diy_db->dbnumquery("diy_blogs_comments", "allow != 'yes'");
 $index_middle .= pagination($numrows, $perpage, "mod.php?mod=blog&dir=control&modfile=approve_comments");
 echo $index_middle;
 
?>