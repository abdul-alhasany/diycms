<?php
// This file handels the main configrations of the diycms

// ########## Database Informations ##########
$CONF['dbconntype']      = 0;  // connection type
$CONF['dbserver']        = "localhost"; // Server name, usually localhost
$CONF['dbname']          = "diy_update"; // Database name
$CONF['dbuser']          = "root"; // database user
$CONF['dbpword']         = ""; // datanase username


// #############  Host Paths #############
$CONF['site_path']       = "D:\\xampp\\htdocs\\diy_update"; // the path to the site
$CONF['upload_path']     = "D:\\xampp\\htdocs\\diy_update\\upload"; // the path to the upload folder
$CONF['site_url']        = 'http://localhost/diy_update'; // url of your website
$CONF['date_format']     = "F l d-m-Y"; // Date foramt, do not change it if you do not know how

// leave the rest as is unless you are know what you are doing 
// ############ Parked Domains ###########
$CONF['parked_domain'][] = "";
$CONF['parked_domain'][] = "";

// #############  DIY-CMS Settings ############
$CONF['dir']       		 = "rtl";
$CONF['lang']       	 = "arabic";
$CONF['site_mail']       = "";
$CONF['site_title']      = "";
$CONF['maxlifetime']     = 1440;
$CONF['online_lifetime'] = 300;
$CONF['cookie_path']     = '/';
$CONF['cookie_domain']   = 'localhost';
$CONF['cookie_expires']  = 604800;
$CONF['cookie_info']     = 'dzwhyrbg';
$CONF['Guest_id']        = '2';

// ################ Other #################
$CONF['class_folder']    = 'admin_classes';
$CONF['gzip_compress']   = 0;
$CONF['memory_query_usage']   = 0;


?>
