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


class nav_bits {

    var $Master = array();
    
    
    function create_nav_bits($navid)
    {
        global $diy_db;
        $result = $diy_db->query("SELECT cat_id, cat_title FROM diy_blogs_cat ORDER BY cat_id ASC");

		
        while($row = $diy_db->dbarray($result))
        {
		extract($row);
            $Master[] = array ('id'=>$cat_id,
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
            $Last .='<a href="mod.php?mod=blog&modfile=list&catid='.$NewArray[$i]['id'].'"> '.$NewArray[$i]['title'].' </a > » ';
        }
         $Last  = substr ($Last,0,strlen($Last)-4);
        return $Last;
    }

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