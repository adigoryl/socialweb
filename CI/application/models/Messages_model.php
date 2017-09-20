<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Messages_model extends CI_Model {
	/* Returns all the messages from the database under the parameter $name. If none, returns false*/
	public function getMessagesByPoster($name){
		$this->db->where("user_username",$name);
		$query = $this->db->get("Messages");
		if(count($query) > 0)
			return $query->result();	
		else return false;		
	}
	/* Returns all posts that concatenate with the $string param*/
	public function searchMessages($string){
		$this->db->like("text",$string);
		$query = $this->db->get("Messages");
		if(count($query) > 0)
			return $query->result();	
		else return false;
	}
	/* Inserts a message to the database, alog with date and the poster*/
	public function insertMessage($poster, $string){
		$date = date('Y-m-d H:i:s');
		$data = array(
			'user_username' => $poster,
			'text' => $string,
			'posted_at' => $date
		);
		$inData = $this->db->insert('Messages', $data);
		return $inData;
	}
	/* Gets all the friends' posts*/
	public function getFollowedMessages($name){
		$query = $this->db->query("SELECT * FROM Messages m JOIN User_Follows f ON m.user_username = f.followed_username WHERE follower_username = ?", $name);		
		if(count($query) > 0)
			return $query->result();	
		else return false;			
	}
}
?>