<?php
// This file handels the main configrations of the diycms

// ########## Database Informations ##########
$CONF['dbconntype']      = 0;  // connection type
$CONF['dbserver']        = "localhost"; // Server name, usually localhost
$CONF['dbname']          = "{server_db}"; // Database name
$CONF['dbuser']          = "{server_un}"; // database user
$CONF['dbpword']         = "{server_pass}"; // datanase username


// #############  Host Paths #############
$CONF['site_path']       = "{path}"; // the path to the site
$CONF['upload_path']     = "{uppath}"; // the path to the upload folder
$CONF['site_url']        = '{sitelink}'; // url of your website
$CONF['date_format']     = "F l d-m-Y"; // Date foramt, do not change it if you do not know how

// leave the rest as is unless you are know what you are doing 
// ############ Parked Domains ###########
$CONF['parked_domain'][] = "";
$CONF['parked_domain'][] = "";

// #############  DIY-CMS Settings ############
$CONF['dir']       		 = "rtl";
$CONF['lang']       	 = "arabic";
$CONF['site_mail']       = "{sitemail}";
$CONF['site_title']      = "{sitetitle}";
$CONF['maxlifetime']     = 1440;
$CONF['online_lifetime'] = 300;
$CONF['cookie_path']     = '/';
$CONF['cookie_domain']   = '{domain}';
$CONF['cookie_expires']  = 604800;
$CONF['cookie_info']     = '{cookie}';
$CONF['Guest_id']        = '{guest}';

// ################ Other #################
$CONF['class_folder']    = 'admin_classes';
$CONF['gzip_compress']   = 0;
$CONF['memory_query_usage']   = 0;


?>
