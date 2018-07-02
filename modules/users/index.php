<?php
/*
+===============================================================================+
|      					DIY-CMS V1.0.0 Copyright © 2011   						|
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
 * This file is part of users module
 * 
 * @package	Modules
 * @subpackage	Users
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	1.1
 * @access 	public
 */



require_once("modules/" . $mod->module . "/settings.php");
require_once('includes/module_templates_stream.class.php');

$index_middle = $mod->nav_bar();

$upp = $mod->setting('users_per_page');

// set up defaults
$order = (isset($_GET['morder'])) ? $_GET['morder'] : "userid";
$sort  = (isset($_GET['msort'])) ? $_GET['msort'] : "DESC";

$letters = $mod->get_template_code('users_index_top_letters', array(
    'letters' => $letters
));

// swith action
switch ($_GET['action']) {
	// default action
    default:
        $perm = $mod->setting('view_members_list', $_COOKIE['cgroup']);
        $mod->permission($perm);

        $result = $diy_db->query("SELECT * FROM diy_users WHERE userid > '0' and userid != '$CONF[Guest_id]' and activated = 'approved' ORDER BY $order $sort LIMIT $start,$upp");
        
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            $row           = format_data_out($row);
            $website       = add_to_url($website);
            $register_date = format_date($register_date);
            
            eval("\$show_users_row .= \" " . $mod->gettemplate('users_index_list_row') . "\";");
        }
        eval("\$index_middle .= \" " . $mod->gettemplate('users_index_list') . "\";");
        
        $numrows = $diy_db->dbnumquery("diy_users", "");
        $index_middle .= pagination($numrows, $upp, "mod.php?mod=users&morder=$order&msort=$sort");
        break;

	// search case
    case 'msearch':
        $perm = $mod->setting('search_memebrs', $_COOKIE['cgroup']);
        $mod->permission($perm);
        
        if ($_GET['by']) {
            $by = $_GET['by'];
        } elseif ($_GET['membername'] == '') {
            error_message($lang['LANG_ERROR_SCOPE_SEARCH']);
        } else {
            $by = $_GET['membername'];
        }
        
        $result = $diy_db->query("SELECT * FROM diy_users
								WHERE (username REGEXP '^$by' OR username REGEXP LOWER('^$by'))
								AND userid > '0'
								AND userid != " . $CONF['Guest_id'] . "
								AND activated = 'approved'
								ORDER BY $order $sort
								LIMIT $start,$upp");
        
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            $row           = format_data_out($row);
            $website       = add_to_url($website);
            $register_date = format_date($register_date);
            
            eval("\$show_users_row .= \" " . $mod->gettemplate('users_index_list_row') . "\";");
            
        }
        eval("\$index_middle .= \" " . $mod->gettemplate('users_index_list') . "\";");
        
        $numrows = $diy_db->dbnumquery("diy_users", "username REGEXP '^$by' AND userid >'0' and userid != '$CONF[Guest_id]'");
        $index_middle .= pagination($numrows, $upp, "mod.php?mod=users&morder=$order&msort=$msort");
        break;
}
echo $index_middle;

?>