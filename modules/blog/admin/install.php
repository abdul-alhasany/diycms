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

// check that the file is not run directly
if (RUN_SECTION !== true)
{
    die ("<center><h3>".lang('ACCESS_NOT ALLOWED')."</h3></center>");
}

include('./../modules/'.$module.'/lang/'.$CONF[lang].'.lang.php');
 
 
 $query   = array();
 $query[] = "DROP TABLE IF EXISTS `diy_blogs_cat`;";
 $query[] = "
CREATE TABLE IF NOT EXISTS `diy_blogs_cat` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_order` int(10) NOT NULL DEFAULT '0',
  `cat_title` varchar(100) NOT NULL DEFAULT '',
  `countopic` int(10) NOT NULL DEFAULT '0',
  `countcomm` int(10) NOT NULL DEFAULT '0',
  `cat_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
);";
 
 $query[] = "DROP TABLE IF EXISTS `diy_blogs`;";
 $query[] = "
CREATE TABLE IF NOT EXISTS `diy_blogs` (
  `blog_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `post` longtext,
  `tags` longtext,
  `draft` char(3)  NOT NULL DEFAULT '',
  `readers` int(10) DEFAULT '0',
  `comments_no` int(10) DEFAULT '0',
  `rating_total` int(10) NOT NULL DEFAULT '0',
  `ratings` int(10) NOT NULL DEFAULT '0',
  `lastuserid` int(11) NOT NULL DEFAULT '0',
  `edit_by` varchar(255) NOT NULL DEFAULT '0',
  `allow_comments` int(10) DEFAULT '0',
  PRIMARY KEY (`blog_id`)
);";
 
 $query[] = "DROP TABLE IF EXISTS `diy_blogs_comments`;";
 $query[] = "CREATE TABLE IF NOT EXISTS `diy_blogs_comments` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `blog_id` int(10) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL DEFAULT '0',
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `allow` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`comment_id`)
);";
 
 $i = 0;
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'POST_HEAD_LETTERS', 'post_head_letters', '0', '".$i++."', '6');";
  $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'EMAIL_NOTIFICATION', 'email', '', '".$i++."', 6);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'POSTS_PER_PAGE', 'posts_per_page', '10', '".$i++."', 3);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'COMMENTS_PER_PAGE', 'comments_per_page', '10', '".$i++."', 3);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ORDER_POSTS_BY', 'order_posts_by', 'last_added', '".$i++."', 2);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'SORT_POSTS_BY', 'sort_posts_by', 'DESC', '".$i++."', 2);";
 
 $i = 0;
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'MANAGE_CAT', 'manage_cat', '1', '".$i++."', 7);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ADD_POST', 'add_post', '1', '".$i++."', 7);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ADD_COMMENT', 'add_comment', '1,2,3,4,5', '".$i++."', 7);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'EDIT_ALL_POSTS', 'edit_all_posts', '1,2', '".$i++."', 7);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'EDIT_OWN_POST', 'edit_own_post', '1,2,3,4', '".$i++."', 7);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'APPROVE_POSTS', 'approve_posts', '1,2', '".$i++."', 7);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'WAIT', 'wait', '5', '".$i++."', 7);";
 

 $query[] = "INSERT INTO diy_modules VALUES ('', '$module', '$admin_lang[mod_title]', '$admin_lang[mod_user]', 1, '$admin_lang[left_menu]','$admin_lang[right_menu]','0', '$admin_lang[menuid], $blockid',1,'$CONF[lang]');";

 foreach ($query as $line) {
   if (!$diy_db->query($line)) {
         $query_cid = $k + 1;
         $content .= "<table>";
         $content .= "<tr>";
         $content .= "<td>$admin_lang[QUERY_ERROR]</td>";
         $content .= "</tr>";
         $content .= "<tr>";
         $content .= "<td dir=ltr>" . mysql_error() . '</td>';
         $content .= "</tr>";
         $content .= "<tr>";
         $content .= "<td><b>$admin_lang[QUERY_TEXT]</b></td>";
         $content .= "</tr>";
         $content .= "<tr>";
         $content .= "<td align=left>$line</td>";
         $content .= "</tr></table>";

         echo $content;
         $false = true;

     }
 }
 if (!$false == true) {
     $modid = $diy_db->insertid();
     $mod   = $module;
     $theme = "Default";
     
     $themename = "./../modules/$mod/admin/$mod.xml";
     
     if (!$xml = simplexml_load_file($themename)) {
         trigger_error('Error reading XML file', E_USER_ERROR);
     }
     

     $themeid = 1;
     $result  = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '1', '$themeid', '0', '0', '$modid', '$mod', '$theme', '', '');");
     
     foreach ($xml->main_group as $child) {
         $title = base64_decode($child->group_title);
         $desc  = base64_decode($child->group_desc);
         
         $diy_db->query("INSERT INTO diy_module_tempgroup VALUES ('', '$modid', '$themeid', '$title', '$desc');");
         $temp_groupid = $diy_db->insertid();
         foreach ($child->template as $line) {
             $temp_title   = base64_decode($line->temp_title);
             $temp_content = base64_decode($line->temp_content);
             $temp_content = str_replace("'", "\'", $temp_content);
             $result       = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '0', '0', '$temp_groupid', '$themeid', '$modid', '$mod', '', '$temp_title', '$temp_content');");
         }
     }
 }
  $diy_db->query("INSERT INTO diy_menu VALUES ('', '$admin_lang[BLOG_CONTROL]', 'standard_menu', 'mainmenu', '$admin_lang[BLOG_CONTROL]', '<!--INC dir=\"modules/blog/blocks\" file=\"control.block.php\" -->', '2','1','$modid', '0', '1');");
  
  $diy_db->query("INSERT INTO diy_menu VALUES ('', '$admin_lang[BLOG_CATEGORIES]', 'standard_menu', 'mainmenu', '$admin_lang[BLOG_CATEGORIES]', '<!--INC dir=\"modules/blog/blocks\" file=\"categories.block.php\" -->', '2','1','$modid', '3', '1,2,3,4,5');");
  
  $diy_db->query("INSERT INTO diy_menu VALUES ('', '$admin_lang[BLOG_TAGS_CLOUD]', 'standard_menu', 'mainmenu', '$admin_lang[BLOG_TAGS_CLOUD]', '<!--INC dir=\"modules/blog/blocks\" file=\"tags.block.php\" -->', '2','1','$modid', '4', '1,2,3,4,5');");
  
    $diy_db->query("INSERT INTO diy_menu VALUES ('', '$admin_lang[BLOG_ARCHIVE]', 'standard_menu', 'mainmenu', '$admin_lang[BLOG_ARCHIVE]', '<!--INC dir=\"modules/blog/blocks\" file=\"archive.block.php\" -->', '2','1','$modid', '6', '1,2,3,4,5');");
	
  $block_result = $diy_db->query("SELECT * FROM diy_menu WHERE modid='0'
							  OR modid='$modid'");
    while ($row = $diy_db->dbarray($block_result)) {
          $block_array[] = $row['menuid'];
    }
	$block_list = implode(",",$block_array);
	
   $diy_db->query("UPDATE diy_modules SET mnueid = '$block_list' WHERE id='$modid';");

   
 if ($false == true) {
     $msg = $admin_lang['SETUP_DONE_ERROR'];
 } else {
     $msg = $admin_lang['SETUP_DONE'];
 }
 
 $content = info_msg($msg, "sections.php?section=modules&file=setup&module=$module&".$auth->get_sess());
	 echo $content;
?>