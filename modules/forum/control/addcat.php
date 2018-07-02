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
  * This file is part of forum module
  * 
  * @package	Modules
  * @subpackage	Forum
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

 include("modules/" . $mod->module . "/settings.php");
 
 $perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
 $mod->permission($perm);
 	
if(( $_COOKIE['cid'] == 0) || ($_COOKIE['cid'] == $CONF['Guest_id']))
{
  eval("\$index_middle .=\" " . $mod->gettemplate ( 'forum_login_bar' ) . "\";");
}
else
{
    $userid = $_COOKIE['cid'];
	$pmumrows = $diy_db->dbnumquery("diy_messages","msgbox='1' and userid='".$_COOKIE['cid']."' AND msgisread ='1'");
	 $perm1 = $mod->setting('manage_cat', $_COOKIE['cgroup']);
	 $perm2 = $mod->setting('approve_posts', $_COOKIE['cgroup']);
	 
	 if(($perm1) && ($perm2))
	 {
        $isadmin = " | <a href=mod.php?mod=forum&dir=control>{$lang['INDEX_CONTROL_FORUM']}</b></font></a>";
	 }
  eval("\$index_middle .=\" " . $mod->gettemplate ( 'forum_tools_bar' ) . "\";");
}

 $index_middle .= $mod->nav_bar($lang['CONTROL_ADDCAT']);
 
 if ($_POST['submit']) {
     extract($_POST);
     
     $fullarr = array(
         $title,
         $order
     );
     
     if (!required_entries($fullarr)) {
         error_message($lang['LANG_ERROR_VALIDATE']);
     }
     
     
     if ((!empty($cat_email)) && (!check_email_validity($cat_email))) {
         error_message($lang['CONTROL_ADDCAT_WRONG_EMAIL']);
     }
     $order      = intval($order);
     $allow_view = implode_data($allow_view);
     $allow_post = implode_data($allow_post);
     
     $result = $diy_db->query("insert into diy_forum_cat (cat_order,
                                                    parent,
                                                    cat_title,
                                                    dsc,
													grouppost,
                                                    groupview,
                                                    cat_email,
                                                    closed
												)
                                              values
                                                    ('$order',
                                                    '$parent',
                                                    '$title',
                                                    '$dsc',
													'$allow_view',
													'$allow_post',
                                                    '$email',
													'$closed'
													)");
     
     if ($result) {
         $catid = $diy_db->insertid();
         upload_image("cat_image", '200', '200', "$catid.forumcat");
         info_message($lang['CONTROL_ADDCAT_SUCCESSFUL'], "mod.php?mod=forum&dir=control&modfile=viewcat");
     } else {
         info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
     }
     
 } else {
     $form = new form;
     
     $result       = $diy_db->query("SELECT * FROM diy_forum_cat ORDER BY catid");
     $cat_array[0] = 'Main';
     while ($row = $diy_db->dbarray($result)) {
         $catid             = $row['catid'];
         $cat_title         = $row['cat_title'];
         $cat_array[$catid] = $cat_title;
     }
     
	 for($i = 0; $i <= 50; $i++)
	 {
	 $number_array[] = $i;
	 }
	 
     $add_cat .= $form->inputform($lang['CONTROL_ADDCAT_TITLE'], "text", "title", "*");
	 $add_cat .= $form->selectform($lang['CONTROL_ADDCAT_ORDER'], "order", $number_array,"","*");
     $add_cat .= $form->selectform($lang['CONTROL_ADDCAT_PARENT_CAT'], "parent", $cat_array);
     
     
     $info = array(
         'smiles' => 'off',
         'rows' => '10',
         'cols' => '55',
         'count' => "500",
         'bbcode' => "off"
     );
     $add_cat .= $form->textarea($lang['CONTROL_ADDCAT_DESC'], "dsc", "", $info);
     $add_cat .= $form->group_permission($lang['CONTROL_ADDCAT_ALLOW_VIEW'], "allow_view[]");
     $add_cat .= $form->group_permission($lang['CONTROL_ADDCAT_ALLOW_POST'], "allow_post[]");
     
     $add_cat .= $form->inputform($lang['CONTROL_ADDCAT_CAT_EMAIL'], "text", "email", "");
     $add_cat .= $form->inputform($lang['CONTROL_ADDCAT_CAT_IMAGE'], "file", "cat_image", "");
     $add_cat .= $form->radio_selection($lang['CONTROL_ADDCAT_CLOSED'], "closed", 0);
     
     
     
     $form_array = array(
         "action" => "mod.php?mod=forum&dir=control&modfile=addcat",
         "title" => $lang['CONTROL_ADDCAT'],
         "name" => 'add_cat',
         "content" => $add_cat,
         "submit"	=>  LANG_FORM_ADD_BUTTON
     );
     
     $index_middle .= $form->form_table($form_array);
 }
 echo $index_middle;
?>