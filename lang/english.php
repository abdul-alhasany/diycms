<?php
/*
+===============================================================================+
|      	Some or all this file's contents were created by ArabPortal Team   		|
|						Web: http://www.arab-portal.info						|
|   	--------------------------------------------------------------   		|
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

/**
  * CMS languages
  * 
  * @package	Global
  * @subpackage	Language
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	2010
  * @access 	public
  */
  
// Date conversion class
define('DAY_MONDAY', "Monday");
define('DAY_TUESDAY', "Tuesday");
define('DAY_WEDNESDAY', "Wednesday");
define('DAY_THURSDAY', "Thursday");
define('DAY_FRIDAY', "Friday");
define('DAY_SATURDAY', "Saturday");
define('DAY_SUNDAY', "Sunday");

define('HIJRI_MONTH_MUHARRAM', "Muharram");
define('HIJRI_MONTH_SAFAR', "Safar");
define('HIJRI_MONTH_RABI_AL-AWWAL', "Rabi' al-awwal");
define('HIJRI_MONTH_RABI_AL-THANI', "Rabi' al-thani");
define('HIJRI_MONTH_JUMADA_AL-AWWAL', "Jumada al-awwal");
define('HIJRI_MONTH_JUMADA_AL-THANI', "Jumada al-thani");
define('HIJRI_MONTH_RAJAB', "Rajab");
define('HIJRI_MONTH_SHAABAN', "Sha'aban");
define('HIJRI_MONTH_RAMADAN', "Ramadan");
define('HIJRI_MONTH_SHAWWAL', "Shawwal");
define('HIJRI_MONTH_DHU_AL-QIDAH', "Dhu al-Qi'dah");
define('HIJRI_MONTH_DHU_AL-HIJJAH', "Dhu al-Hijjah");

define('MONTH_JANUARY', "January");
define('MONTH_FEBRUARY', "February");
define('MONTH_MARCH', "March");
define('MONTH_APRIL', "April");
define('MONTH_MAY', "May");
define('MONTH_JUNE', "June");
define('MONTH_JULY', "July");
define('MONTH_AUGUST', "August");
define('MONTH_SEPTEMBER', "September");
define('MONTH_OCTOBER', "October");
define('MONTH_NOVEMBER', "November");
define('MONTH_DECEMBER', "December");

define('TIME_AM', "am");
define('TIME_PM', "pm");

// global lang
define("LANG_ERROR_VALIDATE", "Please fill all the required fields.<br>They are marked with this sign ( <font color=\"#FF0000\">*</font> )");
define("LANG_ERROR_ADD_DB", "There was an error adding data to the database.<br>Please try again later");
define("LANG_TITLE_ERROR", "An error ocurred");
define("LANG_MODULE_NOT_FOUND", "The module %s does not exist");
define("LANG_MODULE_FILE_NOT_FOUND", "The file %s does not exist");
define("LANG_ERROR_URL", "There is an error in the url");
define("LANG_TITLE_LOG_IN", "Log in page");
define("LANG_ERROR_WAIT_SECONDS", "You have to wait a few seconds before adding another post");

define("LANG_FORM_ADD_BUTTON","Add");
define("LANG_FORM_SUBMIT_BUTTON","Submit");
define("LANG_FORM_EDIT_BUTTON","Edit");
define("LANG_FORM_DELETE_POST","Delete this post? ");
define("LANG_FORM_TEXTAREA_LENGTH","Text should be less than: ");
define("LANG_FORM_TEXTAREA_CHARCHTERS","Charchters");
define("LANG_FORM_TEXTAREA_REMAIN","Remain: ");
define("FORM_BBCODE_SIZE","Size");
define("FORM_BBCODE_ALIGN","Align");
define("FORM_BBCODE_ALIGN_JUSTIFY","Justify");
define("FORM_BBCODE_ALIGN_LEFT","Left");
define("FORM_BBCODE_ALIGN_RIGHT","Right");
define("FORM_BBCODE_ALIGN_CENTER","Center");
define("FORM_BBCODE_COLOR","Color");
define("FORM_BBCODE_COLOR_RED","Red");
define("FORM_BBCODE_COLOR_ORANGE","Orange");
define("FORM_BBCODE_COLOR_YELLOW","Yellow");
define("FORM_BBCODE_COLOR_LIME","Lime");
define("FORM_BBCODE_COLOR_GREEN","Green");
define("FORM_BBCODE_COLOR_CYAN","Cyan");
define("FORM_BBCODE_COLOR_BLUE","Blue");
define("FORM_BBCODE_COLOR_INDIGO","Indigo");
define("FORM_BBCODE_COLOR_VIOLT","Violt");
define("FORM_BBCODE_COLOR_MAGENTA","Magenta");
define("LANG_YES","Yes");
define("LANG_NO","No");
define("LANG_EDIT_UPLOAD_REPLACE_ATTACHMENT","Replace attachment");
define("LANG_EDIT_UPLOAD_DELETE_ATTACHMENT","Delete Attachment");
define("LANG_EDIT_UPLOAD_UPLOAD_NEW","Upload new file");
define("LANG_EDIT_UPLOAD_ADD_EXTRA","Add extra files");
define("LANG_CONTROL_PANEL","Control Panel");


