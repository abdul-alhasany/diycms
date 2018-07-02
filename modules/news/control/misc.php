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
  $action = $_GET['action'];
  
  if ($action == "delete_cat_image")
    {
      $perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
      $mod->permission($perm);
      
      $catid      = set_id_int(catid);
      $avatarfile = get_file_path("$catid.newscat");
      if (!unlink($avatarfile))
        {
          error_message($lang['MISC_DELETE_CAT_IMAGE_UNSUCCESSFUL']);
        }
      else
        {
          info_message($lang['MISC_DELETE_CAT_IMAGE_SUCCESSFUL'], "mod.php?mod=news&dir=control&modfile=viewcat");
        }
    }
  elseif ($action == "delete_cat")
    {
      $perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
      $mod->permission($perm);
      
      $catid  = set_id_int(catid);
      // check if there is a sub category
      $subcat = $diy_db->dbnumquery("diy_news_cat", "parent=$catid");
      if ($subcat > 0)
        {
          error_message($lang['MISC_DELETE_CAT_CONTAIN_SUBCAT']);
        }
      else
        {
          $form = new form;
          
          $catresult = $diy_db->query("SELECT * FROM diy_news_cat WHERE catid != '$catid' ORDER BY catid");
          while ($array = $diy_db->dbarray($catresult))
            {
              $id             = $array['catid'];
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
              "action" => "mod.php?mod=news&dir=control&modfile=misc&action=deleteing_cat_confirmed&catid=$catid",
              "title" => $lang['MISC_DELETE_CAT'],
              "name" => 'add_cat',
              "content" => $delete_cat_form,
              "submit"	=>  LANG_FORM_ADD_BUTTON
          );
          
          $index_middle .= $form->form_table($form_array);
          echo $index_middle;
        }
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
              // check if there is a sub category
              $subcat = $diy_db->dbnumquery("diy_news_cat", "parent=$catid");
              if ($subcat > 0)
                {
                  error_message($lang['MISC_DELETE_CAT_CONTAIN_SUBCAT']);
                }
              else
                {
                  // Check if there is any posts under this category
                  $num = $diy_db->dbnumquery("diy_news", "cat_id=$catid");
                  if ($num > '0')
                    {
                      $result = $diy_db->query("SELECT * FROM diy_news Where cat_id='$catid'");
                      while ($row = $diy_db->dbarray($result))
                        {
                          extract($row);
                          // Check if there is an attachment and remove it
                          if ($uploadfile > 0)
                            {
                              $attachment = get_file_path("$newsid.news");
                              unlink($attachment);
                            }
                          // Check comments attachments and remove them
                          $comm_result = $diy_db->query("SELECT * FROM diy_news Where cat_id='$catid'");
                          while ($comm_row = $diy_db->dbarray($comm_result))
                            {
                              extract($comm_row);
                              if ($uploadfile > 0)
                                {
                                  $attachment = get_file_path("$commentid.newscomment");
                                  unlink($attachment);
                                }
                            }
                        }
                    }
                }
            }
          elseif ($delete_choice == 'move_and_delete')
            {
              $subcat = $diy_db->dbnumquery("diy_news_cat", "parent=$catid");
              if ($subcat > 0)
                {
                  error_message($lang['MISC_DELETE_CAT_CONTAIN_SUBCAT']);
                }
              else
                {
                  // Check if there are any posts under this category
                  $num = $diy_db->dbnumquery("diy_news", "cat_id=$catid");
                  if ($num > '0')
                    {
                      $result = $diy_db->query("UPDATE diy_news SET cat_id='$new_cat' WHERE cat_id='$catid'");
                      $result = $diy_db->query("UPDATE diy_news_comments SET cat_id='$new_cat' WHERE cat_id='$catid'");
                    }
                }
              
            }
          
          $result = $diy_db->query("DELETE FROM diy_news_cat WHERE catid= '$catid'");
          if ($result)
            {
              $avatarfile = get_file_path("$catid.newscat");
              unlink($avatarfile);
            }
          
          info_message($lang['MISC_DELETE_CAT_SUCCESSFUL'], "mod.php?mod=news&dir=control&modfile=viewcat");
          
        }
    }
  elseif ($action == "delete_post")
    {
      $newsid             = set_id_int('newsid');
      $approve_posts_perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);
      if ($approve_posts_perm)
        {
          $diy_db->query("DELETE FROM diy_news WHERE newsid='$newsid'");
          
          $result = $diy_db->query("SELECT * FROM diy_news_comments WHERE newsid='$newsid'");
          while ($row = $diy_db->dbarray($result))
            {
              extract($row);
              $filename = get_file_path("$commentid.newscomment");
              @unlink($filename);
              $diy_db->query("DELETE FROM diy_upload WHERE uppostid='$commentid' AND upcatid ='$newsid' AND module='news'");
            }
          $diy_db->query("DELETE FROM diy_news_comments WHERE newsid='$newsid'");
          
          
          info_message($lang['MISC_DELETE_POST_SUCCESSFUL'], "mod.php?mod=news&dir=control&modfile=approve_posts");
          
        }
      else
        {
          info_message($lang['MISC_DELETE_POST_NOT_ALLOWED'], "mod.php?mod=news&dir=control&modfile=approve_posts");
        }
    }
  
?>