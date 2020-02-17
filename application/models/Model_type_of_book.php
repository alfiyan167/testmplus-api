<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Model_type_of_book extends CI_Model {

		function get_type_of_book() {
			$query = $this->db->query("SELECT id_type_of_book, type_of_book FROM type_of_book;");
			return $query->result_array();
		}

	}
?>