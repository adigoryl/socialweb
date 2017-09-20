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
<?php //to catch an error when user is not logged in and clicks on a navigation button which requires a session's username
	$userSession = $this->session->userdata('loggedIn');
	$userName = null; $userName1 = null;
	if(isset($userSession['username']) && $userSession['username'] !== ""){
		$tempName = $userSession['username'];
		$userName = "user/feed/$tempName"; $userName1 = "user/view/$tempName";	
	}else {$userName = "user/login"; $userName1 = "user/login";}
?>

<header>	
	<span id="header">Wastebook</span>
</header>

<body>
	<div id="nav">
		<ul>
			<li><a href="<?php echo site_url("$userName1");?>">Waste-Wall</a></li>
			<li><a href="<?php echo site_url("$userName");?>">Friends' Posts</a></li>
			<li><a href="<?php echo site_url('search');?>">Search Posts</a></li>
			<li><a href="<?php echo site_url('message');?>">Post</a></li>
			<li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
		</ul>
	</div>
	
   <h1> <?php if(isset($username)) echo $username."'s wall"; ?> </h1> 

   <?php if(isset($messagesData)){?>
		<table>
            <tr>
                <td><h2>Messages</h2></td>
				<br/>
            </tr>      
			
		<?php foreach($messagesData as $row){?>
				<tr>
					<td>
						<span class="text"><?php echo $row->text;?></span><br/>
						<span class="postData"><?php echo $row->user_username;?></span>
						<span class="postData">posted at: <?php echo $row->posted_at;?></span>

					</td>
				</tr>
				<tr> </tr><tr> </tr><tr></tr><tr></tr>
				
		<?php  } ?>
        </table>
	<?php } else { ?> <h2>No posts yet.</h2><?php } ?>
		
</body>

</html>