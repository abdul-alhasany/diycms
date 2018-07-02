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
 
 if (RUN_MODULE !== true) {
   die("<center><h3>Not Allowed!</h3></center>");
 }
 
 include("modules/" . $mod->module . "/settings.php");
 
 $index_middle = $mod->nav_bar($lang['CONTROL_VIEWCAT']);
 
 $perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
 $mod->permission($perm);
 
 
 $start = (!isset($_GET['start'])) ? '0' : $_GET['start'];
 
 $result = $diy_db->query("SELECT cat_id,cat_title FROM diy_blogs_cat ORDER BY cat_id DESC");
 
 while ($row = $diy_db->dbarray($result)) {
   extract($row);
   $tdcolor = "bgcolor=#F6F6F6";
   eval("\$blog_row .= \" " . $mod->gettemplate('blog_control_viewcat_row') . "\";");
 }
 
 eval("\$index_middle .= \" " . $mod->gettemplate('blog_control_viewcat') . "\";");
 
 
 $numrows = $diy_db->dbnumquery("diy_blogs_cat", "");
 $index_middle .= pagination($numrows, '100', "mod.php?mod=blogs&dir=control&modfile=viewcat");
 echo $index_middle;
 
?>