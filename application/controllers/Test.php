<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()	{
		$data = array(
				'nome' => 'Prova De Provi',
				'email' => 'prova@prova.com',
				'username' => 'prova',
				'password' => sha1('prova')
		);

		$persona = Model\Persone::make($data);

		if ( ! $persona->save())
		{
				echo 'Errore creazione : ';
				print_r($persona->errors);
		}
		else
		{
				echo 'Persona correttamente creata con id '.Model\Persone::last_created()->id;
		}
	}
	
	public function conto() {
		
		// $data in realtà verrà dal post 
		$data = array(
				'id_creatore' => '1',
				'descrizione' => 'Conto di prova',
				'persone'     => array(1,2)
		);
		$persone=$data['persone']; unset ($data['persone']);
		
		// salvo conto
		$conto = Model\Conti::make($data);
		if ( ! $conto->save()) {
			echo 'Errore creazione : ';
			print_r($conto->errors);
		}else{
			// salvo n record conti_persone
			$new_id=Model\Conti::last_created()->id;
			foreach ($persone as $id_persona) {
				$data = array(
					'id_conto' 		=> $new_id,
					'id_persona'	=> $id_persona
				);
				$cp = Model\Conti\Persone::make($data);
				$cp->save();
			}
			
			echo "Conto creato correttamente con id $new_id";	
		}		
	}
	
	public function spesa($id_conto) {
		
		// $data in realtà verrà dal post 
		$data = array(
				'id_conto'	  => $id_conto,
				'id_creatore' => '1',
				'importo'	  => '35.50',
				'descrizione' => 'Spesa di prova'
		);
		
		// salvo conto
		$spesa = Model\Spese::make($data);
		if ( ! $spesa->save()) {
			echo 'Errore creazione : ';
			print_r($spesa->errors);
		}else{
			// salvo n record conti_persone
			$new_id=Model\Spese::last_created()->id;
			echo "Spesa creata correttamente con id $new_id";	
		}		
		
	}
		
		
	
	public function delete_conto($id) {
			
		if (Model\Conti::delete($id)) {
			/*
			$sp = Model\Spese::find_by_id_conto($id);
			foreach ($sp as $delete) {
				Model\Spese::delete($delete->id);
			}
			*/ 
			$cp = Model\Conti\Persone::find_by_id_conto($id);
			foreach ($cp as $delete) {
				Model\Conti\Persone::delete($delete->id);
			}
			echo "Conto cancellato";
		}else{
			echo "Errore cancellazione conto";
		}
		
	}
		
}
