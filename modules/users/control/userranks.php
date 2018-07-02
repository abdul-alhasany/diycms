<?php
/*
+===============================================================================+
|      					DIY-CMS V1.0.0 Copyright © 2011   						|
|   	--------------------------------------------------------------   		|
|                    				BY                    						|
|              				ABDUL KAHHAR AL-HASANY            					|
|   																	   		|
|      					Web: http://www.diy-cms.com      						|
|   	--------------------------------------------------------------   		|
|	This file is part of DiY-CMS.												|
|   DiY-CMS is free software: you can redistribute it and/or modify				|
|   it under the terms of the GNU General Public License as published by		|
|   the Free Software Foundation, either version 3 of the License, or			|
|   (at your option) any later version.											|
|   DiY-CMS is distributed in the hope that it will be useful,					|
|   but WITHOUT ANY WARRANTY; without even the implied warranty of				|
|   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the				|
|   GNU General Public License for more details.								|
|   You should have received a copy of the GNU General Public License			|
|   along with DiY-CMS.  If not, see <http://www.gnu.org/licenses/>.			|
+===============================================================================+
*/

/**
  * This file is part of users module
  * 
  * @package	Modules
  * @subpackage	Users
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */


 include("modules/" . $mod->module . "/settings.php");
 
 
 
 $perm = $mod->setting('edit_ranks', $_COOKIE['cgroup']);
 
 $mod->permission($perm);
 
 
 if ($_GET['action'] == "") {
     $index_middle = $mod->nav_bar($lang['CONTROL_USERRANKS_ADD_RANK']);
     if ($_POST['submit']) {
         extract($_POST);
         $fullarr = array(
             $title,
             $posts,
             $icons
         );
         
         if (!required_entries($fullarr)) {
             error_message($lang['ERROR_VALIDATE']);
         }
         
         $result = $diy_db->query("insert into diy_userranks (rank_title,
                                                    posts_no,
                                                    repetition
												)
                                              values
                                                    ('$title',
                                                    '$posts',
                                                    '$icons'
													)");
         $rankid = $diy_db->insertid();
         upload_image("rank_avatar", '200', '200', "$rankid.rankavatar");
         
         if ($result) {
             info_message($lang['CONTROL_USERRANKS_RANK_ADDED']);
         } else {
             info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
         }
     }
     
     $form = new form;
     
     $rank_form .= $form->inputform($lang['CONTROL_USERRANKS_TITLE'], "text", "title", "*");
     $rank_form .= $form->inputform($lang['CONTROL_USERRANKS_POSTS_NUMBER'], "text", "posts", "*");
     $rank_form .= $form->inputform($lang['CONTROL_USERRANKS_RANKAVATAR'], "file", "rank_avatar");
     $rank_form .= $form->inputform($lang['CONTROL_USERRANKS_ICON_NUMBER'], "text", "icons", "*");
     
     $form_array = array(
         "action" => "mod.php?mod=users&dir=control&modfile=userranks",
         "title" => "$lang[CONTROL_USERRANKS_ADD_RANK]",
         "name" => 'ranks',
         "content" => $rank_form,
         "submit" => LANG_FORM_ADD_BUTTON
     );
     
     $index_middle .= $form->form_table($form_array);
     
     
     $result = $diy_db->query("SELECT * FROM diy_userranks ORDER BY rankid");
     while ($row = $diy_db->dbarray($result)) {
         $row = format_data_out($row);
         extract($row);
         $ratingimg = "<img src=images/user_rank.gif border=0>";
         $icons     = str_repeat($ratingimg, $repetition);
         $avatar    = get_file_path("$rankid.rankavatar");
         if (file_exists($avatar)) {
             $rank_avatar = "<img src=filemanager.php?action=rank_avatar&rankid=" . $rankid . ">";
         } else {
             unset($rank_avatar);
         }
         eval("\$rank_row .= \" " . $mod->gettemplate('users_control_view_ranks_row') . "\";");
         
     }
     
     eval("\$index_middle .= \" " . $mod->gettemplate('users_control_view_ranks') . "\";");
 } elseif ($_GET['action'] == "edit") {
     $index_middle = $mod->nav_bar($lang['CONTROL_USERRANKS_EDIT_RANK']);
     
     $rankid = set_id_int('rankid');
     
     if ($_POST['submit']) {
         extract($_POST);
         $fullarr = array(
             $title,
             $posts,
             $icons
         );
         
         if (!required_entries($fullarr)) {
             error_message($lang['ERROR_VALIDATE']);
         }
         
         $result = $diy_db->query("UPDATE diy_userranks set rank_title='$title',
                                                    posts_no='$posts',
                                                    repetition='$icons'
													
													where rankid='$rankid'");
         
         if (!empty($_FILES['rank_avatar']['tmp_name'])) {
             upload_image("rank_avatar", '200', '200', "$rankid.rankavatar");
         }
         if ($result) {
             info_message($lang['CONTROL_USERRANKS_RANK_EDITED'], "mod.php?mod=users&dir=control&modfile=userranks");
         } else {
             info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
         }
     }
     
     $form   = new form;
     $result = $diy_db->query("SELECT * FROM diy_userranks where rankid='$rankid' ORDER BY rankid");
     $row    = $diy_db->dbarray($result);
     extract($row);
     $rank_form .= $form->inputform($lang['CONTROL_USERRANKS_TITLE'], "text", "title", "*", "$rank_title");
     $rank_form .= $form->inputform($lang['CONTROL_USERRANKS_POSTS_NUMBER'], "text", "posts", "*", "$posts_no");
     $rank_form .= $form->inputform($lang['CONTROL_USERRANKS_REPLACE_RANKAVATAR'], "file", "rank_avatar");
     $rank_form .= $form->inputform($lang['CONTROL_USERRANKS_ICON_NUMBER'], "text", "icons", "*", "$repetition");
     
     $form_array = array(
         "action" => "mod.php?mod=users&dir=control&modfile=userranks&action=edit&rankid=$rankid",
         "title" => $lang['CONTROL_USERRANKS_EDIT_RANK'],
         "name" => 'ranks',
         "content" => $rank_form,
         "submit"	=>  LANG_FORM_EDIT_BUTTON
     );
     
     $index_middle .= $form->form_table($form_array);
     
 } elseif ($_GET['action'] == "delete") {
     $rankid = set_id_int('rankid');
     $result = $diy_db->query("DELETE from diy_userranks where rankid='$rankid'");
     
     $url  = "mod.php?mod=users&dir=control&modfile=userranks";
     $file = get_file_path("$rankid.rankavatar");
     if (file_exists($file)) {
         unlink($file);
     }
     if ($result) {
         info_message($lang['CONTROL_USERRANKS_RANK_REMOVED'], $url);
     } else {
         info_message($lang['CONTROL_USERRANKS_RANK_NOT_REMOVED'], $url);
     }
 }
 
 echo $index_middle;
 
 
?>