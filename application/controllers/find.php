<?php
class find extends CI_Controller {
	function __construct(){

	parent::__construct();
	$this->load->model('searchmodel');
	
}

	public function index(){

	$this->load->view('homepage');
	
}
	
	public function findemp() {

	$values = $this->input->get();
	$result = $this->searchmodel->getsearchvalues($values);
	echo json_encode($result);
	}

}
?>
