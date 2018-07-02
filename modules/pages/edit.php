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
  * This file is part of pages module
  * 
  * @package	Modules
  * @subpackage	Pages
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

if (RUN_MODULE !== true)
{
    die ("<center><h3>You are not allowed to access this file directly.</h3></center>");
}

include("modules/".$mod->module."/settings.php");

$index_middle = $mod->nav_bar($lang['EDIT_SIGN']);

$edit_perm = $mod->setting('edit_page',$_COOKIE['cgroup']);
$mod->permission($edit_perm);

$page	= $_GET['page'];

if($_POST['submit'])
{
extract($_POST);

  if ($delete_post == "1")
       {
         if ($edit_perm)
           {
             $diy_db->query("DELETE FROM diycms_pages WHERE title='$page'");
			 info_message($lang['PAGE_DELETED'], "mod.php?mod=pages");
           }
         else
           {
             info_message($lang['EDITPOST_NOT_ALLOWED'], "mod.php?mod=pages&modfile=view&page=$page");
           }
       }
	   
  
    $fullarr =  array($title,$content);

     if (!required_entries($fullarr))
     {
         error_message(LANG_ERROR_VALIDATE);
     }
	 
     if (!required_entries($fullarr))
     {
         error_message($lang['LANG_ERROR_VALIDATE']);
     }

    if (!maximum_allowed($post,$mod->setting("max_letters")))
    {
        error_message($error_mxs);
    }
	

    $result=$diy_db->query("UPDATE diycms_pages set
                          title = '$title',
						  content = '$content',
						  allow = '$allow'
						  
						  where title='$page'");
    if ($result)
    {
        info_message($lang['PAGE_EDITED'],"mod.php?mod=pages&modfile=view&page=$page");
    }
    else
    {
        info_message(LANG_ERROR_ADD_DB,"mod.php?mod=pages");
    }
	
}
else
{
$form = new form;
	
	
	$result = $diy_db->query("SELECT * FROM diycms_pages where title='$page' ORDER BY id");
	$row = $diy_db->dbarray($result);
	
	 if ($edit_perm)
       {
         $edit_form .= $form->deleteform("delete_post");
       }
	   
	$edit_form .= $form->inputform("$lang[TITLE]","text","title","*",$row['title']);
	
	$max_letters = $mod->setting("max_letters");
	$info = array(
	'smiles' => 'off',
	'rows' => '20',
	'cols' => '80',
	'count' => "$max_letters",
	'bbcode' => 'off',
	'editor' => $mod->setting('editor_type'),
	'required' => 'yes',
	);
	$edit_form .= $form->textarea("$lang[PAGE]","content",$row['content'],$info);

	$allow_array = array ('yes' => 'approve',
	'no' => 'wait');
	
	$edit_form .= $form->selectform("$lang[PAGE_STATUS]","allow",$allow_array,$row['allow']);
	
		$form_array = array("action"     => "mod.php?mod=pages&modfile=edit&page=$page&id=$id",
                            "title"      => "$lang[EDIT_PAGE]",
                            "name"       => 'edit_sign',
                            "content"    => $edit_form,
							"submit"	=>  LANG_FORM_EDIT_BUTTON
                           );
						   
	$index_middle .= $form->form_table($form_array);
	
echo $index_middle;
}

?>