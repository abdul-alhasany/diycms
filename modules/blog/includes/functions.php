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
 

 if (RUN_MODULE !== true) {
     die("<center><h3>Not Allowed!</h3></center>");
 }
 
 //---------------------------------------------------
 // get blog tags
 //---------------------------------------------------
 
 function get_blog_tags($tags)
 {
     $tags = explode('،', $tags);
	 foreach ($tags as $tag)
	 {
		$tag = str_replace(' ', '-', $tag);
		$tags_array[] = "<a href='mod.php?mod=blog&modfile=tags&tag=".$tag."'>$tag</a>";
	 }
	 $implode = implode('، ', $tags_array);
	 return $implode;
 }
 
 //---------------------------------------------------
 // Change the subscribtion status for the post
 //---------------------------------------------------
 
 function alert_status($id)
 {
     global $diy_db;
     if (isset($_COOKIE['cid'])) {
         $result = $diy_db->query("SELECT * FROM diy_subscriptions
                                       WHERE postid='$id' AND module ='blog' AND
                                       userid='" . $_COOKIE['cid'] . "' LIMIT 1");
         
         if ($diy_db->dbnumrows($result) > 0) {
             $diy_db->query("UPDATE diy_subscriptions SET alert_sent='no'
                                            WHERE postid='$id' AND module ='blog' AND
                                            userid='" . $_COOKIE['cid'] . "'");
         }
     }
 }
 
 //---------------------------------------------------
 // The navigation line located to the top of the blog module
 //---------------------------------------------------
 function breadcrumb($cat_id = '', $title = '')
 {
     global $mod;
     include("modules/" . $mod->module . "/includes/breadcrumb.class.php");
     
     if ($cat_id == '') {
         $cat_id = intval($_GET['catid']);
     }
     
     $nav_bits = new nav_bits;
     $nav_bits = $nav_bits->create_nav_bits($cat_id);
     
     $sitetitle = get_global_setting("sitetitle");
     
     eval("\$template .=\"" . $mod->gettemplate('blog_breadcrumb') . "\";");
     return $template;
 }
 

 
 //---------------------------------------------------
 // Admin and modertators jumb menu                  /
 //---------------------------------------------------
 function admin_jumpmenu($blogid, $status)
 {
     global $lang;
     
     $Jump = "<table border='0'width='90%' cellspacing='0' cellpadding='0'>\n";
     $Jump .= "<tr>\n";
     $Jump .= "<td width='100%'  align='center'>\n";
     $Jump .= "<form name='Jump'>\n";
     $Jump .= "<font size=2>\n";
     $Jump .= "<b> {$lang['INCLUDES_FUNCTIONS_ADMIN_MENU']}</b>\n";
     $Jump .= "<select name='Menu' onChange='location=document.Jump.Menu.options[document.Jump.Menu.selectedIndex].value;' value='GO'>\n";
     $Jump .= "<option>{$lang['INCLUDES_FUNCTIONS_ADMIN_MENU_CHOOSE']}</option>\n";
     $Jump .= "<option value='mod.php?mod=blog&modfile=editpost&blogid=$blogid'>{$lang['INCLUDES_FUNCTIONS_ADMIN_MENU_EDIT']}</option>\n";

     $Jump .= "</select>\n";
     $Jump .= "</font>\n";
     $Jump .= "</form>\n";
     $Jump .= "</td></tr></table>";
     return $Jump;
 }
 
 
 
 //-------------------------------------------------------------
 // This function gets the comment url in case it is edited  
 //-------------------------------------------------------------
 
 function get_comment_url($blogid, $comment_id)
 {
     global $diy_db, $mod;
     
     $comments_per_page = $mod->setting("comments_per_page");
     $numrows           = $diy_db->dbnumquery("diy_blogs_comments", "blog_id ='$blogid' AND allow='yes'");
     
     $comment_results = $diy_db->query("SELECT * FROM diy_blogs_comments
								WHERE blog_id='$blogid'
								AND allow='yes'
								ORDER BY comment_id ASC");
     while ($row = $diy_db->dbarray($comment_results)) {
         extract($row);
         $comment_array[] = $commentid;
     }
     
     
     foreach ($comment_array as $c_key => $c_value) {
         if ($c_value == $comment_id)
             $comment_key = $c_key;
     }
     
     if ($numrows > $comments_per_page) {
         $pages                  = ceil($numrows / $comments_per_page);
         $cpp                    = '0';
         $last_comments_per_page = $comments_per_page;
         for ($i = 0; $i < $pages; $i++) {
             $page_array[] = "$cpp,$last_comments_per_page";
             $cpp += $comments_per_page;
             $last_comments_per_page += $comments_per_page;
         }
         
         foreach ($page_array as $page_key => $page_value) {
             $after  = strstr($page_value, ',');
             $length = strlen($after);
             $before = substr($page_value, 0, -$length);
             $after  = substr($after, 1);
             
             if (($comment_key >= $before) && ($comment_key < $after)) {
                 $start    = $page_value;
                 $nextpage = $comments_per_page * ($pages - 1);
                 $page_key = $page_key + 1;
                 $url      = "mod.php?mod=blog&modfile=blogid&blogid=$blogid&start=$before&page=$page_key#comment$comment_id";
                 
             }
             
         }
     } else {
         $url = "mod.php?mod=blog&modfile=viewpost&blogid=$blogid#comment$comment_id";
     }
     return $url;
 }
 
 /**
  * page_infomration()
  * 
  * @param mixed $title
  * @param mixed $post
  * @return
  */
 function page_infomration($title, $post)
	{
	global $function_contents;
	require_once("includes/keyword_generator.class.php");
	$params['content'] = $post;
	
	$keyword = new autokeyword($params);
	$autoKeywords = $keyword->get_keywords();
	
	
	$text = preg_replace('@<title>(.+?)</title>@i', "<title>$title - ". get_global_setting("sitetitle")."</title>", $function_contents['page_header']);
	$text = preg_replace('@</head>@i', "<META content=\"" . get_global_setting("keywords") . "," . $autoKeywords . "\" name=\"keywords\"></head>", $text);
	
	return $text;
	}
	

function view_attachment_images($id, $location, $post)
{
    global $mod, $lang, $diy_db;
    $image_types = 'gif,png,jpg,jpeg';
    $image_types = explode(',', $image_types);
    
    $attachment_array[] = '';
    $result             = $diy_db->query("SELECT * FROM diy_upload
						WHERE module='blog'
						AND post_id='$id'
						AND location='$location'
						ORDER BY upid ASC");
    
    if ($diy_db->dbnumrows($result) > 0) {
        while ($rowfile = $diy_db->dbarray($result)) {
            extract($rowfile);
            $extension          = strtolower($extension);
            $attachment_array[] = array(
                $extension,
                $upid,
                $name
            );
        }
        
        foreach ($attachment_array as $attachment_id => $details) {
            if (in_array($details[0], $image_types)) {
                $post = str_replace('[attachment:'.$attachment_id.']', "<img src=\"mod.php?mod=blog&modfile=misc&action=view_attachment&upid=$details[1]&fullpage=1\">", $post);
            }
        }
        
    }
	return $post;
}

//---------------------------------------------------
 // This function retrives the attachment for a given post
 //----------------------------------------
 /**
  * get_attachment()
  * 
  * @param mixed $id
  * @param string $parentid
  * @return
  */
 function get_attachment($id, $location)
 {
     global $mod, $lang, $diy_db;
     $result = $diy_db->query("SELECT * FROM diy_upload
						WHERE module='blog'
						AND post_id='$id'
						AND location='$location'");
     
     if ($diy_db->dbnumrows($result) > 0) {
	 while($rowfile =$diy_db->dbarray($result))
        {
         extract($rowfile);
         $extension = strtolower($extension);
         $size    = format_Size($size);
		 
		 $i++;
		 $download .= "<tr><td><div class=\"article_info\">";
		 $download .= "<a href=\"mod.php?mod=blog&modfile=misc&action=attachment&upid=$upid&fullpage=1\">$name</a> ($size - $clicks)";
		 $download .= "</div></td></tr>";

     }
	  eval("\$attachment .=\"" . $mod->gettemplate('blog_view_attachment') . "\";");
	  return $attachment;
 }
 }	
?>