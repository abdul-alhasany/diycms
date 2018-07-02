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
 * This class handles login functions
 * 
 * @package	Global
 * @subpackage	Classes
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2010
 * @access 	public
 */

class Spams
{
    var $timeOut = 30;
    
    /**
     * Constructr
     * 
     * @return null
     */
    function Spams()
    {
        global $CONF;
        
        // $empty variable is an empty variable, since the second paramter is passed by refrence and can not be empty, I will find a wordaround in the next version (hopefully :))
        check_hook_function('spams_constructr', $empty);
        
        
        if (isset($CONF['spam_timeOut'])) {
            $this->timeOut = $CONF['spam_timeOut'];
        }
    }
    /**
     * Check if IP is valied
     * 
     * @return booalen
     */
    function is_ip()
    {
        $valid = true;
        $ip    = get_user_ip();
        $ip    = explode(".", $ip);
        if (count($ip) != 4) {
            return false;
        }
        foreach ($ip as $block) {
            if (!is_numeric($block) || $block > 255 || $block < 0) {
                $valid = false;
            }
        }
        
        check_hook_function('spams_is_ip', $valid);
        return $valid;
    }
    
    /**
     * Display message if spam occured
     * 
     * @return	booalen
     */
    function checkSpams()
    {
        global $diy_db;
        
        if ($this->is_ip() == false) {
            error_message('Error in  IPAddress : ' . get_user_ip());
        }
        $IPAddress = get_user_ip();
        
        $result = $diy_db->query("SELECT spamtime FROM diy_spam WHERE spamip='$IPAddress'");
        
        if ($diy_db->dbnumrows($result) > 0) {
            $row = $diy_db->dbarray($result);
            if ($row[0] + ($this->timeOut) > time()) {
                return false;
            } else {
                $this->updateSpams();
                return true;
            }
        } else {
            $this->insertSpams();
            return true;
        }
    }
    
    /**
     * Insert spam details if detected in the database
     * 
     * @return	null
     */
    function insertSpams()
    {
        global $diy_db;
        
        check_hook_function('insertSpams', $empty);
        
        if ($this->is_ip() == false) {
            error_message('Error IPAddress : ' . get_user_ip());
        }
        $spamip   = get_user_ip();
        $spamtime = time();
        $diy_db->query("insert into diy_spam (spamtime, spamip) values ('$spamtime', '$spamip')", 'diy_spam');
        
    }
    /**
     * Update spam if it a reoccuring spam
     * 
     * @return	null
     */
    function updateSpams()
    {
        global $diy_db;
        
        check_hook_function('updateSpams', $empty);
        
        if ($this->is_ip() == false) {
            error_message('Error IPAddress : ' . get_user_ip());
        }
        $spamip   = get_user_ip();
        $spamtime = time();
        $diy_db->query("update diy_spam set spamtime ='$spamtime' where spamip='$spamip'");
        
    }
}
