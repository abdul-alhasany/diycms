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
 
 $index_middle = $mod->nav_bar($lang['CONTROL_ADDCAT']);
 
 $submit = $_POST['submit'];
 if ($submit) {
     extract($_POST);
     
     $fullarr = array(
         $title,
         $order
     );
     
     if (!required_entries($fullarr)) {
         error_message($lang['LANG_ERROR_VALIDATE']);
     }

     $order      = intval($order);

     $result = $diy_db->query("insert into diy_blogs_cat (cat_order,
                                                     cat_title
												)
                                              values
                                                    ('$order',
                                                    '$title'
													)");
     
     if ($result) {
         info_message($lang['CONTROL_ADDCAT_SUCCESSFUL'], "mod.php?mod=blog&dir=control&modfile=viewcat");
     } else {
         info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
     }
     
 } else {
     $form = new form;
         
	 for($i = 0; $i <= 50; $i++)
	 {
	 $number_array[] = $i;
	 }
	 
     $add_cat .= $form->inputform($lang['CONTROL_ADDCAT_TITLE'], "text", "title", "*");
	 $add_cat .= $form->selectform($lang['CONTROL_ADDCAT_ORDER'], "order", $number_array,"","*");

     $form_array = array(
         "action" => "mod.php?mod=blog&dir=control&modfile=addcat",
         "title" => "$lang[CONTROL_ADDCAT]",
         "name" => 'add_cat',
         "content" => $add_cat,
         "submit" => 'Submit'
     );
     
     $index_middle .= $form->form_table($form_array);
 }
 echo $index_middle;
?>