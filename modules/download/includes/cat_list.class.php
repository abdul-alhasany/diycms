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

class category_list
{
  var $Main = array();
  var $Sub = array();
  var $Url;
  var $Type;

  /**
   * category_list::build_list()
   * 
   * @param mixed $Master
   * @param integer $Type
   * @return
   */
  /**
   * category_list::build_list()
   * 
   * @param mixed $Master
   * @param integer $Type
   * @return
   */
  function build_list($Master, $Type = 1)
  {
    $this->Main = $this->SetMain($Master);
    $this->Sub = $this->SetSub($Master);
    $this->Url = $Url;
    $this->Type = $Type;
    return $this->Build();
  }

  /**
   * category_list::SetMain()
   * 
   * @param mixed $Master
   * @return
   */
  /**
   * category_list::SetMain()
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
   * category_list::SetSub()
   * 
   * @param mixed $Master
   * @return
   */
  /**
   * category_list::SetSub()
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
   * category_list::Build()
   * 
   * @return
   */
  /**
   * category_list::Build()
   * 
   * @return
   */
  function Build()
  {
    global $mod;
    $Mna = "-";
    $size = sizeof($this->Main);
    for ($i = 0; $i < $size; $i++)
    {
      $catid = $this->Main[$i]['catid'];
      $cat_title = $this->Main[$i]['cat_title'];
      $title = "<font style=color: #ffffff>$cat_title</font>";
      $tdcolor = "bgcolor=#F6F6F6";

      eval("\$Form .= \" " . $mod->gettemplate('download_control_viewcat_row') . "\";");

      $Form .= $this->SubList($this->Main[$i]['catid'], $Mna);
      $Mna++;
    }

    //Free Memory
    unset($this->Main);
    unset($this->Sub);
    return $Form;
  }

  /**
   * category_list::SubList()
   * 
   * @param mixed $id
   * @param mixed $Mn
   * @param string $Sn
   * @return
   */
  /**
   * category_list::SubList()
   * 
   * @param mixed $id
   * @param mixed $Mn
   * @param string $Sn
   * @return
   */
  function SubList($id, $Mn, $Sn = "")
  {
    global $mod;
    $b_id = array();

    $b_title = array();
    for ($i = 0; $i < sizeof($this->Sub); $i++)
    {
      if ($id == $this->Sub[$i]['parent'])
      {
        $b_id[] = $this->Sub[$i]['catid'];
        $b_title[] = $this->Sub[$i]['cat_title'];

      }
    }

    if (empty($b_id))
    {
      return;
    }
    else
    {
      $Sn = 1;
    }

    if (count($b_id) > 1)
    {
      for ($i = 0; $i < sizeof($b_id); $i++)
      {
        $catid = $b_id[$i];

        $title = "--$Mn $b_title[$i]";
        eval("\$Form .= \" " . $mod->gettemplate('download_control_viewcat_row') . "\";");
        $Mn2 = "-" . $this->ListType($b_title[$i]);
        $Form .= $this->SubList($catid, $Mn2);
        $Sn++;
      }
    }
    else
    {
      $catid = $b_id[0];
      $title = "--$Mn $b_title[0]";
      eval("\$Form .= \" " . $mod->gettemplate('download_control_viewcat_row') . "\";");
      $Mn2 = "----" . $this->ListType($b_title[0]);
      $Form .= $this->SubList($b_id[0], $Mn2, $Sn);
    }
    //Free Memory
    unset($b_id);
    unset($b_title);
    return $Form;
  }

  /**
   * category_list::ListType()
   * 
   * @param mixed $b_title
   * @return
   */
  /**
   * category_list::ListType()
   * 
   * @param mixed $b_title
   * @return
   */
  function ListType($b_title)
  {
    if ($this->Type > 2) $this->Type = 1;
    if ($this->Type == 1)
    {
      return "---";
    }
    else
      if ($this->Type == 2)
      {
        return $b_title;
      }
  }
} // End class


?> 