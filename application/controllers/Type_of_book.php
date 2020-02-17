<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_of_book extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		$auth = $this->input->get_request_header('Authorization');
		$basic_auth = 'Basic 56265883.0bd9.4623.a532.bee66946449a';
		if($method == "OPTIONS" || !$auth || $auth != $basic_auth) {
		    die();
		}

		$this->load->helper('string');
		$this->load->model('model_type_of_book');	
	}

	public function output($outputData) {
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($outputData, JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

	public function get_type_of_book() {
		$data = array();
		$query = $this->model_type_of_book->get_type_of_book();
		foreach ($query as $arr) {
			$data[] = (object)array(
				'id_type_of_book' => $arr['id_type_of_book'],
				'type_of_book' => $arr['type_of_book']
			);
		}

		$output = (object)array(
        'status' => true,
        'message' => 'Success',
        'data' => $data       
			);
		$this->output($output);
	}

}