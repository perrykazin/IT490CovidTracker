<?php

    include 'trackerclient.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];

    $loginauth = rabbitLogin($username, $password);
	echo $loginauth;
	
	if ($loginauth) 
	{
		echo 'loggedin';
		header("Location: test.html");
    }
	
	else
	{
		header("Location: login2.php");
		echo 'try again';
	}
 ?>
 