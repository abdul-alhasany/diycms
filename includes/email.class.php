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

include ('phpmailer/class.phpmailer.php');

/**
  * This class handles email issues, such as post subscription or pm notificaitons
  * 
  * @package	Global
  * @subpackage	Classes
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	2010
  * @access 	public
  * @todo		rewrite this class to conform with the new updated phpmailer
  */
  


class email
{
  var $to_email;
  var $subject;
  var $message;
  var $from_name;
  var $from_email;
  var $header;
  var $mailuser;
  var $userid;
  var $postid;
  var $field;
  var $use_html;
  var $mail_temp;
  var $phpmailer;

  //---------------------------------------------------

  /**
   * email::email()
   * 
   * @return
   */
  function email()
  {
    global $CONF;

    $this->phpmailer = new phpmailer();

    if ($CONF['Mailer'] == 'smtp')
    {
      $this->phpmailer->Host = $CONF['smtp_Host'];
      $this->phpmailer->Port = $CONF['smtp_Port'];
      $this->phpmailer->Username = $CONF['smtp_Username'];
      $this->phpmailer->Password = $CONF['smtp_Password'];
      $this->phpmailer->IsSMTP();
    } elseif ($CONF['Mailer'] == 'sendmail')
    {
      $this->phpmailer->Sendmail = $CONF['sendmail_path'];
      $this->phpmailer->IsSendmail();
    }
    else  $this->phpmailer->IsMail();

  }

  //---------------------------------------------------
  /**
   * email::set_use_html()
   * 
   * @param mixed $_html
   * @return
   */
  function set_use_html($_html)
  {
    $this->use_html = $_html;
  }

  //---------------------------------------------------
  /**
   * email::send()
   * 
   * @param mixed $_toemail
   * @param mixed $_subject
   * @param mixed $_message
   * @param mixed $_from_name
   * @param mixed $_from_email
   * @param integer $html
   * @return
   */
  function send($_toemail, $_subject, $_message, $_from_name, $_from_email, $html = 0)
  {
    $this->to_email = $_toemail;
    $this->subject = $_subject;
    $this->message = $_message;
    $this->from_name = $_from_name;
    $this->from_email = $_from_email;

    if ($html == 1)
    {
      $this->send_mail_html();
    }
    else
    {
      $this->send_mail();
    }
  }
  //---------------------------------------------------
  /**
   * email::send_mail()
   * 
   * @return
   */
  function send_mail()
  {

    $this->phpmailer->From = $this->from_email;
    $this->phpmailer->FromName = $this->from_name;
    $this->phpmailer->Subject = $this->subject;
    $this->phpmailer->Body = $this->message;
    $this->phpmailer->AddAddress($this->to_email);
    if (!$this->phpmailer->Send()) $return = true;
    else  $return = false;
    $this->phpmailer->ClearAddresses();
    return $return;
  }
  //---------------------------------------------------
  /**
   * email::send_mail_html()
   * 
   * @return
   */
  function send_mail_html()
  {

    $this->phpmailer->From = $this->from_email;
    $this->phpmailer->FromName = $this->from_name;
    $this->phpmailer->Subject = $this->subject;
    $this->phpmailer->IsHTML(true);
    $this->phpmailer->Body = $this->message;
    $this->phpmailer->AddAddress($this->to_email);
   // $this->phpmailer->MsgHTML($this->phpmailer->Body);
    if (!$this->phpmailer->Send()) $return = true;
    else  $return = false;
    $this->phpmailer->ClearAddresses();
    return $return;
  }


  //---------------------------------------------------

