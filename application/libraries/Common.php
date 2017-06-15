<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Common {

    public function __construct() {
		
    }
   
   /* -- fullView --
  
      Funzione da chiamare in ogni controller che gestisce una pagina completa
     
      $page: 			il nome della view da caricare (comprensivo di eventuale folder)
      $header: 			il titolo della pagina
      $description:		il sottotitolo della pagina
      $scripts: 		flag per decidere se caricare gli script js custom della pagina 
      $additional_data: array di dati supplementari da passare alla view
          
   */
    public function fullView($page,$header="",$description="",$scripts=true,$additional_data=array()) {
	   
	   $CI =& get_instance();
	   $data=$additional_data;
	   $data['active']=$this->setActiveNavigation($data['active']);
	   
	   $data['page_content']=$CI->load->view($page,'',true);
	   $data['page_header']=$header;
	   $data['page_description']=$description;	   
	 	   
	   $CI->load->view('common/open',$data);
	   $CI->load->view('common/topbar');
	   $CI->load->view('common/navigation');	   
	   $CI->load->view('common/content-wrapper');
	   $CI->load->view('common/right-sidebar');
	   $CI->load->view('common/scripts');
	   if ($scripts) $CI->load->view($page.'_scripts');
	   $CI->load->view('common/close');
	 
    }
   
    /* -- setActiveNAvigation --
     
      Funzione che imposta la classe active al pulsante attuale, passato come parametro aggiuntivo nei controller ($data['active']). Gli altri pulsanti avranno classe ""
      
      $active_item: nome della pagina che verrà settata active
      
    */
    public function setActiveNavigation($active_item) {
	   $navs=["dashboard","persone"]; // tutte i pulsanti di primo livello del menu
	   $active_array=array();
	   foreach ($navs as $nav) {
		   $active=$nav==$active_item ? "active" : "";
		   $active_array[$nav]=$active;
	   }
	   return $active_array;
	}
	   
   
   
    /* -- lightView --
  
      Funzione da chiamare in ogni controller che gestisce una pagina light (senza menu e wrapper)
     
      $page: 		il nome della view da caricare (comprensivo di eventuale folder)
      $scripts: 	flag per decidere se caricare gli script js custom della pagina 
      $data: 		array di dati supplementari da passare alla view
          
   */
    public function lightView($page,$scripts=true,$data=array()) {
	   
	   $CI =& get_instance();
	  
	   $CI->load->view('common/open',$data);   
	   $CI->load->view($page);
	   $CI->load->view('common/scripts');
	   if ($scripts) $CI->load->view($page.'_scripts');
	   $CI->load->view('common/close');
	   
    }
}
