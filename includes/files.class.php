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
  * procces files uploading and downloading
  * 
  * @package	Global
  * @subpackage	Classes
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	2010
  * @access 	public
  */

class Files
{

  /**
   * echo Files::read("filename.txt");
   * or
   * $content =Files::read("filename.txt");
   * 
   * @param 	mixed $file	file to be read
   * @return 	mixed		read file
   */
  function read($file)
  {
    if (!is_readable($file))
    {
      Files::exit_Error("Fils is not readable: " . $file);
    }

    if (!$fp = @fopen($file, 'rb'))
    {
      Files::exit_Error("File can not be opened fopen: " . $file);
    }

    $content = fread($fp, filesize($file));

    fclose($fp);

    return $content;
  }

  
  /**
   *  if(Files::write("filename.txt"))
   *  echo '<br>Create empty file';
   *  -----------------------
   *
   *  if(Files::write("filename1.txt","write this text"))
   *  echo '<br>Create empty file with some texts';
   *  -----------------------
   *
   * if(Files::write("filename1.txt","\n add this text ",'a'))
   * echo '<br>Writing to an existing file or creating a new one';
   * ------------------------
   *
   * if(Files::write("filename1.txt","\n add this text ",'a',true))
   * echo '<br> Writing to an exisiting file and making sure it is writble';
   *
   * 
   * @param mixed $file		file to be written
   * @param string $content content to be written to the file
   * @param string $mode	writing mode
   * @param bool $writable	check if file is writable or not
   * @return
   */
  function write($file, $content = '', $mode = 'w', $writable = false)
  {
    if (!$writable == 'NoError')
    {
      if (($writable !== false) and (!is_writable($file)))
      {
        Files::exit_Error("File is not writable:" . $file);
      }
    }

    if (!$fp = @fopen($file, $mode))
    {
      Files::exit_Error("File can not be opened:" . $file);
    }

    if ($content == '')
    {
      @fclose($fp);
      return true;
    }

    @flock($fp, LOCK_EX);

    @fwrite($fp, $content);

    @flock($fp, LOCK_UN);

    @fclose($fp);
    return true;
  }


  /**
   * Error display, when an error occured during reading or downlding a file this function will display a message mentioning the error
   * 
   * @param mixed $error	error message to be displayed
   * @param string $Title	title of the message
   * @return null			the script exits if the message appears
   */
  function exit_Error($error, $Title = '')
  {
    if ($Title == '') $Title = "System message";
    print ('<div dir=rtl style="padding: 2%; border: 1px solid red; font-size: 125%">');
    printf("%20s", "$Title :- ");
    printf("%15s", $error);
    print ('</div>');
    exit;
  }
}

?>