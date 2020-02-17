<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Model_book extends CI_Model {

		function get_book() {
			$query = $this->db->query("SELECT b.id_book, b.title, b.author, b.date_published, b.number_of_page, t.type_of_book
																	FROM book AS b
																	LEFT JOIN type_of_book AS t ON t.id_type_of_book = b.id_type_of_book
																	GROUP BY b.id_book DESC;");
			return $query->result_array();
		}

		function insert_book($param) {
			$title = $param['title'];
      $author = $param['author'];
      $date_published = $param['date_published'];
      $number_of_page = $param['number_of_page'];
      $id_type_of_book = $param['id_type_of_book'];

			$this->db->trans_start();
			$this->db->query("INSERT INTO book(title, author, date_published, number_of_page, id_type_of_book) VALUES('$title', '$author', '$date_published', '$number_of_page', '$id_type_of_book');");
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return 'failed';
			}else {
				$this->db->trans_commit();
				return 'success';
			}
		}

		function update_book($param) {
			$id_book = $param['id_book'];
			$title = $param['title'];
      $author = $param['author'];
      $date_published = $param['date_published'];
      $number_of_page = $param['number_of_page'];
      $id_type_of_book = $param['id_type_of_book'];

			$this->db->trans_start();
			$this->db->query("UPDATE book
												SET title = '$title',
														author = '$author',
														date_published = '$date_published',
														number_of_page = '$number_of_page',
														id_type_of_book = '$id_type_of_book'
												WHERE id_book = '$id_book';");
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return 'failed';
			}else {
				$this->db->trans_commit();
				return 'success';
			}
		}

		function delete_book($param) {
			$id_book = $param['id_book'];

			$this->db->trans_start();
			$this->db->query("DELETE FROM book WHERE id_book = '$id_book';");
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return 'failed';
			}else {
				$this->db->trans_commit();
				return 'success';
			}
		}

	}
?>