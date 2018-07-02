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
 
 
 class cat_counter
 {
     var $Main = array();
     var $Sub = array();
     
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
     
     function Build($Master, $catid)
     {
         $this->Main          = $this->SetMain($Master);
         $this->Sub           = $this->SetSub($Master);
         $topics_and_comments = $this->SubList($catid);
         
         //Free Memory
         unset($this->Main);
         unset($this->Sub);
         return $topics_and_comments;
     }
     
     function SubList($id, $count = '')
     {
         for ($i = 0; $i < sizeof($this->Sub); $i++) {
             if ($id == $this->Sub[$i]['parent']) {
                 $b_id[]     = $this->Sub[$i]['catid'];
                 $topics[]   = $this->Sub[$i]['countopic'];
                 $comments[] = $this->Sub[$i]['countcomm'];
                 
             }
         }
         
         if (empty($b_id)) {
             return;
         }
         if (count($b_id) > 1) {
             for ($i = 0; $i < sizeof($b_id); $i++) {
                 $topic_count += $topics[$i];
                 $topic_count += $this->SubList($b_id[$i], 'topics');
                 
                 $comment_count += $comments[$i];
                 $comment_count += $this->SubList($b_id[$i], 'comments');
                 
             }
         } else {
             $comment_count += $this->SubList($b_id[0]);
             $topic_count += $this->SubList($b_id[0]);
         }
         
         //Free Memory
         unset($b_id);
         unset($topics);
         unset($comments);
         
         if ($count == 'topics') {
             return $topic_count;
         } elseif ($count == 'comments') {
             return $comment_count;
         } else {
             return "$topic_count=$comment_count";
         }
     }
     
 } // End class
?>