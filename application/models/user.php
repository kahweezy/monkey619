<?php

class User extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    function register($user,$username,$pwd)
    {
        // is username unique?
        $res = $this->db->get_where('users',array('username' => $username));
        if ($res->num_rows() > 0) {
            return 'Username already exists';
        }
        // username is unique
        $hashpwd = sha1($pwd);
        $data = array('user' => $user,'username' => $username,
                      'password' => $hashpwd);
        $this->db->insert('users',$data);
        return null; // no error message because all is ok
    }

function login($username,$pwd)
{
    $this->db->where(array('username' => $username,'password' => sha1($pwd)));
    $res = $this->db->get('users',array('user'));
    if ($res->num_rows() != 1) { // should be only ONE matching row!!
        return false;
    }
 
    // remember login
    $session_id = $this->session->userdata('session_id');
    // remember current login
    $row = $res->row_array();
    $this->db->insert('login',array('user' => $row['user'],'session_id' => $session_id));
    return $res->row_array();
}
 
function is_loggedin()
{
    $session_id = $this->session->userdata('session_id');
    $res = $this->db->get_where('login',array('session_id' => $session_id));
    if ($res->num_rows() == 1) {
        $row = $res->row_array();
        return $row['user'];
    }
    else {
        return false;
    }
}
}

?>