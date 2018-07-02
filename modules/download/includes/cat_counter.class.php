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
  * This file is part of download module
  * 
  * @package	Modules
  * @subpackage	Download
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

class cat_counter
{
  var $Main = array();
  var $Sub = array();

  /**
   * cat_counter::SetMain()
   * 
   * @param mixed $Master
   * @return
   */
  /**
   * cat_counter::SetMain()
   * 
   * @param mixed $Master
   * @return
   */
  function SetMain($Master)
  {
    $Main = array();
    for ($i = 0; $i < sizeof($Master); $i++)
    {
      if ($Master[$i]['parent'] == 0)
      {
        $Main[] = $Master[$i];
      }
    }
    return $Main;
  }

  /**
   * cat_counter::SetSub()
   * 
   * @param mixed $Master
   * @return
   */
  /**
   * cat_counter::SetSub()
   * 
   * @param mixed $Master
   * @return
   */
  function SetSub($Master)
  {
    $Sub = array();
    for ($i = 0; $i < sizeof($Master); $i++)
    {
      if ($Master[$i]['parent'] !== 0)
      {
        $Sub[] = $Master[$i];
      }
    }
    return $Sub;
  }

  /**
   * cat_counter::Build()
   * 
   * @param mixed $Master
   * @param mixed $catid
   * @return
   */
  /**
   * cat_counter::Build()
   * 
   * @param mixed $Master
   * @param mixed $catid
   * @return
   */
  function Build($Master, $catid)
  {
    $this->Main = $this->SetMain($Master);
    $this->Sub = $this->SetSub($Master);
    $topics_and_comments = $this->SubList($catid);

    //Free Memory
    unset($this->Main);
    unset($this->Sub);
    return $topics_and_comments;
  }

  /**
   * cat_counter::SubList()
   * 
   * @param mixed $id
   * @param string $count
   * @return
   */
  /**
   * cat_counter::SubList()
   * 
   * @param mixed $id
   * @param string $count
   * @return
   */
  function SubList($id, $count = '')
  {
    for ($i = 0; $i < sizeof($this->Sub); $i++)
    {
      if ($id == $this->Sub[$i]['parent'])
      {
        $b_id[] = $this->Sub[$i]['catid'];
        $topics[] = $this->Sub[$i]['countopic'];
        $comments[] = $this->Sub[$i]['countcomm'];

      }
    }

    if (empty($b_id))
    {
      return;
    }
    if (count($b_id) > 1)
    {
      for ($i = 0; $i < sizeof($b_id); $i++)
      {
        $topic_count += $topics[$i];
        $topic_count += $this->SubList($b_id[$i], 'topics');

        $comment_count += $comments[$i];
        $comment_count += $this->SubList($b_id[$i], 'comments');

      }
    }
    else
    {
      $comment_count += $this->SubList($b_id[0]);
      $topic_count += $this->SubList($b_id[0]);
    }

    //Free Memory
    unset($b_id);
    unset($topics);
    unset($comments);

    if ($count == 'topics')
    {
      return $topic_count;
    } elseif ($count == 'comments')
    {
      return $comment_count;
    }
    else
    {
      return "$topic_count=$comment_count";
    }
  }

} // End class


?>