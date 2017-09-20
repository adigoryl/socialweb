<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model {
	
	/* This function checks user login input */
	public function checkLogin($username,$password){
		$this->db->where("username",$username);
		$this->db->where("password",sha1($password));
		$query = $this->db->get("Users");
		if(count($query) > 0)
			return $query->result();
		else return false;
	}
	/* Returns true if a $follower is following a person under $followed*/
	public function isFollowing($follower,$followed){
		$params = array($follower, $followed);
		$query = $this->db->query("SELECT * FROM User_Follows WHERE follower_username = ? AND followed_username = ?", $params);
		if($query->num_rows() > 0)
			return true;
		else return false;
	}
	/* If a user is logged in, takes it's session username & the parameter $followed and insert into the database 
		resulting is adding friends functionality */		
	public function follow($followed){
		$userSession = $this->session->userdata('loggedIn');
		if(isset($userSession['username']) && $userSession['username'] !== ""){
			$username = $userSession['username'];
			$data = array(
				'follower_username' => $username,
				'followed_username' => $followed
			);
			$insertedData = $this->db->insert('User_Follows', $data);
			return $insertedData;
		} else redirect('user/login','refresh');	
		 
	}
}
?>