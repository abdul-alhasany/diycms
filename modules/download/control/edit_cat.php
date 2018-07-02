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
  * This file is part of download module
  * 
  * @package	Modules
  * @subpackage	Download
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */


include ("modules/" . $mod->module . "/settings.php");

$perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
$mod->permission($perm);

$index_middle = $mod->nav_bar($lang['CONTROL_EDITCAT']);

$catid = set_id_int('catid');

 if ($_POST['submit'])
{
  extract($_POST);

  $fullarr = array($title, $order);

  if (!required_entries($fullarr))
  {
    error_message($lang['LANG_ERROR_VALIDATE']);
  }

  $order = intval($order);
  $allow_view = implode_data($allow_view);
  $allow_post = implode_data($allow_post);

  upload_image("cat_image", "200", "200", "$catid.downloadcat");

  $result = $diy_db->query("update diy_download_cat set cat_order = '$order',
                                                    parent='$parent',
                                                    cat_title= '$title',
                                                    dsc= '$dsc',
													grouppost= '$allow_view',
                                                    groupview='$allow_post',
                                                    cat_email= '$email',
                                                    closed='$closed'
													where catid='$catid'
													");

  if ($result)
  {
    info_message($lang['CONTROL_EDITCAT_SUCCESSFUL'], 'mod.php?mod=download&dir=control&modfile=viewcat');
  }
  else
  {
    info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
  }

}
else
{
  $form = new form;


  $catresult = $diy_db->query("SELECT * FROM diy_download_cat ORDER BY catid");
  $cat_array[0] = 'Main';
  while ($array = $diy_db->dbarray($catresult))
  {
    $id = $array['catid'];
    $cat_title = $array['cat_title'];
    $cat_array[$id] = $cat_title;
  }


  for ($i = 0; $i <= 50; $i++)
  {
    $number_array[] = $i;
  }

  $result = $diy_db->query("SELECT * FROM diy_download_cat WHERE catid='$catid'");
  $row = $diy_db->dbarray($result);
  extract($row);

  $editcat_form .= $form->inputform($lang['CONTROL_EDITCAT_TITLE'], "text", "title", "*", $cat_title);
  $editcat_form .= $form->selectform($lang['CONTROL_ADDCAT_ORDER'], "order", $number_array, $cat_order, "*");

  $editcat_form .= $form->selectform($lang['CONTROL_EDITCAT_PARENT_CAT'], "parent", $cat_array, "$parent");

  $avatarfile = get_file_path("$catid.downloadcat");
  if (file_exists($avatarfile))
  {
    $catimage = "<img src=filemanager.php?action=getimage&info=$catid;downloadcat;download>";
  }
  else
  {
    $catimage = 'There is no category image';
  }

  $info = array('smiles' => 'off', 'rows' => '10', 'cols' => '55', 'count' => "500", 'bbcode' => "off");
  $editcat_form .= $form->textarea($lang['CONTROL_EDITCAT_DESC'], "dsc", "$dsc", $info);
  $editcat_form .= $form->group_permission($lang['CONTROL_EDITCAT_ALLOW_VIEW'], "allow_view[]", $groupview);
  $editcat_form .= $form->group_permission($lang['CONTROL_EDITCAT_ALLOW_POST'], "allow_post[]", $grouppost);

  $editcat_form .= $form->inputform($lang['CONTROL_EDITCAT_CAT_EMAIL'], "text", "email", "", $cat_email);
  $editcat_form .= "<tr><td nowrap class=\"info_bar\">$lang[CONTROL_EDITCAT_CAT_CURRENT_IMAGE]
		<br><a href=mod.php?mod=download&dir=control&modfile=misc&action=delete_cat_image&catid=$catid>Delete current image</a></td>
		  <td width=\"100%\">$catimage</td></tr>";
  $editcat_form .= $form->inputform($lang['CONTROL_EDITCAT_CAT_REPLACE_IMAGE'], "file", "cat_image", "");
  $editcat_form .= $form->radio_selection($lang['CONTROL_EDITCAT_CLOSED'], "closed", "", $closed);



  $form_array = array("action" => "mod.php?mod=download&dir=control&modfile=edit_cat&catid=$catid", "title" => "$lang[CONTROL_EDITCAT]", "name" => 'add_cat', "content" => $editcat_form,
    "submit"	=>  LANG_FORM_ADD_BUTTON);

  $index_middle .= $form->form_table($form_array);
}
echo $index_middle;

?>