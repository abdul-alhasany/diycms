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

  include("modules/" . $mod->module . "/settings.php");
  $action = $_GET['action'];
  
  if ($action == "delete_cat")
    {
      $perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
      $mod->permission($perm);
      
      $catid  = set_id_int(catid);
     
          $form = new form;
          
          $catresult = $diy_db->query("SELECT * FROM diy_blogs_cat WHERE cat_id != '$catid' ORDER BY cat_id");
          while ($array = $diy_db->dbarray($catresult))
            {
              $id             = $array['cat_id'];
              $cat_title      = $array['cat_title'];
              $cat_array[$id] = $cat_title;
            }
          $cat_choices = array(
              'delete_all' => $lang['MISC_DELETE_CAT_DELETE_ALL'] . "<br>",
              'move_and_delete' => $lang['MISC_DELETE_CAT_MOVE_DELETE']
          );
          
          $delete_cat_form .= $form->radio_selection($lang['MISC_DELETE_CAT_CHOOSE'], "delete_choice", $cat_choices);
          $delete_cat_form .= $form->selectform($lang['MISC_DELETE_CAT_CHOOSE_CAT'], "new_cat", $cat_array);
          
          
          $form_array = array(
              "action" => "mod.php?mod=blog&dir=control&modfile=misc&action=deleteing_cat_confirmed&catid=$catid",
              "title" => $lang['MISC_DELETE_CAT'],
              "name" => 'delete_cat',
              "content" => $delete_cat_form,
              "submit" => 'Submit'
          );
          
          $index_middle .= $form->form_table($form_array);
          echo $index_middle;
      
    }
  elseif ($action == "deleteing_cat_confirmed")
    {
      $perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
      $mod->permission($perm);
      
      $catid = set_id_int(catid);

      $submit = $_POST['submit'];
      if ($submit)
        {
          extract($_POST);
          
          // check the admin choice (delete all posts or move posts and delete category)
          if ($delete_choice == 'delete_all')
            {
                  // Check if there is any posts under this category
                  $num = $diy_db->dbnumquery("diy_blogs", "cat_id=$catid");
                  if ($num > '0')
                    {
                      $result = $diy_db->query("SELECT * FROM diy_blogs Where cat_id='$catid'");
                      while ($row = $diy_db->dbarray($result))
                        {
                          extract($row);
                          $result = $diy_db->query("DELETE FROM diy_blogs WHERE cat_id= '$catid'");
						  
                          // Check comments and remove them
						  $result = $diy_db->query("DELETE FROM diy_blogs_comments WHERE blog_id= '$blog_id'");
                        }
                    }
                
            }
          elseif ($delete_choice == 'move_and_delete')
            {
                  // Check if there are any posts under this category
                  $num = $diy_db->dbnumquery("diy_blogs", "cat_id=$catid");
                  if ($num > '0')
                    {
                      $result = $diy_db->query("UPDATE diy_blogs SET cat_id='$new_cat' WHERE cat_id='$catid'");
                     $result = $diy_db->query("UPDATE diy_blogs_comments SET cat_id='$new_cat' WHERE cat_id='$catid'");
                    }
            }
          
          $result = $diy_db->query("DELETE FROM diy_blogs_cat WHERE cat_id= '$catid'");
          info_message($lang['MISC_DELETE_CAT_SUCCESSFUL'], "mod.php?mod=blog&dir=control&modfile=viewcat");
          
        }
    }
  elseif ($action == "delete_post")
    {
      $blogid             = set_id_int('blogid');
      $approve_posts_perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);
      if ($approve_posts_perm)
        {
		
          $diy_db->query("DELETE FROM diy_blogs WHERE blog_id='$blogid'");
          $diy_db->query("DELETE FROM diy_blogs_comments WHERE blog_id='$blogid'");
          
          
          info_message($lang['MISC_DELETE_POST_SUCCESSFUL'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
          
        }
      else
        {
          info_message($lang['MISC_DELETE_POST_NOT_ALLOWED'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
        }
    }
	  elseif ($action == "delete_comment")
    {
      $blogid         = set_id_int('blogid');
      $comment_id     = set_id_int('comment_id');
	  
      $approve_posts_perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);
      if ($approve_posts_perm)
        {
		
          $diy_db->query("DELETE FROM diy_blogs_comments WHERE comment_id ='$comment_id' AND blog_id='$blogid'");

          info_message($lang['MISC_DELETE_POST_SUCCESSFUL'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
          
        }
      else
        {
          info_message($lang['MISC_DELETE_POST_NOT_ALLOWED'], "mod.php?mod=blog&dir=control&modfile=approve_posts");
        }
    }
	else
	{
		info_message($lang['MISC_NO_ACTIONS_SELECTED'], "mod.php?mod=blog&dir=control");
	}
  
?>