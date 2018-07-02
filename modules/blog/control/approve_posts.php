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
 
 $index_middle = $mod->nav_bar();
 
 $perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);
 $mod->permission($perm);
 
  $start = (!isset($_GET['start'])) ? '0' : $_GET['start'];

 // Check if there is any action taken
 // First check if the posts are approved
 $approve = $_POST['approve'];
 if ($approve) {
     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $blogid) {
             $result = $diy_db->query("UPDATE diy_blogs set draft = '0' where blog_id='$blogid'");
         }
         if ($result)
		 $numrows = $diy_db->dbnumquery("diy_blogs", "cat_id='$cat_id'");
         $result = $diy_db->query("UPDATE diy_blogs_cat SET countopic='$numrows' where cat_id='$cat_id'");
		 
         info_message($lang['APPROVE_POSTS_SELECTED_POSTS_APPROVED'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
     } else {
         error_message($lang['APPROVE_POSTS_NO_POSTS_SELECTED'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
     }
 }
 
 // Check if the posts are deleted	
 $delete = $_POST['delete'];
 if ($delete) {
     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $blogid) {
             $result = $diy_db->query("DELETE from diy_blogs where blog_id='$blogid'");
         }
         
		 $numrows = $diy_db->dbnumquery("diy_blogs", "cat_id='$cat_id'");
         $result = $diy_db->query("UPDATE diy_blogs_cat SET countopic='$numrows' where cat_id='$cat_id'");

         info_message($lang['APPROVE_POSTS_SELECTED_POSTS_DELETED'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
     } else {
         info_message($lang['APPROVE_POSTS_NO_POSTS_SELECTED'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
     }
 }

 // Check if the posts are moved to a new category	
 $move = $_POST['move'];
 if ($move) {
     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $blogid) {
             $result = $diy_db->query("UPDATE diy_blogs SET cat_id='$new_catid' WHERE blog_id='$blogid'");
         }
         if ($result)
             $numrows = $diy_db->dbnumquery("diy_blogs", "cat_id='$cat_id'");
         $result = $diy_db->query("UPDATE diy_blogs_cat SET countopic='$numrows' where catid='$cat_id'");
         
         info_message($lang['APPROVE_POSTS_SELECTED_POSTS_MOVED'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
     } else {
         info_message($lang['APPROVE_POSTS_NO_POSTS_SELECTED'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
     }
 }
 
 $perpage = 50;
 $result  = $diy_db->query("SELECT * FROM diy_blogs WHERE
                                draft != '0' ORDER BY blog_id DESC
                                LIMIT  $start,$perpage");
 
 while ($row = $diy_db->dbarray($result)) {
     extract($row);
     
     eval("\$approve_posts_row .= \" " . $mod->gettemplate('blog_control_draft_blog_row') . "\";");
 }
 
 
 $category = $diy_db->query("SELECT * FROM diy_blogs_cat ORDER BY cat_id");
 while ($category_list = $diy_db->dbarray($category)) {
     $catid     = $category_list['cat_id'];
     $cat_title = $category_list['cat_title'];
     $options .= "<option value='$catid'>$cat_title</option>";
 }
 
 eval("\$index_middle .= \" " . $mod->gettemplate('blog_control_draft_blogs') . "\";");
 
 
 
 $numrows = $diy_db->dbnumquery("diy_blogs", "draft != '0'");
 $index_middle .= pagination($numrows, $perpage, "mod.php?mod=blog&dir=control&modfile=approve_posts");
 echo $index_middle;
 
?>