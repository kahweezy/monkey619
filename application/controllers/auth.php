<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

class Auth extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->library('authlib');
        $this->load->helper('url');
    }
 
     
public function index()
{
    redirect('/auth/login'); // url helper function
}
 
public function register()
{
    $this->load->view('registerview',array('errmsg' => ''));
}
 
public function createaccount()
{
    $user = $this->input->post('user');
    $username = $this->input->post('uname');
    $password = $this->input->post('pword');
    $conf_password = $this->input->post('conf_pword');
 
    if (!($errmsg = $this->authlib->register($user,$username,$password,$conf_password))) {
        redirect('/auth/login');
    }
    else {
        $data['errmsg'] = $errmsg;
        $this->load->view('registerview',$data);
    }
 
}
public function login()
{
    $data['errmsg'] = '';
    $this->load->view('login_view',$data);
}
 
public function authenticate()
{
    $username = $this->input->post('uname');
    $password = $this->input->post('pword');
    $user = $this->authlib->login($username,$password);
    if ($user !== false) {
        $this->load->view('homepage',array('user' => $user['user']));
    }
    else {
        $data['errmsg'] = 'Unable to login - please try again';
        $this->load->view('login_view',$data);
    }
 
}
}

?>