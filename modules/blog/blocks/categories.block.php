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
 
 if($_GET['mod'] == 'blog')
 {
 global $mod;
 }
 else
 {
 $mod = new module('blog');
 }

 
 $result = $diy_db->query("SELECT * FROM diy_blogs_cat
						ORDER BY cat_order ASC");
 while ($row = $diy_db->dbarray($result)) {
     extract($row);
     
     eval("\$index_middle .= \" " . $mod->gettemplate('blog_block_categories') . "\";");
 }
 echo $index_middle;
 
?>