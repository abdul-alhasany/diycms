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
 
 if (TURN_BLOCK_ON !== true) {
     die("<center><h3>You are not allowed to access this file directly</h3></center>");
 }
 global $mod;
 
 $result = $diy_db->query("SELECT * FROM diy_blogs
						ORDER BY date_added ASC");
 while ($row = $diy_db->dbarray($result)) {
     extract($row);
	 $month = date('n', $date_added);
	 $year = date ('Y', $date_added);
	 $month_name = date('F', $date_added);
	 $date_array[] = "$month|$year|$month_name";
 }
 $date_array = array_unique($date_array);
 foreach($date_array as $key)
 {
 $key = explode('|', $key);
 $index_middle .= "<li><a href=mod.php?mod=blog&modfile=archive&month=".$key[0]."&year=".$key[1].">".$key[2]." - ".$key[1]."</a>";
 }
 
 echo $index_middle;
 
?>