<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Search extends CI_Controller {
		
		public function index(){
			$this->load->view('View_search');
		}		
		/* Takes care of passing the messages that concatenate with a given String*/
		public function doSearch(){
			$this->load->model('Messages_model');
			$string = $this->input->get("messagesByWords");
			$messagesContaningString = $this->Messages_model->searchMessages($string);
			
			if($messagesContaningString){
				$data['messagesData'] = $messagesContaningString;
				$this->load->view('View_messages', $data);
			}else{
				$invalid['error'] = "No messages match your word. Please try a different word.";
				$this->load->view('View_search',$invalid);
			}
		}
					
	}
?>