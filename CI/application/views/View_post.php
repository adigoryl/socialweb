<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>aw593 - web dev assessment 1</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css"/>
</head>
<?php 
	$userSession = $this->session->userdata('loggedIn');
	if(isset($userSession['username']) && $userSession['username'] !== "")
		$userName = $userSession['username'];
?>
<header>	
	<span id="header">Wastebook</span>
</header>

<body>
	<div id="nav">
		<ul>
			<li><a href="<?php echo site_url("user/view/$userName");?>">Waste-Wall</a></li>
			<li><a href="<?php echo site_url('search');?>">Search Posts</a></li>
			<li><a href="<?php echo site_url("user/feed/$userName");?>">Friends' Posts</a></li>
			<li><a href="<?php echo site_url('message');?>" class="active" >Post</a></li>
			<li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
		</ul>
	</div>

	<?php $this->load->helper('form');	
	echo form_open('message/doPost'); ?>
		<fieldset>
		<legend>Post a message:</legend>
			<label for="message">Message:</label> <br>
			<input type="text" id="message" name="message"></input><br>
			<button type="submit">Post</button>
		</fieldset>
	</form>
		
</body>

</html>