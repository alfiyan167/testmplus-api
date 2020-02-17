<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

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
		$this->load->model('model_book');	
	}

	public function output($outputData) {
		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($outputData, JSON_PRETTY_PRINT))
			->_display();
			exit;
	}

  public function get_book() {
    $data = array();
    $query = $this->model_book->get_book();
    foreach ($query as $arr) {
      $data[] = (object)array(
        'id_book' => $arr['id_book'],
        'title' => $arr['title'],
        'author' => $arr['author'],
        'date_published' => $arr['date_published'],
        'number_of_page' => $arr['number_of_page'],
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

	public function insert_book() {
		$param = array(
      'title' => $this->input->post('title'),
      'author' => $this->input->post('author'),
      'date_published' => $this->input->post('date_published'),
      'number_of_page' => $this->input->post('number_of_page'),
      'id_type_of_book' => $this->input->post('id_type_of_book')
    );

    $query = $this->model_book->insert_book($param);
    if($query == 'failed') {
			$output = (object)array(
        'status' => false,
        'message' => 'Add Data Failed',
        'data' => null        
			);
		}else if($query == 'success') {
      $output = (object)array(
        'status' => true,
        'message' => 'Add Data Success',
        'data' => null        
			);
    }
    $this->output($output);
	}

	public function update_book() {
		$param = array(
      'id_book' => $this->input->post('id_book'),
      'title' => $this->input->post('title'),
      'author' => $this->input->post('author'),
      'date_published' => $this->input->post('date_published'),
      'number_of_page' => $this->input->post('number_of_page'),
      'id_type_of_book' => $this->input->post('id_type_of_book')
    );

    $query = $this->model_book->update_book($param);
    if($query == 'failed') {
			$output = (object)array(
        'status' => false,
        'message' => 'Update Data Failed',
        'data' => null        
			);
		}else if($query == 'success') {
      $output = (object)array(
        'status' => true,
        'message' => 'Update Data Success',
        'data' => null        
			);
    }
    $this->output($output);
	}

	public function delete_book() {
		$param = array(
      'id_book' => $this->input->post('id_book')
    );

    $query = $this->model_book->delete_book($param);
    if($query == 'failed') {
			$output = (object)array(
        'status' => false,
        'message' => 'Delete Data Failed',
        'data' => null        
			);
		}else if($query == 'success') {
      $output = (object)array(
        'status' => true,
        'message' => 'Delete Data Success',
        'data' => null        
			);
    }
    $this->output($output);
	}

}