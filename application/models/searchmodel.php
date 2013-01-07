<?php

class searchmodel extends CI_Model {
function __construct(){
parent::__construct();
$this->load->database();
}

function getsearchvalues($values){
	$this->db->select('employees.first_name AS firstname, employees.last_name AS lastname');
	$this->db->select('titles.title AS jobtitle');
	$this->db->select('departments.dept_name AS dept');
	$this->db->where('titles.to_date', '9999-01-01');
	$this->db->where('dept_emp.to_date', '9999-01-01');
	if($values['firstname'] != '') {
		$this->db->where('employees.first_name', $values['firstname']);
	}
	if($values['lastname'] != '') {
		$this->db->where('employees.last_name', $values['lastname']);
	}
	if($values['dept'] != '') {
		$this->db->where('departments.dept_name', $values['dept']);
	}
	if($values['jobtitle'] != '') {
		$this->db->where('titles.title', $values['jobtitle']);
	}
	$this->db->from('employees');
	$this->db->join('titles', 'employees.emp_no = titles.emp_no');
	$this->db->join('dept_emp', 'employees.emp_no = dept_emp.emp_no');
	$this->db->join('departments', 'dept_emp.dept_no = departments.dept_no');
	$this->db->order_by('employees.emp_no', 'asc');
	$result = $this->db->get();
	return $result->result_array();	
}
}
?>
