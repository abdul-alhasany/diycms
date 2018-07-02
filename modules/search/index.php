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
    
    include("modules/" . $mod->module . "/settings.php");
    
    
    $index_middle = $mod->nav_bar();
    
    $allow_search = $mod->setting('allow_search', $_COOKIE['cgroup']);
    $mod->permission($allow_search);
	    
	
	$submit = $_POST['submit'];
	if($submit)
	{
	extract($_POST);
	//echo nl2br(print_r($_POST,1));
	// check the search mode
	if(empty($keywords))
	{
	error_message($lang['INDEX_SEARCH_KEYWORDS_EMPTY']);
	}
	if($type = 'or')
	{
	$keywords = str_replace(' ', '|', $keywords);

	}
	
	// if search is not set to everywhere then search the specific module
	if($scope != '0')
	{
		// start building query, assign each query to the related module
		switch ($scope) {
		case 'forum':
			$query = "SELECT threadid, username, title, date_added, post
								 FROM diy_forum_threads
								 WHERE ";
		break;
		case 'download':
			$query = "SELECT downid, username, title, date_added, post
								FROM diy_download_files
								WHERE ";
		break;
		case 'news':
			$query = "SELECT newsid, username, title, date_added, post
								FROM diy_news
								WHERE ";
		break;
		}
		
		// check if title or post are included
		$title 	= ($include['title']) ? "title REGEXP '$keywords'" : '';	
		$post 	= ($include['post']) ? "post REGEXP '$keywords'" : '';
		$opreator	= (count($include) > 1) ? ' OR ' : '' ;
		
		// get time scope
		$time_scope	= time() - $from;
		$time 		= "AND date_added > $time_scope";
		
		// get results and check results number
		$result = $diy_db->query($query.$title.$opreator.$post.$time);
		
		// if results are one or more insert the query in database then direct to the search file
		if($diy_db->dbnumrows($result) > 0)
		{
		$userid 	= $_COOKIE['cid'];
		$timestamp 	= time();
		$text_part  = implode(',', $include);
		$ip			= $_SERVER['REMOTE_ADDR'];
		
		$diy_db->query("INSERT INTO diy_search VALUES ('', '$userid', '$keywords', '$type', '$from', '$search_max', '$scope', '$text_part', '$timestamp', '$ip')");
		
		$search_id = $diy_db->insertid();
		
		info_message($lang['INDEX_SEARCH_SUCCESSFUL'], "mod.php?mod=search&modfile=search&search_id=$search_id");
		}
		else
		{
		echo "stop";
		}
	}
	else
	{
	// if the search is set to everywhere
	// set some variables so we can display them later in the results table
    $result = $diy_db->query("SET @forum= 'forum', @download= 'download', @news= 'news';");
	$result = $diy_db->query("SELECT threadid as id, username, title, date_added, post, @forum as scope
						FROM diy_forum_threads
						WHERE title REGEXP '$keywords'
						OR post REGEXP '$keywords'
						
						UNION
						
						SELECT downid as id, username, title, date_added, post, @download as scope
						FROM diy_download_files
						WHERE title REGEXP '$keywords'
						OR post REGEXP '$keywords'
						
						UNION
						
						SELECT newsid as id, username, title, date_added, post, @news as scope
						FROM diy_news
						WHERE title REGEXP '$keywords'
						OR post REGEXP '$keywords'");
						
	if($diy_db->dbnumrows($result) > 0)
		{
		$userid 	= $_COOKIE['cid'];
		$timestamp 	= time();
		$text_part  = implode(',', $include);
		$ip			= $_SERVER['REMOTE_ADDR'];
		
		$diy_db->query("INSERT INTO diy_search VALUES ('', '$userid', '$keywords', '$type', '$from', '$search_max', '$scope', '$text_part', '$timestamp', '$ip')");
		
		$search_id = $diy_db->insertid();
		
		
		info_message($lang['INDEX_SEARCH_SUCCESSFUL'], "mod.php?mod=search&modfile=search&search_id=$search_id");
		echo "your search was successful";
		}
		else
		{
		echo "stop";
		}
	
    }
	}

	$scope = "<option value='0'>$lang[INDEX_SEARCH_FORM_EVERYWHERE]</option>";
	
	$result = $diy_db->query("SELECT mod_name, mod_title FROM diy_modules 
						 WHERE mod_name = 'forum'
						 OR mod_name = 'news'
						 OR mod_name = 'download'
						 ORDER BY mod_title
						 ");
	while($row = $diy_db->dbarray($result))
	{
		extract($row);
		$scope .= "<option value='$mod_name'>$mod_title</option>";
	}
	
    eval("\$index_middle .= \" " . $mod->gettemplate('search_index_form') . "\";");
    
echo $index_middle;
?> 