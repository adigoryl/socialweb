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

<header>	
	<span id="header">Wastebook</span>
</header>

<?php ///to catch an error when user is not logged in and clicks on a navigation button which requires a session's username
	$userSession = $this->session->userdata('loggedIn');
	$userName = null; $userName1 = null;
	if(isset($userSession['username']) && $userSession['username'] !== ""){
		$tempName = $userSession['username'];
		$userName = "user/feed/$tempName"; $userName1 = "user/view/$tempName";	
	}else {$userName = "user/login"; $userName1 = "user/login";}
?>
<body>
	<div id="nav">
		<ul>
			<li><a href="<?php echo site_url("$userName1");?>" >Waste-Wall</a></li>
			<li><a href="<?php echo site_url("$userName");?>" >Friends' Posts</a></li>
			<li><a href="<?php echo site_url('search');?>" class="active" >Search Posts</a></li>
			<li><a href="<?php echo site_url('message');?>">Post</a></li>
			<li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
		</ul>
	</div>
	<h1>Search For Messages by Words</h1>
	
	<form action="<?php echo site_url('search/doSearch/');?>" method="get">  
		<table>
			<tr><td><label for="messagesByWords">Search for messages by words:</label></td></tr>
			<tr><td><input type="text" name="messagesByWords" required></input></td><tr>
			<tr><td><button type="submit">Search</button></td><tr>
		</table>   
	</form>
	<?php if(isset($error))
			echo $error;
		?>
</body>

</html>