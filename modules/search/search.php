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
    
    
    $index_middle = $mod->nav_bar($lang['SEARCH_SEARCH_RESULTS']);
	
	 $allow_search = $mod->setting('allow_search', $_COOKIE['cgroup']);
    $mod->permission($allow_search);
	
    $sid = set_id_int('search_id');
	// get search results from database
	
	$result = $diy_db->query("SELECT * FROM diy_search where search_id = $sid");
	$search_vars = $diy_db->dbarray($result);

	if($search_vars[scope] != '0')
	{
		// start building query, assign each query to the related module
		switch ($search_vars[scope]) {
		case 'forum':
			$query = "SELECT threadid as id, username, title, date_added, post
								 FROM diy_forum_threads
								 WHERE ";
			$link = "mod.php?mod=forum&modfile=viewpost&threadid=";
		break;
		case 'download':
			$query = "SELECT downid as id, username, title, date_added, post
								FROM diy_download_files
								WHERE ";
			$link = "mod.php?mod=download&modfile=view_file&downid=";
		break;
		case 'news':
			$query = "SELECT newsid as id, username, title, date_added, post
								FROM diy_news
								WHERE ";
			$link = "mod.php?mod=news&modfile=viewpost&newsid=";
		break;
		}
		
		// check if title or post are included
		$title_query 	= (strstr($search_vars['text_part'], 'title')) ? "title REGEXP '$search_vars[keywords]'" : '';	
		$post_query 	= (strstr($search_vars['text_part'], 'post')) ? "post REGEXP '$search_vars[keywords]'" : '';
		$opreator		= (strstr($search_vars['text_part'], ',')) ? ' OR ' : '' ;
		
		// get time scope
		$time_scope	= time() - $from;
		$time 		= " AND date_added > $time_scope";
		
		// get results and check results number
		$result = $diy_db->query($query.$title_query.$opreator.$post_query.$time);
		while($search_results = $diy_db->dbarray($result))
		{
		extract($search_results);
		$link = $link.$id;
		eval("\$results_rows .= \" " . $mod->gettemplate('search_results_single_module_row') . "\";");
		}
		eval("\$index_middle .= \" " . $mod->gettemplate('search_results_single_module_table') . "\";");

	}
	else
	{
	// if the search is set to everywhere
	// set some variables so we can display them later in the results table
    $result = $diy_db->query("SET @forum= 'forum', @download= 'download', @news= 'news';");
	$result = $diy_db->query("(SELECT threadid as id, username, title, date_added, post, @forum as scope
						FROM diy_forum_threads
						WHERE title REGEXP '$search_vars[keywords]'
						OR post REGEXP '$search_vars[keywords]')
						
						UNION
						
						(SELECT downid as id, username, title, date_added, post, @download as scope
						FROM diy_download_files
						WHERE title REGEXP '$search_vars[keywords]'
						OR post REGEXP '$search_vars[keywords]')
						
						UNION
						
						(SELECT newsid as id, username, title, date_added, post, @news as scope
						FROM diy_news
						WHERE title REGEXP '$search_vars[keywords]'
						OR post REGEXP '$search_vars[keywords]')
						
						LIMIT 0,30");
						
		while($search_results = $diy_db->dbarray($result))
		{
		extract($search_results);
		if($scope == 'forum') {
			$link = "mod.php?mod=forum&modfile=viewpost&threadid=$id";
		}
		elseif($scope == 'download')
		{
			$link = "mod.php?mod=download&modfile=view_file&downid=$id";
		}elseif($scope == 'news')
		{
			$link = "mod.php?mod=news&modfile=viewpost&highlight=$search_vars[keywords]&newsid=$id";
		}
		
		eval("\$results_rows .= \" " . $mod->gettemplate('search_results_table_row') . "\";");
		}
		
    eval("\$index_middle .= \" " . $mod->gettemplate('search_results_table') . "\";");
	}
	
    
echo $index_middle;
?> 