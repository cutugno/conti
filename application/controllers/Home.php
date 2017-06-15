<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()	{
		if (!$this->session->user) {
			audit_log('WARNING: tentativo accesso non autorizzato. '.current_url());
			redirect('login');
		}
		$data['active']="dashboard";
		$this->common->fullView("welcome_message","Dashboard","App gestione conti",false,$data);
	}
}
