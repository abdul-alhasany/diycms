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

include("modules/" . $mod->module . "/settings.php");

$perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
$mod->permission($perm);

$index_middle = $mod->nav_bar($lang['CONTROL_EDITCAT']);

$catid = set_id_int('catid');


if ($_POST['submit']) {
   extract($_POST);
   
   $fullarr = array(
      $title,
      $order
   );
   
   if (!required_entries($fullarr)) {
      error_message($lang['LANG_ERROR_VALIDATE']);
   }
   
   $result = $diy_db->query("update diy_blogs_cat set cat_order = '$order',
                                                    cat_title= '$title'
													WHERE cat_id='$catid'
													");
   
   if ($result) {
      info_message($lang['CONTROL_EDITCAT_SUCCESSFUL'], 'mod.php?mod=blog&dir=control&modfile=viewcat');
   } else {
      info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
   }
   
} else {
   $form = new form;
   
   
   $catresult = $diy_db->query("SELECT * FROM diy_blogs_cat ORDER BY cat_id");
   
   for ($i = 0; $i <= 50; $i++) {
      $number_array[] = $i;
   }
   
   $result = $diy_db->query("SELECT * FROM diy_blogs_cat WHERE cat_id='$catid'");
   $row    = $diy_db->dbarray($result);
   extract($row);
   
   $editcat_form .= $form->inputform($lang['CONTROL_EDITCAT_TITLE'], "text", "title", "*", $cat_title);
   $editcat_form .= $form->selectform($lang['CONTROL_EDITCAT_ORDER'], "order", $number_array, $cat_order, "*");
   
   $form_array = array(
      "action" => "mod.php?mod=blog&dir=control&modfile=edit_cat&catid=$catid",
      "title" => "$lang[CONTROL_EDITCAT]",
      "name" => 'add_cat',
      "content" => $editcat_form,
      "submit" => 'Submit'
   );
   
   $index_middle .= $form->form_table($form_array);
}
echo $index_middle;
?>