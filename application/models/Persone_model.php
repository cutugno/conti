<?php

	class Persone_model extends CI_Model {

		public function __construct() {
				parent::__construct();
				$this->load->database();
		}
		
		public function checkLogin ($dati) {
			$query=$this->db->where($dati)
							->get('persone');
			return $query->row();			
		}
		
		public function setLastLogin($id) {
			$query=$this->db->set('last_login','now()',false)
							->where('id',$id)
							->update('persone');
			return $query;
		}
		
		public function getUser($id) {
			$query=$this->db->where('id',$id)
							->get('persone');
			return $query->row();
		}
			
	}

?>
