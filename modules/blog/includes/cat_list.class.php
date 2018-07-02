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


class category_list
{
    var $Main = array();
    var $Sub = array();
    var $Url;
    Var $Type;
    
    function build_list($Master, $Type = 1)
    {
        $this->Main = $this->SetMain($Master);
        $this->Sub  = $this->SetSub($Master);
        $this->Url  = $Url;
        $this->Type = $Type;
        return $this->Build();
    }
    
    function SetMain($Master)
    {
        $Main = array();
        for ($i = 0; $i < sizeof($Master); $i++) {
            if ($Master[$i]['parent'] == 0) {
                $Main[] = $Master[$i];
            }
        }
        return $Main;
    }
    
    function SetSub($Master)
    {
        $Sub = array();
        for ($i = 0; $i < sizeof($Master); $i++) {
            if ($Master[$i]['parent'] !== 0) {
                $Sub[] = $Master[$i];
            }
        }
        return $Sub;
    }
    
    function Build()
    {
        global $mod;
        $Mna  = "-";
        $size = sizeof($this->Main);
        for ($i = 0; $i < $size; $i++) {
            $catid     = $this->Main[$i]['catid'];
            $cat_title = $this->Main[$i]['cat_title'];
            $title     = "<font style=color: #ffffff>$cat_title</font>";
            $tdcolor   = "bgcolor=#F6F6F6";
            
            eval("\$form .= \" " . $mod->gettemplate('blog_control_viewcat_row') . "\";");
            
            $form .= $this->SubList($this->Main[$i]['catid'], $Mna);
            $Mna++;
        }
        
        //Free Memory
        unset($this->Main);
        unset($this->Sub);
        return $form;
    }
	
    function SubList($id, $Mn, $Sn = "")
    {
        global $mod;
        $b_id = array();
        
        $b_title = array();
        for ($i = 0; $i < sizeof($this->Sub); $i++) {
            if ($id == $this->Sub[$i]['parent']) {
                $b_id[]    = $this->Sub[$i]['catid'];
                $b_title[] = $this->Sub[$i]['cat_title'];
                
            }
        }
        
        if (empty($b_id)) {
            return;
        } else {
            $Sn = 1;
        }
        
        if (count($b_id) > 1) {
            for ($i = 0; $i < sizeof($b_id); $i++) {
                $catid = $b_id[$i];
                
                $title = "--$Mn $b_title[$i]";
                eval("\$Form .= \" " . $mod->gettemplate('blog_control_viewcat_row') . "\";");
                $Mn2 = "-" . $this->ListType($b_title[$i]);
                $Form .= $this->SubList($catid, $Mn2);
                $Sn++;
            }
        } else {
            $catid = $b_id[0];
            $title = "--$Mn $b_title[0]";
            eval("\$Form .= \" " . $mod->gettemplate('blog_control_viewcat_row') . "\";");
            $Mn2 = "----" . $this->ListType($b_title[0]);
            $Form .= $this->SubList($b_id[0], $Mn2, $Sn);
        }
        //Free Memory
        unset($b_id);
        unset($b_title);
        return $Form;
    }
	
    function ListType($b_title)
    {
        if ($this->Type > 2)
            $this->Type = 1;
        if ($this->Type == 1) {
            return "---";
        } else if ($this->Type == 2) {
            return $b_title;
        }
    }
} // End class
?> 