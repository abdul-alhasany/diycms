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


function get_tag_cloud($tags) {

$tags = array_count_values($tags);
//arsort($tags);
		$max_size = 28; // max font size in pixels
        $min_size = 12; // min font size in pixels
       
        // largest and smallest array values
        $max_qty = max(array_values($tags));
        $min_qty = min(array_values($tags));
       
        // find the range of values
        $spread = $max_qty - $min_qty;
        if ($spread == 0) { // we don't want to divide by zero
                $spread = 1;
        }
       
        // set the font-size increment
        $step = ($max_size - $min_size) / ($spread);
       
        // loop through the tag array
        foreach ($tags as $key => $value) {
                // calculate font-size
                // find the $value in excess of $min_qty
                // multiply by the font-size increment ($size)
                // and add the $min_size set above
                $size = round($min_size + (($value - $min_qty) * $step));
       
                $tag_list .= '<a href="mod.php?mod=blog&modfile=tags&tag='.$key.'" style="font-size: ' . $size . 'px" 
title="' . $value . ' مدونة لديها الوسم ' . $key . '">' . $key . '</a> ';
        }

    
    return "<div style='text-align:justify'>$tag_list</div>";
}

$results = "SELECT tags FROM diy_blogs ORDER BY rand()";
$result  = $diy_db->query($results);
while ($row = $diy_db->dbarray($result)) {
    extract($row);

    $tags = explode('،', $tags);
    foreach ($tags as $newkey) {
	    $newkey = str_replace(' ', '-', $newkey);
        $newarray[] = $newkey;
    }
}
$tags_cloud = get_tag_cloud($newarray);
eval("\$index_middle .= \" " . $mod->gettemplate('blog_block_tags') . "\";");
echo $index_middle;

?>

