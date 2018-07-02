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

|	This file is part of DiY-CMS.												|

|   DiY-CMS is free software: you can redistribute it and/or modify				|

|   it under the terms of the GNU General Public License as published by		|

|   the Free Software Foundation, either version 3 of the License, or			|

|   (at your option) any later version.											|

|   DiY-CMS is distributed in the hope that it will be useful,					|

|   but WITHOUT ANY WARRANTY; without even the implied warranty of				|

|   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the				|

|   GNU General Public License for more details.								|

|   You should have received a copy of the GNU General Public License			|

|   along with DiY-CMS.  If not, see <http://www.gnu.org/licenses/>.			|

+===============================================================================+

*/







function resize_image($matches)

{

    global $plugins, $CONF;

    $matches[0] = htmlspecialchars_decode($matches[0]);
	
    $clean_image = str_replace('<', ' ', $matches[0]);

    $clean_image = str_replace('>', ' ', $clean_image);

    

    $image_array = explode(' ', $clean_image);

    //print_r($image_array);

    foreach ($image_array as $key => $propriety) {

        // search if width or height attrbuite exist already and remove them

        if (stristr($propriety, 'width'))

            unset($image_array[$key]);

        

        if (stristr($propriety, 'height'))

            unset($image_array[$key]);

        

        if (stristr($propriety, 'src'))

		{

            $src = str_replace(array(

                '\'',

                '"'

            ), '', $image_array[$key]);

			$src = preg_replace('@src\s{0,}=\s{0,}@i', '', $src);

		}

       

        if (empty($propriety))

            unset($image_array[$key]);

    }

	

    $min_width  = $plugins->get_plugin_setting('image-resizer', 'min_width_resize');

    $min_height = $plugins->get_plugin_setting('image-resizer', 'min_height_resize');

	

	if(stristr($src, 'fullpage'))

    $image_original_size = getimagesize($CONF['site_url']."/".$src);

	else

	$image_original_size = getimagesize($src);



	

    if (($image_original_size[0] > $min_width) OR ($image_original_size[1] > $min_height)) {

        $percentage = $plugins->get_plugin_setting('image-resizer', 'resize_percentage');

        $width      = round($image_original_size[0] * $percentage);

        $height     = round($image_original_size[1] * $percentage);

        

        

        // add the value of height and width that are selected by the admin

        array_push($image_array, "width = '$width'", "height = '$height'");

        $image = implode(' ', $image_array);

        $image = "<a class='resized_image' href='$src' rel=\"prettyPhoto[image]\"><$image></a>";

        return $image;

    } else {

        return $matches[0];

    }

}



function javascript_function()

{	



    $js = "<script type=\"text/javascript\" src=\"plugins/image-resizer/photo_slide/js/jquery.js\"></script>

    <script type=\"text/javascript\" src=\"plugins/image-resizer/photo_slide/js/jquery.lightbox-0.5.js\"></script>

    <link rel=\"stylesheet\" type=\"text/css\" href=\"plugins/image-resizer/photo_slide/css/jquery.lightbox-0.5.css\" media=\"screen\" />

<script type=\"text/javascript\">



    $(function() {

        $('.resized_image').lightBox();

    });

    </script>";



    return $js;

}



function image_resizer_base_url()

{

	global $CONF;

	$base_url = "<base href='$CONF[site_url]/' />";

	return $base_url;

}

function image_resizer()

{

    global $plugins, $CONF, $function_contents;

    

    $text = preg_replace_callback('@(&lt;|\<)img(.+?)(\>|&gt;)@i', 'resize_image', $function_contents['post_output_end']);

    

    return $text;

}



// hook the function to the form table

hook_function('page_header_head_tag_start', 'image_resizer_base_url', 'append');

hook_function('page_header_head_tag_end', 'javascript_function', 'append');

hook_function('post_output_end', 'image_resizer');

?>