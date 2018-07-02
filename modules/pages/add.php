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

include("modules/".$mod->module."/settings.php");

$index_middle = $mod->nav_bar($lang['ADD_PAGE']);

$perm = $mod->setting('add_page',$_COOKIE['cgroup']);
$mod->permission($perm);

 if ($_POST['submit'])
{
extract($_POST);

    if($CONF['mach_ip'] == 1){
    $this_url = explode('/',$_SERVER['HTTP_HOST']);
    $reff_url = explode('/',$_SERVER['HTTP_REFERER']);

    if($this_url[0] !== $reff_url[2])
    info_message('You can not add a post outside the website',"pages.php?action=add");
    }

    $fullarr =  array($title,$content);

     if (!required_entries($fullarr))
     {
         error_message($lang['LANG_ERROR_VALIDATE']);
     }

    if (!maximum_allowed($post,$mod->setting("max_letters")))
    {
        error_message($error_mxs);
    }

    $allow = $mod->setting('wait',$_COOKIE['cgroup']);
	if($allow)
	$allow_value = 'no';
	else
	$allow_value = 'yes';
	
	$userid 		= $_COOKIE['cid'];
    $timestamp 		= time();
	
    $result= $diy_db->query("INSERT INTO diycms_pages
                          (userid,date_time,title,content,allow)
						   VALUES
                          ('$userid','$timestamp','$title','$content','$allow_value')");
    if ($result)
    {
		if($allow_value == 'no')
		{
		info_message($lang['PAGE_WAIT_APPROVAL'],"mod.php?mod=pages");
		}
		else
		{
        info_message($lang['PAGE_ADDED'],"mod.php?mod=pages");
		}
    }
    else
    {
        info_message($lang['LANG_ERROR_ADD_DB'],"mod.php?mod=pages");
    }
	
}
else
{

$form = new form;
	
	$max_letters = $mod->setting("max_letters");
	
	$add_form .= $form->inputform("$lang[TITLE]","text","title","*","");
	$info = array(
	'smiles' => 'off',
	'rows' => '20',
	'cols' => '80',
	'count' => "$max_letters",
	'bbcode' => 'on',
	'required' => 'yes',
	);
	$add_form .= $form->textarea("$lang[PAGE]","content","",$info);

		$form_array = array("action"     => "mod.php?mod=pages&modfile=add",
                            "title"      => "$lang[ADD_PAGE]",
                            "name"       => 'add_page',
                            "content"    => $add_form,
							"submit"	=> LANG_FORM_ADD_BUTTON
                           );
						   
	$index_middle .= $form->form_table($form_array);
	
echo $index_middle;
}

?>