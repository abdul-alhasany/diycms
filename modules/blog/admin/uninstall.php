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

// check that the file is not run directly
if (RUN_SECTION !== true)
{
    die ("<center><h3>".lang('ACCESS_NOT ALLOWED')."</h3></center>");
}

 if (($_GET['step'] == '0') || ($_GET['step'] == '')) {
     	$form = "<tr><td>";
	$form .= $admin_lang['UNINSTALL_CONFIRM'];
	$form .= "</td></tr>";
	
	$form_array = array(
         "action" 	=> "sections.php?section=modules&file=uninstall&module=$module&&modid=$id&step=1&".$auth->get_sess(),
         "title" 	=> $admin_lang['UNINSTALL_MOUDLE'],
         "name" 	=> 'settings',
         "content" 	=> $form,
         "submit" 	=> 'Yes',
		);
	 
	$output = form_output($form_array);
	echo $output;
 } elseif ($_GET['step'] == '1') {
$modid = $_GET['modid'];
     $query   = array();
     $query[] = "DELETE from diy_modules where id='$modid'";
     
     
     foreach ($query as $line) {
         $k++;
       if (!mysql_query($line)) {
             $query_cid = $k;
             echo "<table>";
             echo "<tr>";
             echo "<td>$admin_lang[UNINSTALL_DONE_ERROR]</td>";
             echo "</tr>";
             echo "<tr>";
             print "<td dir=ltr>" . mysql_error() . '</td>';
             echo "</tr>";
             echo "<tr>";
             echo "<td><b>$admin_lang[QUERY]</b></td>";
             echo "</tr>";
             echo "<tr>";
             echo "<td align=left>$line</td>";
             echo "</tr></table>";
             
             print "<hr noshade size=\"1\">\n";
             $false = true;
         }
     }
     
     if (!$false == true) {
         $modid = $_GET[modid];
		 $diy_db->query("DROP TABLE IF EXISTS `diy_blogs`;");
		 $diy_db->query("DROP TABLE IF EXISTS `diy_blogs_cat`;");
		 $diy_db->query("DROP TABLE IF EXISTS `diy_blogs_comments`;");
		 
         $diy_db->query("DELETE FROM diy_modules_templates where modid='$modid';");
         $diy_db->query("DELETE from diy_modules_settings where set_mod='$module';");
         $diy_db->query("DELETE from diy_module_tempgroup where modid='$modid';");
		 $diy_db->query("DELETE from diy_menu where modid='$modid';");
     }
     
     if ($false == true) {
         $msg = $admin_lang['UNINSTALL_DONE_ERROR'];
     } else {
         $msg = $admin_lang['UNINSTALL_DONE'];
     }
     
    $content = info_msg($msg, "sections.php?section=modules&".$auth->get_sess());
	 echo $content;
 }
?>