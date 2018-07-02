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

class nav_bits {

    var $Master = array();
    
    
    /**
     * nav_bits::create_nav_bits()
     * 
     * @param mixed $navid
     * @return
     */
    function create_nav_bits($navid)
    {
        global $diy_db;
        $result = $diy_db->query("SELECT catid,parent,cat_title FROM diy_news_cat ORDER BY catid ASC");

		
        while($row = $diy_db->dbarray($result))
        {
		extract($row);
            $Master[] = array ('id'=>$catid,
							   'subcat'=>$parent,
							   'title'=>$cat_title);
        }

        $this->Master = $Master;
        $CatTreeResult = $this->RemoveLast($this->SubList($navid),",");
        $StrToArray = explode(",",$CatTreeResult);
	
        for($i=0;$i < sizeof($StrToArray);$i++)
        {
            $GetInfo = explode("=",$StrToArray[$i]);
            $NewArray[] = array('id'=>$GetInfo[0],'title'=>$GetInfo[1]);
        }
		
        $NewArray = array_reverse($NewArray);

        for($i=0;$i<sizeof($NewArray);$i++)
        {
            $Last .='<a href="mod.php?mod=news&modfile=list&catid='.$NewArray[$i]['id'].'"> '.$NewArray[$i]['title'].' </a > » ';
        }
         $Last  = substr ($Last,0,strlen($Last)-4);
        return $Last;
    }

    /**
     * nav_bits::SubList()
     * 
     * @param mixed $id
     * @return
     */
    function SubList($id)
    {
        for($i=0;$i<sizeof($this->Master);$i++)
        {
            if($id==$this->Master[$i]['id'])
            {
                $InId .= $this->Master[$i]['id']."=".$this->Master[$i]['title'].",";
                if($this->Master[$i]['subcat']) $InId .= $this->SubList($this->Master[$i]['subcat']);
            }
        }
        return $InId;
    }

    /**
     * nav_bits::RemoveLast()
     * 
     * @param mixed $s
     * @param mixed $c
     * @param string $n
     * @return
     */
    function RemoveLast($s,$c,$n="")
    {
        if(empty($n)) $n=1;
        if(substr($s,strlen($s)-$n,$n)==$c){
            return substr($s,0,strlen($s)-$n);
        } else {
            return $s;
        }
    }

}
?>