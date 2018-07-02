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
  * This file is part of news module
  * 
  * @package	Modules
  * @subpackage	News
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */ 
 
 include("modules/" . $mod->module . "/settings.php");
 include("modules/" . $mod->module . "/includes/cat_counter.class.php");
 
  $cat_id      = set_id_int('catid');
  
 $index_middle = breadcrumb($cat_id);
 
 $view_cat = cat_perm($cat_id, groupview, $_COOKIE['cgroup']);
 $mod->permission($view_cat);
 

 // View subcategoris
 $newsColcount = $mod->setting('cat_per_row');
 if ($newsColcount < 1)
     $newsColcount = 1;
 
 
 $result = $diy_db->query("SELECT * FROM diy_news_cat WHERE parent='$cat_id' ORDER BY cat_order ASC");
 //$index_middle .= "<center><table border='0' width='100%' align='center' cellpadding='" . $newsColcount . "'><tr>";
 $index_middle .= "<div class='categories_row'>";
 while ($row = $diy_db->dbarray($result)) {
     extract($row);
	 $row = format_data_out($row);
     $imagefile = get_file_path("$catid.newscat");
     if (file_exists($imagefile))
         $cat_image = "<img border=0 src=filemanager.php?action=getimage&info=$catid;newscat;news>";
	
	 $count = count_posts_comments($catid);
	 
     // get the number of topics and comments count
     $numrows         = $count['topics_count'];
     $numcomment      = $count['comments_count'];
	 
     $tdwidth = 100 / $newsColcount;
   //  $index_middle .= "<td align=\"center\" width=\"" . $tdwidth . "%\"  valign=\"top\">";
     eval("\$index_middle .= \" " . $mod->gettemplate('news_index_cat') . "\";");
   //  $index_middle .= "</td>";
     $count++;
     if ($count == $newsColcount) {
         $index_middle .= "</div>";
         $count = 0;
     }
 }
 $index_middle .= "</div>";
eval("\$index_middle .= \" " . $mod->gettemplate('news_cat_tools') . "\";");

 // view the posts in this category
 $posts_per_page    = $mod->setting("posts_per_page");

 $sort_by           = $mod->setting("sort_posts_by");
 $getorder_by       = $mod->setting("order_posts_by");

 if ($getorder_by == "last_added") {
     $order_by = '.date_added';
 } elseif ($getorder_by == "last_added_comment") {
     $order_by = '_comment.date_added';
 } elseif ($getorder_by == "comments_number") {
     $order_by = '.comments_no';
 } elseif ($getorder_by == "readers") {
     $order_by = '.readers';
 }


 $topics_number = $diy_db->dbnumquery("diy_news", "cat_id=$cat_id AND allow = 'yes'");
 

     $result = $diy_db->query("SELECT diy_news.*,COUNT(diy_news_comments.newsid) as numrows
                                FROM diy_news LEFT JOIN diy_news_comments
                                ON diy_news.newsid = diy_news_comments.newsid
                                WHERE diy_news.cat_id='$cat_id'
                                AND diy_news.allow = 'yes'
                                GROUP BY diy_news.newsid
                                ORDER BY diy_news.status, diy_news$order_by $sort_by
								LIMIT $start,$posts_per_page");
     
     while ($row = $diy_db->dbarray($result)) {
         extract($row);
         $row   = format_data_out($row);
         $name    = format_data_out($username);
         $date    = format_date($date_added);
         
		 if($status == 0)
		 $title = "Sticky : ".$title;
		 
         $head_letters = $mod->setting("post_head_letters");
         if (($head_letters != 0) && ($topics_number > 0)) {
             $post  = limit_text_view($post, $head_letters);
             eval("\$index_middle .= \" " . $mod->gettemplate('news_list_post_head') . "\";");
         } else {
             eval("\$list_row .= \" " . $mod->gettemplate('news_list_topics_row') . "\";");
         }
     }
 
 if (($head_letters == 0) && ($topics_number > 0)) {
     eval("\$index_middle .= \" " . $mod->gettemplate('news_list_topics') . "\";");
 }
 
 
 $index_middle .= pagination($topics_number, $posts_per_page, "mod.php?mod=news&modfile=list&catid=$cat_id");
 echo $index_middle;
 
?>