<?php

class handle_upload_files
{
	var $max_size; // maximum size for files
	var $max_width; // maximum width for images
	var $max_height; // maximum height for images
	var $allowed_extensions = array(); // allowed extensions for upload
	var $image_extensions = array('.gif', '.png', '.jpg'); // types of image extensions
	var $error; // holds all errors occure in file uploading (size is too large, width is too wide .. etc)
	var $module; // which module is used during the proccess of uploading or reading files
	
	
	function handle_upload_files($module = '')
	{
		global $mod;
		$this->max_size           = get_group_setting('maximum_upload_size');
		$this->max_height         = get_group_setting('maximum_upload_height');
		$this->max_width          = get_group_setting('maximum_upload_width');
		$this->allowed_extensions = explode(',', get_group_setting('allowed_files_upload'));
		
		$this->module = ($module === '') ? $mod->module : $module;
		
	}
	
	function upload_files($input_name, $post_id, $location)
	{
		global $diy_db;
		if (empty($this->error)) {
			for ($i = 0; $i < sizeof($_FILES[$input_name]); $i++) {
				if (!empty($_FILES[$input_name]['tmp_name'][$i])) {
					$tmp_name  = $_FILES[$input_name]['tmp_name'][$i];
					$file_name = $_FILES[$input_name]['name'][$i];
					$size      = $_FILES[$input_name]['size'][$i];
					$type      = $_FILES[$input_name]['type'][$i];
					if (is_uploaded_file($tmp_name)) {
						$file = $diy_db->dbfetch('SELECT MAX(upid) as upload_id FROM diy_upload');
						$file['upload_id'] += 1;
						$uploaded_file = get_file_path($file['upload_id'] . "." . $this->module, $this->module);
						$move          = move_uploaded_file($tmp_name, $uploaded_file);
					}
					if ($move)
						$this->insert_file_info($file_name, $size, $type, $post_id, $location);
				}
			}
			return $move;
		}
	}
	
	function edit_uploaded_files($files_id, $replace_input, $delete_input, $new_input, $post_id, $location)
	{
		global $diy_db;
		if(is_array($files_id))
		{
		foreach ($files_id as $key => $id) {
			if (is_array($delete_input)) {
				foreach ($delete_input as $del_id) {
					if ($del_id == $id) {
						$this->delete_file_info($id);
					}
					
				}
			}
			if ((!empty($_FILES[$replace_input]['tmp_name'][$key])) && ($delete_input[$key] !== $id)) {
				$tmp_name = $_FILES[$replace_input]['tmp_name'][$key];
				$file_name = $_FILES[$replace_input]['name'][$key];
				$size      = $_FILES[$replace_input]['size'][$key];
				$type      = $_FILES[$replace_input]['type'][$key];
					
				if (is_uploaded_file($tmp_name)) {
				$uploaded_file = get_file_path($id .".". $this->module, $this->module);
				$move           = move_uploaded_file($tmp_name, $uploaded_file);
				}
				
				if ($move)
				$this->update_file_info($file_name, $size, $type, $post_id, $location, $id);
				}
				}
				
		}

			$this->upload_files($new_input, $post_id, $location);
	}
	
	function check_upload_file($input_name)
	{
		for ($i = 0; $i < sizeof($_FILES[$input_name]); $i++) {
			if (!empty($_FILES[$input_name]['tmp_name'][$i])) {
				$name      = $_FILES[$input_name]['name'][$i];
				$extension = $this->check_file_extension($name);
				
				// check if the file is an image
				if (in_array($extension, $this->image_extensions)) {
					$this->check_image_info($_FILES[$input_name]['tmp_name'][$i], $name);
				}
				
				$size += $_FILES[$input_name]['size'][$i];
				$temp_file = $_FILES[$input_name]['tmp_name'][$i];
			}
		}
		
		$this->check_file_size($size);
		
		if (!empty($this->error)) {
			$this->error .= "<br>Extensions allowed to be uploaded are <b>" . get_group_setting('allowed_files_upload') . "</b>";
			error_message($this->error);
		}
	}
	
	function check_file_extension($file_name)
	{
		$ext = strtolower(strrchr($file_name, '.'));
		if (!in_array($ext, $this->allowed_extensions)) {
			$this->error .= "File <b>$file_name</b> is not allowed to be uploaded on this website<br>";
		} else {
			return $ext;
		}
	}
	
	function check_file_size($files_size)
	{
		$files_size     = intval($files_size / 1024);
		$ini_max_upload = ini_get('upload_max_filesize') * 1024;
		if ($files_size > $ini_max_upload)
			$this->error .= "Website's server does not allow more than {$ini_max_upload} to be uploaded";
		else {
			if ($files_size > $this->max_size) {
				$this->error .= "The total size sum of uploaded files can not excceed {$this->max_size} KB<br>";
			}
		}
	}
	
	function check_image_info($temp_file, $image)
	{
		$image_info = getimagesize($temp_file);
		$x          = $image_info[0];
		$y          = $image_info[1];
		
		if ($x > $this->max_width) {
			$this->error .= "<b>$image</b> image's width can not excceed {$this->max_width}<br>";
		} elseif ($y > $this->max_height) {
			$this->error .= "<b>$image</b> image's height can not excceed {$this->max_height}<br>";
		}
	}
	
	function insert_file_info($file_name, $size, $type, $post_id, $location)
	{
		global $diy_db;
		
		$extension = strtolower(strrchr($file_name, '.'));
		$extension = substr($extension, 1);
		$time      = time();
		$module    = $this->module;
		$userid    = $_COOKIE['cid'];
		
		$diy_db->query("INSERT INTO diy_upload (post_id,
                                                 location,
                                                 userid,
                                                 type,
                                                 name,
                                                 size,
                                                 module,
                                                 extension,
												 date_added)
                                                 values
                                                ('$post_id',
                                                 '$location',
                                                 '$userid',
                                                 '$type',
                                                 '$file_name',
                                                 '$size',
                                                 '$module',
                                                 '$extension',
                                                 '$time')");
	}
	
	
	function update_file_info($file_name, $size, $type, $post_id, $location, $upload_id)
	{
	global $diy_db;
		$extension = strtolower(strrchr($file_name, '.'));
		$extension = substr($extension, 1);
		$time      = time();
		$module    = $this->module;
		$userid    = $_COOKIE['cid'];
		
	$diy_db->query("UPDATE diy_upload SET  type = '$type',
                                                 name = '$file_name',
                                                 size = '$size',
                                                 extension = '$extension',
												 date_added = '$time',
												 userid		= '$userid'
												 WHERE upid='$upload_id'");
												 
	}
	
	function delete_file_info($upload_id)
	{
		global $diy_db;
		$filename = get_file_path($upload_id . "." . $this->module);
		if (@unlink($filename)) {
			$diy_db->query("DELETE FROM diy_upload WHERE upid='$upload_id'");
			
		}
	}
	
	function check_existing_upload($post_id, $location)
	{
		global $diy_db;
		$module = $this->module;
		$result = $diy_db->query("SELECT * FROM diy_upload
							WHERE post_id='$post_id'
							AND location='$location'
							AND module ='$module'");
		if ($diy_db->dbnumrows($result) == 0)
		return false;
		else
		return true;
	}
}