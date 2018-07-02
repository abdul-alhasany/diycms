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
require_once("includes/files.class.php");

$index_middle = $mod->nav_bar();

// close or open a topic
if ($_GET['action'] == "attachment") {
    $upid = set_id_int('upid');
    
    
    $result = $diy_db->query("SELECT * FROM diy_upload
							WHERE upid='$upid'");
    
    if ($diy_db->dbnumrows($result) > 0) {
        while ($rowfile = $diy_db->dbarray($result)) {
            extract($rowfile);
            $pathfile = get_file_path("$upid.blog");
            if (is_readable($pathfile)) {
                $filename = ($name) ? $name : basename($pathfile);
                
                header("Content-type: $type");
                header("Content-Disposition: attachment; filename=$filename");
                $readfile = Files::read($pathfile);
                echo $readfile;
                $diy_db->query("UPDATE diy_upload SET clicks = clicks+1
								WHERE upid = '$upid'");
                
            }
        }
    } else {
        error_message("File does not exist");
    }
    
    
} elseif ($_GET['action'] == "view_attachment") {
    $upid = set_id_int('upid');
	
    $image_name = $_GET['image_name'];
	$file = get_file_path("$upid.blog", 'blog');
    if (file_exists($file))
    {
      header("Content-type: image/gif");
      header("Content-disposition: inline; filename=$image_name");
      header("Content-Length: $filesize");
      header("Pragma: no-cache");
      header("Expires: 0");
      echo Files::read($file);

    }
    
    
}else {
    error_message($lang['MISC_NO_ACTIONS_SELECTED']);
    
}
?>