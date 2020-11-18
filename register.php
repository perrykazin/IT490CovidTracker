<?php

    include 'trackerclient.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];

    $registerauth = rabbitRegister($username, $password);
	echo $registerauth;
	
	if ($registerauth) 
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
 