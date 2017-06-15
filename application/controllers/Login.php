<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()	{
		
		if ($this->session->user) {
			audit_log('WARNING: utente già loggato. '.current_url());
			redirect(base_url());
		}
		
		/* VALIDAZIONE FORM */
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'required',
				array('required' => '%s obbligatorio'
				)
		);
		$this->form_validation->set_rules('password', 'Password', 'required',
				array('required' => '%s obbligatoria'
				)
		);
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		
		$data['message']="<p class=\"login-box-msg\">Inserisci i tuoi dati</p>";		
		if ($this->form_validation->run() !== FALSE) {
			$post=$this->input->post();
			if (isset($post['remember'])) {
				$remember=true;
				unset($post['remember']);
			}else{
				$remember=false;
			}
			
			$post['password']=sha1($post['password']);
			if ($user=$this->persone->checkLogin($post)) {
				$this->persone->setLastLogin($user->id);
				$user=$this->persone->getUser($user->id);
				audit_log("MESSAGE: Login effettuato. User: ".json_encode($user));
				$this->session->set_userdata('user',$user);
				redirect(base_url());
			}else{
				audit_log("ERROR: Login non effettuato. Dati login: ".json_encode($post));
				$data['message']="<p class=\"login-box-msg text-danger\">Login errato</p>";
			}
		}		
		
		$this->common->lightView("login/index",true,$data);
		//$this->common->lightView("login/index");
	}
	
	public function logout() {
		
		if (!$this->session->user) {
			audit_log('WARNING: utente già loggato. '.current_url());
			redirect(base_url());
		}else{			
			audit_log("Message: logout effettuato. Dati utente: ".json_encode($this->session->user).". ".current_url());
			$this->session->sess_destroy();		
			redirect('login');
		}
		
	}
	
	public function checklogin() {
			
		if (!$this->input->post()) {
			audit_log("Error: parametri post non impostati. (login/checklogin)");
			exit("accesso non autorizzato");
		}
		
		$post=$this->input->post();
		
		if ( (!isset($post['user'])) || (!isset($post['password'])) ) {
			audit_log("Error: dati post login errati o incompleti: ".json_encode($post).". (login/checklogin)");
			echo "Login errato";
			exit();
		}
		
		$post['password']=sha1($post['password']);
				
		if ($bouser=$this->bousers->checkLogin($post)) {
			$this->session->bo_user=$bouser;
			// controllo se ho già record in accessi
			if ($login=$this->login->checkLogin($bouser->id)){
				// cancello la sessione corrispondente e il record
				$this->login->removeSession($login->id_session);
				$this->login->removeLogin($bouser->id);
			}
			// creo record in login
			$ci_session=$_COOKIE['ci_session'];
			$this->login->createLogin($bouser->id,$ci_session);
			
			audit_log("Message: login effettuato. Dati utente: ".json_encode($bouser).". (login/index)");
			echo "1";
		}else{
			audit_log("Error: login errato. Dati login: ".json_encode($post)." (login/checklogin)");
			echo "Login errato";
			audit_log("Error: login non effettuato. Dati login: ".json_encode($post).". (login/index)");
		}
		
	}
		
	
}
