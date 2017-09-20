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

<body>
	<div id="nav">
		<ul>
		  <li><a href="<?php echo site_url('search');?>">Search Posts</a></li>
		</ul>
	</div>
<?php 
	$this->load->helper('form');
	echo form_open('user/doLogin'); //opening form tag <form method="post" accept-charset="utf-8" action="http://example.com/index.php/user/login">
?>
		<fieldset>
			<legend>Login:</legend>
				<label for="username">Username:</label> <br>
				<input type="text" id="username" name="username" value="kris" required><br>
				<label for="password">Password:</label><br>  
				<input type="password" id="password" name="password" value="password" required><br><br>
				<button type="submit">Login</button>
		</fieldset>
	<form> <!-- closing tag, as form_open creates an opening tag-->
	<?php if(isset($error)){ echo $error; }?>	<!-- error message if wrong password -->
</body>

</html>