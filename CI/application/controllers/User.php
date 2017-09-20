<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	/* Allows to see a wall of certain person, returns a message if there are no posts.
		if the user is logged in, when viewing someone's wall and this person is not your friend,
		allows to add this person to your friend list. */
	public function view($name){
		$this->load->model('Messages_model');
		$this->load->model('Users_model');
		$userMessages = $this->Messages_model->getMessagesByPoster($name); //gets all the messages of user/view/$username
		$data = array();
		if($userMessages){		//if there is at least 1 post
			$data['username'] = $name;
			$data['messagesData'] = $userMessages;
		}else{
			$data['username'] = $name;
			$data['messagesData'] = null;
		}
		$userSession = $this->session->userdata('loggedIn');
		if(isset($userSession['username']) && $userSession['username'] !== "" && $userSession['username'] !== $name){
			$user = $userSession['username'];
			$follow = $this->Users_model->isFollowing($user,$name); //returns boolean, true = friends already
			if(!$follow){
				$this->load->helper('form');
				echo form_open("user/follow/$name"); 
				echo '<input type="submit" value="Follow"></input>';
				echo '</form>';
			}	
		}
		$this->load->view('View_messages',$data);
	}

	public function login(){
		$this->load->view('View_login');
	}	
	
	/* If login data is correct, sets a session under the name loggedIn, otherwise displays the login page with an error*/
	public function doLogin(){
		$this->load->model('Users_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$loginData = $this->Users_model->checkLogin($username,$password);
		if($loginData){		
			$sessionData = array();
			foreach($loginData as $row){
				$sessionData = array(
					'username' => $row->username,
				);
				$this->session->set_userdata('loggedIn',$sessionData);		
			} 
			$url = ("user/view/$username");
			redirect($url, 'refresh');
		}else{
			$invalid['error'] = "Incorrect login details. Please try again.";
			$this->load->view('View_login',$invalid);

		}
	}
	/* Logs the user out, destroys the session variable and redirects to the login page*/
	public function logout(){
		$this->session->unset_userdata('loggedIn');
		session_destroy();
		redirect('user/login','refresh');
	}
	
	/* passes a person which you chose to follow*/
	public function follow($followed){
		$this->load->model('Users_model');
		$this->Users_model->follow($followed);
		$url = ("user/view/$followed");
		redirect($url, 'refresh');
	}
	/* displayes all the messages of your friends*/
	public function feed($name){
		$this->load->model('Messages_model');
		$followedMessages['messagesData'] = $this->Messages_model->getFollowedMessages($name);
		$this->load->view('View_messages',$followedMessages);
	}
}
?>