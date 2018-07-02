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


if (!empty($_POST)) {
    extract($_POST);
    
    include("plugins/anti-spam/lang/$CONF[lang].lang.php");
    $type = plugins::get_plugin_setting('anti-spam', 'protection_type');
    if ($type == 'calc') {
        if ($_POST['antispam_user_calc'] != $_POST['antispam_hidden_calc'])
            error_message($antispam_lang['ANTISPAM_CALC_NO_MATCH']);
    } else {
        if ($_POST['antispam_user_word'] != $_POST['antispam_hidden_word'])
            error_message($antispam_lang['ANTISPAM_WORD_NO_MATCH']);
    }
}

function anitspam_blankword($antispam_lang)
{
    global $plugins;
    // get sentences that were set in the settings
    $sentences = $plugins->get_plugin_setting('anti-spam', 'sentences');
    
    // put them in an array
    $sentences = explode("\n", $sentences);
    
    // select a random sentence
    $rand_sentence = array_rand($sentences);
    $rand_sentence = $sentences[$rand_sentence];
    
    // put sentence words into an array
    $sentence_words = explode(' ', $rand_sentence);
    
    // select a random word in order to replace it with a blank space
    $rand_word = array_rand($sentence_words);
    $rand_word = $sentence_words[$rand_word];
    
    // replace the word with a line
    $input    = "<input type='text' name='antispam_user_word' size='10' class='text_box'>";
    $sentence = preg_replace("/(^|\s)$rand_word(\s|$)/i", " $input ", $rand_sentence);
    
    
    $hidden = "<input type=\"hidden\" name='antispam_hidden_word' value=\"$rand_word\">";
    
    // include the results into a vairable
    $form = "<tr><td class='info_bar'>$antispam_lang[ANTISPAM_FILL_BLANK_WORD]:<br><div style='font-weight:bold;'>$rand_sentence</div></td><td>$sentence $hidden</td></tr>";
    return $form;
}

function antispam_calculation($antispam_lang)
{
    global $plugins;
    // get operations
    $operations       = $plugins->get_plugin_setting('anti-spam', 'calculation_types');
    $operations_array = array(
        'addition' => "+",
        'multiply' => "x",
        'subtraction' => "-",
        'division' => "/"
    );
    // loop through operations to find which one is selected by the admin and build an array for them
    foreach ($operations_array as $op => $symbole) {
        if (strpos($operations, $op))
            $new_operations_array[$symbole] = $op;
    }
    
    // get the number range and create two random value to perfom operations
    $number_range = $plugins->get_plugin_setting('anti-spam', 'number_range');
    $number_range = explode('-', $number_range);
    
    $first_value  = rand($number_range[0], $number_range[1]);
    $second_value = rand($number_range[0], $number_range[1]);
    
    // select a random operation every time the page reloads
    $symbole = array_rand($new_operations_array);
    
    // check what kind of operations is in play and add the values of language, result and hidden field accordingly
    if ($symbole == 'x') {
        $lang  = sprintf($antispam_lang['ANTISPAM_CALCULATIONS_MULTIPLICATIONS'], $first_value, $second_value);
        $value = $first_value * $second_value;
        
    } elseif ($symbole == '+') {
        $lang  = sprintf($antispam_lang['ANTISPAM_CALCULATIONS_ADDITIONS'], $first_value, $second_value);
        $value = $first_value + $second_value;
        
    } elseif ($symbole == '-') {
        // subtract the small number from the large number in order to avoid minus numbers in the results
        if ($first_value < $second_value) {
            $first_value = rand($second_value, $number_range[1]);
        }
        $value = $first_value - $second_value;
        $lang  = sprintf($antispam_lang['ANTISPAM_CALCULATIONS_SUBTRACTION'], $first_value, $second_value);
        
    } elseif ($symbole == '/') {
        if ($first_value < $second_value) {
            $first_value = rand($second_value, $number_range[1]);
        }
        
        $lang  = sprintf($antispam_lang['ANTISPAM_CALCULATIONS_DIVISION'], $first_value, $second_value);
        // round the results so we do not have issues in figuring the fractions of the division result 
        $value = round($first_value / $second_value);
        
    }
    $hidden = "<input type=\"hidden\" name='antispam_hidden_calc' value=\"$value\">";
    
    // include the results into a vairable
    $form = "<tr><td class='info_bar'>$lang</td><td>$hidden<input type='text' name='antispam_user_calc' size='30' class='text_box'></td></tr>";
    return $form;
}


function anti_spam($antispam_lang)
{
    global $plugins, $CONF;
    // include language file
    include("plugins/anti-spam/lang/$CONF[lang].lang.php");
    
    $antispam_type = $plugins->get_plugin_setting('anti-spam', 'protection_type');
    $type          = ($antispam_type == "calc") ? antispam_calculation($antispam_lang) : anitspam_blankword($antispam_lang);
    return $type;
}

// hook the function to the form table
hook_function('form_table_content', 'anti_spam', 'append', $antispam_lang );

?>