<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {
	
	/* Passed the messages by a poster to the view*/
	public function view($name){
		$this->load->model('Messages_model');
		$userMessages = $this->Messages_model->getMessagesByPoster($name);	
		if($userMessages){
			$data['username'] = $name;
			$data['messagesData'] = $userMessages;
			$this->load->view('View_messages',$data);
		}		
	}
	
	/* If the user is logged in, displays it's posts, otherwise redirects to the login*/	
	public function index(){
		$userSession = $this->session->userdata('loggedIn');
		if(!isset($userSession['username']) || $userSession['username'] == "")
			redirect('user/login','refresh');
		else $this->load->view('View_post');
	}
	
	/* is used to pass post information therefore can me inserted into the database*/
	public function doPost(){
		$userSession = $this->session->userdata('loggedIn');
		$user = $userSession['username'];
		if(!isset($userSession['username']) || $userSession['username'] == "")
			redirect('user/login','refresh');
		$postMessage = $this->input->post('message');
		$this->load->model('Messages_model');
		$postStatus = $this->Messages_model->insertMessage($user, $postMessage);
		$url = ("user/view/$user");
		redirect($url, 'refresh');
			
	}
}
?>