define("ERROR_FILL_REQUIRED_FIELDS","<li>Please fill all required fields</li>");
define("ERROR_MAXIMUM_EXCEEDED","<li>Maximum charchters are exceeded</li>");
define("ERROR_UPLOAD_NOT_ALLOWED_FILE","<li>File <b>%s</b> is not allowed to be uploaded on this website</li>");
define("ERROR_UPLOAD_ALLOWED_EXTENSIONS","<li>Extensions allowed to be uploaded are <b>%s</b></li>");
define("ERROR_UPLOAD_SEREVER_MAX_SIZE","<li>Website's server does not allow more than %s to be uploaded</li>");
define("ERROR_UPLOAD_FILE_MAX_SIZE","<li>The total size sum of uploaded files can not excceed %s KB</li>");
define("ERROR_UPLOAD_IMAGE_MAX_WIDTH","<li><b>%s</b> image's width can not excceed %s px</li>");
define("ERROR_UPLOAD_IMAGE_MAX_HEIGHT","<li><b>%s</b> image's height can not excceed %s px</li>");


define("LANG_ERROR_URL", "There is an error in the ID %s");
define("LANG_INFO_POST_APPROVED", "Post has been published");
define("LANG_INFO_POST_PENDING", "Post is awaiting approval");

$common = array('able', 'about', 'above', 'act', 'add', 'afraid', 'after', 'again', 'against', 'age', 'ago', 'agree', 'all', 'almost', 'alone', 'along', 'already', 'also', 'although', 'always', 'am', 'amount', 'an', 'and', 'anger', 'angry', 'animal', 'another', 'answer', 'any', 'appear', 'apple', 'are', 'arrive', 'arm', 'arms', 'around', 'arrive', 'as', 'ask', 'at', 'attempt', 'aunt', 'away', 'back', 'bad', 'bag', 'bay', 'be', 'became', 'because', 'become', 'been', 'before', 'began', 'begin', 'behind', 'being', 'bell', 'belong', 'below', 'beside', 'best', 'better', 'between', 'beyond', 'big', 'body', 'bone', 'born', 'borrow', 'both', 'bottom', 'box', 'boy', 'break', 'bring', 'brought', 'bug', 'built', 'busy', 'but', 'buy', 'by', 'call', 'came', 'can', 'cause', 'choose', 'close', 'close', 'consider', 'come', 'consider', 'considerable', 'contain', 'continue', 'could', 'cry', 'cut', 'dare', 'dark', 'deal', 'dear', 'decide', 'deep', 'did', 'die', 'do', 'does', 'dog', 'done', 'doubt', 'down', 'during', 'each', 'ear', 'early', 'eat', 'effort', 'either', 'else', 'end', 'enjoy', 'enough', 'enter', 'etc', 'even', 'ever', 'every', 'except', 'expect', 'explain', 'fail', 'fall', 'far', 'fat', 'favor', 'fear', 'feel', 'feet', 'fell', 'felt', 'few', 'fill', 'find', 'fit', 'fly', 'follow', 'for', 'forever', 'forget', 'from', 'front', 'full', 'fully', 'gave', 'get', 'gives', 'goes', 'gone', 'good', 'got', 'gray', 'great', 'green', 'grew', 'grow', 'guess', 'had', 'half', 'hang', 'happen', 'has', 'hat', 'have', 'he', 'hear', 'heard', 'held', 'hello', 'help', 'her', 'here', 'hers', 'high', 'highest', 'highly', 'hill', 'him', 'his', 'hit', 'hold', 'hot', 'how', 'however', 'i', 'if', 'ill', 'in', 'include', 'including', 'included', 'indeed', 'instead', 'into', 'iron', 'is', 'it', 'its', 'just', 'keep', 'kept', 'knew', 'know', 'known', 'late', 'least', 'led', 'left', 'lend', 'less', 'let', 'like', 'likely', 'lone', 'long', 'longer', 'look', 'lot', 'make', 'many', 'may', 'me', 'mean', 'met', 'might', 'mile', 'mine', 'moon', 'more', 'most', 'move', 'much', 'must', 'my', 'near', 'nearly', 'necessary', 'neither', 'never', 'next', 'no', 'none', 'nor', 'not', 'note', 'nothing', 'now', 'number', 'of', 'off', 'often', 'oh', 'on', 'once', 'only', 'or', 'other', 'ought', 'our', 'out', 'please', 'prepare', 'probable', 'pull', 'pure', 'push', 'put', 'raise', 'ran', 'rather', 'reach', 'realize', 'reply', 'require', 'rest', 'run', 'said', 'same', 'sat', 'saw', 'say', 'see', 'seem', 'seen', 'self', 'sell', 'sent', 'separate', 'set', 'shall', 'she', 'should', 'side', 'sign', 'since', 'so', 'sold', 'some', 'soon', 'sorry', 'stay', 'step', 'stick', 'still', 'stood', 'such', 'sudden', 'suppose', 'take', 'taken', 'talk', 'tall', 'tell', 'ten', 'than', 'thank', 'that', 'the', 'their', 'them', 'then', 'there', 'therefore', 'these', 'they', 'this', 'those', 'though', 'through', 'till', 'to', 'today', 'told', 'tomorrow', 'too', 'took', 'tore', 'tought', 'toward', 'tried', 'tries', 'trust', 'try', 'turn', 'two', 'under', 'until', 'up', 'upon', 'us', 'use', 'usual', 'various', 'verb', 'very', 'visit', 'want', 'was', 'we', 'well', 'went', 'were', 'what', 'when', 'where', 'whether', 'which', 'while', 'white', 'who', 'whom', 'whose', 'why', 'will', 'with', 'within', 'without', 'would', 'yes', 'yet', 'you', 'young', 'your', 'yours');

?>