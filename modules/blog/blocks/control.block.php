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
 $lang = $mod->modInfo['mod_lang'];
 include("modules/" . $mod->module . "/lang/" . $lang . ".lang.php");
 
 $perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
 if ($perm) {
     $waiting_posts    = $diy_db->dbnumquery("diy_blogs", "draft != '0'");
     $waiting_comments = $diy_db->dbnumquery("diy_blogs_comments", "allow != 'yes'");
     
     eval("\$index_middle .= \" " . $mod->gettemplate('blog_block_admin') . "\";");
 }
 echo $index_middle;
 
?>