  /**
   * email::mail_user()
   * 
   * @return
   */
  function mail_user()
  {
    global $diy_db;

    if (($this->mailuser == '1') && ($this->userid > 0))
    {
      $check_alertid = $diy_db->query("SELECT userid FROM diy_subscriptions
                                            WHERE postid ='$this->postid'
											and module ='$this->field'
                                            and userid='$this->userid'");

      if ($diy_db->dbnumrows($check_alertid) == 0)
      {
        $diy_db->query("insert into diy_subscriptions (postid,userid,module) values
                                                         ('$this->postid','$this->userid','$this->field')");
      }
    }
  }

  //---------------------------------------------------
  /**
   * email::send_to_users()
   * 
   * @param mixed $_field
   * @param mixed $_userid
   * @param mixed $_postid
   * @param mixed $url
   * @param mixed $_mailuser
   * @return
   */
  function send_to_users($_field, $_userid, $_postid, $url, $_mailuser)
  {
    global $diy_db;

    $this->field = $_field;
    $this->userid = $_userid;
    $this->postid = $_postid;

    if (empty($this->postid)) return;

    $name = $_COOKIE['cname'] ? $_COOKIE['cname'] : $_POST['name'];

    $titlepost = $_POST['title'];
    eval("\$this->subject = \" " . get_global_setting("subject_alert") . "\";");
    $this->from_email = get_global_setting("sitemail");
    $this->url = add_url_slash(get_global_setting("siteURL")) . $url;
    $this->mailuser = $_mailuser;
    $this->from_name = get_global_setting("sitetitle");

    $name = $name;
    $this->subject = $this->subject;
    $this->from_name = $this->from_name;

    $this->mail_user();


    $result_email = $diy_db->query("select diy_users.email,diy_users.userid
                                          from diy_subscriptions, diy_users
                                          where diy_subscriptions.postid='$this->postid'
                                          and diy_subscriptions.alert_sent ='no'
										  and diy_subscriptions.module ='$this->field'
                                          and diy_subscriptions.userid = diy_users.userid
                                          and diy_subscriptions.userid !='$this->userid'");
    while ($row = $diy_db->dbarray($result_email))
    {

      $this->to_email = $row[email];
      $userid = $row[userid];
      $url = add_url_slash(get_global_setting("siteURL"));
      $delale_url = $url . "/members.php?action=delale&$this->field=$this->postid&userid=$userid";

      $replace = array("{name}" => $name, "{titlepost}" => $_POST['titlepost'], "{url}" => $this->url, "{delaleurl}" => $delale_url, "{sitetitle}" => $this->from_name);

      $this->message = get_message('msg_new_post', 0, $replace);
      $this->message = $this->message;
      $this->send_mail();


      $diy_db->query("UPDATE diy_subscriptions SET alert_sent ='yes'
                            WHERE postid='$this->postid' AND userid='$userid' AND module ='$this->field'");
      flush();
    }

  }

  //---------------------------------------------------

  /**
   * email::send_to_moderate()
   * 
   * @param mixed $cat_id
   * @return
   */
  function send_to_moderate($cat_id)
  {
    global $diy_db, $name;

    $result = $diy_db->query("SELECT cat_title,cat_email FROM diy_forum_cat WHERE catid='$cat_id' and cat_email!='NULL'");
    $url = $_SERVER['PHP_SELF'];
    if ($diy_db->dbnumrows($result) > 0)
    {
      $row = $diy_db->dbarray($result);
      $this->cat_title = $row['title'];
      $this->to_email = $row['cat_email'];
      $this->from_email = get_global_setting("sitemail");
      $this->url = add_url_slash(get_global_setting("siteURL")) . $url;
      $this->from_name = get_global_setting("sitetitle");
      $this->subject = $this->from_name;

      $replace = array("{name}" => $name, "{titlepost}" => $_POST['titlepost'], "{url}" => $this->url, "{titlecat}" => $this->cat_title,
        "{sitetitle}" => $this->from_name);

      $this->header = "From: \"" . addslashes($this->from_name) . "\"<" . $this->from_email . ">\r\n";
      $this->header .= "Reply-To: " . $this->from_email . "\r\n";
      eval("\$this->message = \"" . get_message("msg_cat", 0, $replace) . "\";");
      $this->send($this->to_email, $this->subject, $this->message, $this->from_name, $html = 0);
    }
  }
}

?>