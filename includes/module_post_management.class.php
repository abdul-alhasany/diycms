<?php

class module_post_management
{
    var $userid;
    var $time;
    var $location;
    var $content;
    var $query_keys;
    var $query_values;
    var $post_errors = array();
    
    // display inline error message
    function inline_error_message()
    {
        check_hook_function('post_management_error_message_start', $this->post_errors);
        if (!$this->check_errors()) {
            foreach ($this->post_errors as $value) {
                $errors .= "<li>{$value}</li>";
            }
        }
        check_hook_function('post_management_error_message_end', $errors);
        return $errors;
    }
    
    // check if there are any errors
    function check_errors()
    {
        return (count($this->post_errors) == 0) ? true : false;
    }
    
    // check for required fields in a certain post
    function check_required_entries($fields)
    {
        check_hook_function('post_management_required_entries_start', $fields);
        if (!required_entries($fields)) {
            $this->post_errors[] = ERROR_FILL_REQUIRED_FIELDS;
        }
        check_hook_function('post_management_required_entries_end', $fields);
        return;
    }
    
    // check if maximum chars is reached in a post
    function check_maximum_chars()
    {
        $max_chars = get_group_setting('maximum_posts_letters');
        check_hook_function('post_management_max_chars_start', $max_chars);
        if (!maximum_allowed($this->content, $max_chars)) {
            $this->post_errors[] = ERROR_MAXIMUM_EXCEEDED;
        }
        check_hook_function('post_management_max_chars_end', $empty);
        return;
    }
    
    // check if post is pending or approved
    function check_post_status($allow_status, $pending_url, $approve_url)
    {
        check_hook_function('post_management_post_status_start', $allow_status);
        if ($allow_status == 'no') {
            info_message(LANG_INFO_POST_PENDING, $pending_url);
        } else {
            info_message(LANG_INFO_POST_APPROVED, $approve_url);
        }
        check_hook_function('post_management_post_status_end', $empty);
        return;
    }
    
    // check if post is pending or approved
    function check_user_name($username)
    {
        if (isset($username)) {
            $this->check_required_entires($username);
            return $username;
        } else {
            $name = $_COOKIE['cname'];
            return $name;
        }
    }
    
    // get cateogery list
    function get_category_array($query)
    {
        global $diy_db;
        $result = $diy_db->query($query);
        while ($row = $diy_db->dbarray($result)) {
            $catid             = $row['catid'];
            $cat_title         = $row['cat_title'];
            $cat_array[$catid] = $cat_title;
        }
        return $cat_array;
    }
    
    // insert a post into database
    function insert_post($table_name)
    {
        global $diy_db;
        $query = $diy_db->query("INSERT INTO {$table_name} ({$this->query_keys}) values ({$this->query_values})");
        return $query;
    }
    
    // update a post in a database
    function update_post($table_name, $params, $condition)
    {
        global $diy_db;
        check_hook_function('post_management_insert_post_start', $empty);
        $query = $diy_db->query("UPDATE {$table_name} SET {$params} WHERE {$condition}");
        check_hook_function('post_management_insert_post_end', $query);
        return $query;
    }
    
    // delete a post from database
    function delete_post($table_name, $condition)
    {
        global $diy_db;
        check_hook_function('post_management_delete_post_start', $empty);
        $query = $diy_db->query("DELETE FROM {$table_name} WHERE {$condition}");
        check_hook_function('post_management_delete_post_end', $query);
        return $query;
    }
    
    // delete uploaded file and its relevant database table row
    function delete_uploaded_file($condition)
    {
        global $diy_db;
        check_hook_function('post_management_delete_uploaded_file_start', $empty);
        $result = $diy_db->query("SELECT * FROM diy_upload WHERE {$condition}");
        while ($row = $diy_db->dbarray($result)) {
            $file_path = get_file_path($row['upid']);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $query = $diy_db->query("DELETE FROM diy_upload WHERE {$condition}");
        check_hook_function('post_management_delete_uploaded_file_end', $query);
        return $query;
    }
    
}