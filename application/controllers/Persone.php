<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persone extends CI_Controller {

	public function nuova()	{
		if (!$this->session->user) {
			audit_log('WARNING: tentativo accesso non autorizzato. '.current_url());
			redirect('login');
		}
		$data['active']="persone";
		$this->common->fullView("persone/nuova","Persone","Inserimento record",false,$data);
	}
}
