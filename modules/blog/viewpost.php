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


include("modules/".$mod->module."/settings.php");

		$start =(!isset($_GET['start'])) ? '0' : $_GET['start'];

		$blogid = set_id_int('blogid');

    $row = $diy_db->dbfetch("SELECT diy_blogs.*,diy_users.userid,diy_users.username,
                                 diy_users.register_date,diy_users.all_posts,diy_users.signature,
                                 diy_users.website,diy_users.avatar,diy_users.groupid
								 FROM diy_blogs,diy_users
                                 WHERE draft='0'
								 AND blog_id='$blogid'
								 AND diy_blogs.user_id = diy_users.userid
								 LIMIT 1");
  
   if(empty($row))error_message('LANG_ERROR_URL');
    extract($row);
	
	hook_function('page_header', 'page_infomration', 'override', array(
		$title,
		$title . $post
	));

	// Build user groups array
	$usergroup = $diy_db->query("SELECT groupid,grouptitle FROM diy_groups ");
	while($groups_row = $diy_db->dbarray($usergroup)){
	$gid       	=  $groups_row['groupid'];
	$group_array[$gid] =  $groups_row['grouptitle'];
	}
	
	// build user ranks array
	$userranks = $diy_db->query("SELECT * FROM diy_userranks");
	while($user_ranks = $diy_db->dbarray($userranks)){
	extract($user_ranks);
	$rank_array[$posts_no][$rank_title] =  $repetition;
	}

	
    $index_middle .= breadcrumb($cat_id,$cat_title);
    $row         =  format_data_out($row);
	
    $post   = replace_censored_words ($post);
	$post 	= view_attachment_images($blogid, 'post', $post);
	$post	= post_output($post, get_group_setting('editor_type'));
	$post 	= replace_smile_images($post);
	$post   = highlight_words($post);
	
	
	
    $diy_db->query("UPDATE diy_blogs SET readers = readers+1 WHERE blog_id = '$blog_id'");
    alert_status($blog_id);

    if ($start == 0)
    {
	$userrank = get_user_rank($rank_array,$all_posts);
	$usergroup = get_user_group($group_array,$groupid);
        if(( $userid == 0) || ($userid == $CONF['Guest_id']))
        {
             $usertitle    =  $username;
             $username     =  format_data_out($username);
             $date_added     =  format_date($date_added);
             $allposts     =  1;
        }
        else
        {
			$username     =  format_data_out($username);
            $website      =  add_to_url ($website);
            $signature     =  format_data_out ($signature);
            
		    $avatarfile = get_file_path("$userid.avatar");
		    if(file_exists($avatarfile)){
		       $avatar_pic = "<img src=filemanager.php?action=avatar&userid=".$userid."><br>";
		    }else{
		       unset($avatar_pic);
		    }
             
        }

        $date   =  format_date($date_added)." ".format_time($date_added);
		$tags 	= get_blog_tags($tags);
		$attachment = get_attachment($blog_id, 'post');
		
        eval("\$index_middle .= \" " . $mod->gettemplate ( 'blog_viewpost_post' ) . "\";");
		
		    
    
	$edit_perm = $mod->setting('edit_all_posts',$_COOKIE['cgroup']);
	if($edit_perm)
	{
        $index_middle .= admin_jumpmenu($blog_id,$status);
	}
    }
	
     // check whether the post is closed or not
	 $add_perm        = $mod->setting('add_post', $_COOKIE['cgroup']);
	 if($add_perm)
	 $add_blog	= '<a href="mod.php?mod=blog&modfile=addpost"><img src="modules/blog/images/1/add_post.gif" border="0"></a>';
	 
    if($allow_comments == '1')
	$add_comment = "<a href=\"mod.php?mod=blog&modfile=addcomment&blogid=$blog_id&cat_id=$cat_id\"><img border='0' src=\"modules/blog/images/1/replay.gif\"></a>";

	
// Check if the post has comments or not
   if($comments_no > 0)
    {
	 $comments_per_page   = $mod->setting("comments_per_page");
	     $numrows = $diy_db->dbnumquery("diy_blogs_comments","blog_id='$blogid' AND allow='yes'","comment_id");
         $pagenum = pagination($numrows,$comments_per_page,"mod.php?mod=blog&modfile=viewpost&blogid=$blogid");
         eval("\$index_middle .=\" " . $mod->gettemplate ( 'post_tools' ) . "\";");
		 
         $result = $diy_db->query("SELECT diy_blogs_comments.*,diy_users.userid,diy_users.username,
                                 diy_users.register_date,diy_users.all_posts,diy_users.signature,
                                 diy_users.website,diy_users.avatar,diy_users.groupid
								 FROM diy_blogs_comments,diy_users
                                 WHERE blog_id='$blogid'
								 AND allow='yes'
								 AND diy_blogs_comments.user_id = diy_users.userid
								 ORDER BY comment_id ASC
                                 LIMIT $start,$comments_per_page");

         while($row =$diy_db->dbarray($result))
        {
             extract($row);
			 $row = format_data_out($row);
             if(($userid == 0 ) || ($userid == $CONF['Guest_id'] ))
             {
				 $usergroup 	= get_user_group($group_array,$groupid);
                 $usertitle    =  $username;
                 $datetime     =  format_date($register_date);
                 $allposts     =  1;
				 $userrank 		= get_user_rank($rank_array,'1');
             }
             else
             {
			$userrank = get_user_rank($rank_array,$all_posts);
			$usergroup = get_user_group($group_array,$groupid);
            $datetime      =  format_date($register_date);
            $signature =  format_data_out($signature);
             }
			 
            $comment    = replace_censored_words($comment);
			$comment	= post_output($comment, get_group_setting('editor_type'));
			$comment 	= replace_smile_images($comment);
			$comment    = highlight_words($comment);
            $date       = format_date($date_added)." ".format_time($date_added);

			$avatarfile = get_file_path("$userid.avatar");
		    if(file_exists($avatarfile)){
		       $avatar_pic = "<img src=filemanager.php?action=avatar&userid=".$userid."><br>";
		    }else{
		       unset($avatar_pic);
			}
			
	// check whether the post is closed or not
      $replay_img = ($allow_comments == '0') ? "close.gif" : "replay.gif";
        
		
		eval("\$index_middle .= \"" . $mod->gettemplate ( 'blog_view_comment' ) . "\";");
		}
		
	eval("\$index_middle .= \" " . $mod->gettemplate ( 'blog_post_tools' ) . "\";");
    }
    else
    {
        eval("\$index_middle .= \" " . $mod->gettemplate ( 'blog_post_tools' ) . "\";");
    }

	echo $index_middle;
  
?>