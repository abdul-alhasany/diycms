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
 
 $search_perm        = $mod->setting('search_posts', $_COOKIE['cgroup']);
 $mod->permission($search_perm);
 
 $index_middle = $mod->nav_bar($lang['SEARCH_HEAD']);
 $action = $_GET['action'];

if ($action == "" )
{
     $form = new form;
	 
	 $search_form .= $form->hiddenform("mod","forum");
	 $search_form .= $form->hiddenform("action","do_search");
	 
     $search_form .= $form->inputform($lang['SEARCH_KEYWORD'], "text", "keyword", "*");
	 
	 $array = array('10' => "10",
					'20' => "20",
					'30' => "30",
					'40' => "40",
					'50' => "50",
	 );
	 $orderby_array = array ('date_added' => "Post date",
							'comments_no' => "Comments",
							'readers' => "Readers",
							'username' => "Author"
							);
							
	 $sortby_array = array ('ASC' => "Ascending",
							'DESC' => "Descending"
							);
							
     $search_form .= $form->selectform($lang['SEARCH_POSTS_PER_PAGE'], "posts_per_page", $array, '30');
	 $search_form .= $form->selectform($lang['SEARCH_ORDER_BY'], "orderby", $orderby_array);
	 $search_form .= $form->selectform($lang['SEARCH_SORT_BY'], "sortby", $sortby_array);
     
     $form_array = array(
         "action" => "mod.php?mod=forum&modfile=search&action=do_search",
		 "method" => 'post',
         "title" => $lang['SEARCH_HEAD'],
         "name" => 'search',
         "content" => $search_form,
         "submit" => $lang['SEARCH_SEARCH_BUTTON'],
     );
     
     $index_middle .= $form->form_table($form_array);
	  echo $index_middle;
}

//---------------------------------------------------
else if($_GET['action']=="do_search")
{     
     if (!required_entries($_POST)) {
         error_message($lang['SEARCH_FILL_ALL_REQUIRED_FIELDS']);
     }
	 
 $keyword 		  = $_POST['keyword'];
 $order_by     = $_POST['orderby'];
 $sort_by        = $_POST['sortby'];
 $posts_per_page = $_POST['posts_per_page'];
 
 if($keyword == '')
 {
 $keyword 	= $_GET['keyword'];
 $order_by     = $_GET['orderby'];
 $sort_by        = $_GET['sortby'];
 $posts_per_page = $_GET['pages'];
 }
  if (!isset($_GET['start'])) {
     $start = '0';
 } else {
     $start = $_GET['start'];
 }

 
     $result = $diy_db->query("SELECT * FROM diy_forum_threads
							 WHERE allow = 'yes'
							 AND (post LIKE '%$keyword%' OR title LIKE '%$keyword%')
                             ORDER BY $order_by $sort_by
							 LIMIT $start,$posts_per_page");
     
     while ($row = $diy_db->dbarray($result)) {
         extract($row);
         $title   = format_data_out($title);
         $name    = format_data_out($username);
         $date    = format_date($date_added);
         
             eval("\$search_row .= \" " . $mod->gettemplate('forum_search_results_row') . "\";");
         }
     eval("\$index_middle .= \" " . $mod->gettemplate('forum_search_results') . "\";");
	 
	$numrowsa = $diy_db->dbnumquery("diy_forum_threads", "allow = 'yes' AND (post LIKE '%$keyword%' OR title LIKE '%$keyword%')");
	$index_middle .= pagination($numrowsa, $posts_per_page, "mod.php?mod=forum&modfile=search&action=do_search&keyword=$keyword&orderby=$order_by&sortby=$sort_by&pages=$posts_per_page");
   echo $index_middle;
 }
   


?>