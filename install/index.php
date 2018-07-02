<?php

// set error reporting and header encoding
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header('Content-Type: text/html; charset=utf-8');

// extract posted, get and server values
@extract($_POST);
@extract($_GET);
@extract($_SERVER);

$lang = (isset($_GET['lang'])) ? $_GET['lang'] : 'arabic';

// include files
include('lang/'.$lang.'.lang.php');
include('includes/templates.class.php');

// instiate install templates class
$templates = new install_templates('templates/');

if(file_exists('file.lock'))
{
	echo "<div style='margin: 0 auto; font-size: 20px; border: 1px solid #FF9F9F; background-color: #FFC7C7; padding: 50px 20px; text-align:center;'>" . ERROR_CANNOT_INSTALL . "</div>";
	exit;
}
function random_word($number = 5)
{
    $chars = "abcdefghijkmnopqrstuvwxyz";
    srand((double) microtime() * 1000000);
    $i    = 0;
    $pass = '';
    while ($i <= $number) {
        $num  = rand() % 33;
        $tmp  = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

switch ($step) {
    case 0:
        $content .= "<div class='first_step'>" . STEP0_TEXT . "</div>";
        $content .= "<a href='index.php?step=1&lang=$lang'><div class='button'><span class='next'>" . STEP_NEXT . "</span></div></a>";
        break;
    case 1:
        
        
        $content .= "<div class='second_step'>" . STEP1_TEXT . "</div><ul class='check'>";
        // chmod upload folder
        $dir_perm = @chmod("../upload", 0777);
        $content .= (phpversion() > 5) ? "<li class='success'>" . STEP1_PHP_SUCCESS : "<li class='fail'>" . STEP1_PHP_FAIL;
        $content .= (extension_loaded('zip')) ? "<li class='success'>" . STEP1_ZIP_SUCCESS : "<li class='fail'>" . STEP1_ZIP_FAIL;
        $content .= (ini_get('memory_limit') >= 64) ? "<li class='success'>" . STEP1_MEMORY_SUCCESS : "<li class='warn'>" . STEP1_MEMORY_FAIL;
        $content .= ($dir_perm) ? "<li class='success'>" . STEP1_CHMOD_UPLOAD_SUCCESS : "<li class='fail'>" . STEP1_CHMOD_UPLOAD_FAIL;
        $content .= '</ul>';
        $content .= "<a href='index.php?step=2&lang=$lang'><div class='button'><span class='next'>" . STEP_NEXT . "</span></div></a>";
        break;
    case 2:
        $content .= $templates->get_template('details.html');
        break;
		
    case 3:
        $sercon    = @mysql_connect($servername, $server_un, $server_pass);
        $diy_dbcon = @mysql_select_db($server_db, $sercon);
        //$charset = mysql_client_encoding($sercon);
        @mysql_set_charset('utf8', $sercon);
        
        if (!$sercon) {
            $content .= "<div class='third_step red'>" . STEP3_TEXT_SERVER_FAIL . "</div>";
        } elseif (!$diy_dbcon) {
            $content .= "<div class='third_step red'>" . STEP3_TEXT_DATABASE_FAIL . "</div>";
        } elseif (empty($username) || empty($password)) {
            $content .= "<div class='third_step red'>" . STEP3_TEXT_FILL_FIELDS . "</div>";
        } else {
            $filename = "database.sql";
            @set_time_limit(900);
            $w = 1;
            
            $cur_sql = '';
            
            if (function_exists('file')) {
                $sql_file = file($filename);
            } else {
                $open     = fopen($filename, 'r');
                $fdata    = fread($open, filesize($filename));
                $sql_file = explode("\n", $fdata);
            }
            
            foreach ($sql_file as $v) {
                $sql = trim($v);
                
                if ($sql[0] == '-') {
                    continue;
                }
                
                if (!$sql) {
                    continue;
                }
                
                $cur_sql .= $sql . ' ';
                if (substr($sql, -1, 1) == ';') {
                    $sql_statements[] = substr(trim($cur_sql), 0, -1);
                    $cur_sql          = '';
                }
            }
            
            if (count($sql_statements)) {
                foreach ($sql_statements as $k => $v) {
                    if (!mysql_query($v)) {
                        $wrong = mysql_error();
                        $ww    = $w++;
                        $errors .= "$ww => $wrong in [$v]\n\n";
                        
                    }
                }
            }
            $password = md5($password);
            $timenow  = time();
            mysql_query("update diy_users set username='$username',password='$password',register_date='$timenow' where userid='1'");
            mysql_query("update diy_users set register_date='$timenow' where userid='2'");
            mysql_query("update diy_settings set value='$sitetitle' where variable='sitetitle'");
            mysql_query("update diy_settings set value='$sitemail' where variable='sitemail'");
            mysql_query("update diy_settings set value='$sitelink' where variable='siteURL'");
            
            if ($wrong) {
                $content .= "<div class='third_step'>" . STEP3_TEXT_MYSQL_ERRORS;
                $content .= "<textarea cols=100 rows=10>";
                $errors = str_replace('</textarea>', '< /textarea>', $errors);
                $content .= $errors;
                $content .= "</textarea></div>";
            } else {
                $content .= "<div class='third_step'>" . STEP3_TEXT_MYSQL_SUCCESS . "</div>";
            }
            
            $op = @fopen('conf.php', "r");
            $sz = @filesize('conf.php');
            $tx = @fread($op, $sz);
            
            $tx        = str_replace("{path}", addslashes($sitepath), $tx);
            $tx        = str_replace("{uppath}", addslashes($uppath), $tx);
            $tx        = str_replace("{sitetitle}", "$sitetitle", $tx);
            $tx        = str_replace("{guest}", "2", $tx);
            $tx        = str_replace("{sitemail}", "$sitemail", $tx);
            $tx        = str_replace("{sitelink}", "$sitelink", $tx);
            $tx        = str_replace("{kpath}", "$kpath", $tx);
            $tx        = str_replace("{domain}", "$domain", $tx);
            $tx        = str_replace("{cookie}", "$cookie", $tx);
            $tx        = str_replace("{db_conntype}", "0", $tx);
            $tx        = str_replace("{server_name}", "$servername", $tx);
            $tx        = str_replace("{server_db}", "$server_db", $tx);
            $tx        = str_replace("{server_un}", "$server_un", $tx);
            $tx        = str_replace("{server_pass}", "$server_pass", $tx);
            $conf_open = fopen("./../admin/conf.php", w);
            fwrite($conf_open, $tx);
            fclose($conf_open);
            if ($conf_open) {
                $content .= "<div class='third_step green'>" . STEP3_TEXT_CONF_SUCCESS . "</div>";
                $content .= "<a href='index.php?step=4&lang=$lang'><div class='button'><span class='next'>" . STEP_NEXT . "</span></div></a>";
            } else {
                $content .= "<div class='third_step red'>" . STEP3_TEXT_CONF_FAIL;
                $content .= "<textarea dir=ltr cols=100 rows=30>";
                $content .= $tx;
                $content .= "</textarea></div>";
                $content .= "<a href='index.php?step=4&lang=$lang'><div class='button'><span class='next'>" . STEP_NEXT . "</span></div></a>";
            }
        }
        break;
		
    case 4:
        $create_file = file_put_contents('file.lock', 'lock');
        
        if ($create_file) {
            $content .= "<div class='forth_step green'>" . STEP3_TEXT_LOCK_CREATED . "</div>";
        } else {
            $content .= "<div class='forth_step red'>" . STEP3_TEXT_LOCK_NOT_CREATED . "</div>";
        }
        $content .= "<b><br><center><a href='../index.php'> اذهب إلى موقعك</a>";
        break;
}

$output = $templates->get_template('main.html');
echo $output;
?>