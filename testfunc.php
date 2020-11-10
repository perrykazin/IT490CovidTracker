<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function logintest($username,$password)
{
    $dbconnect = new mysqli("52.167.119.56","root","it490Group2!!!","user_credentials");
	
	if ($dbconnect->errno != 0){

		echo "Failed to connect to database: ".$dbconnect->error.PHP_EOL;
		exit(0);
	}

	echo "<br><br>Successfully connected to database".PHP_EOL;

	$query = mysqli_query($dbconnect,"SELECT * FROM users WHERE username = '$username' AND password = '$password' ");
	$count = mysqli_num_rows($query);

	if ($count == 1){
			echo "<br><br>User verification successful";
			return true;
        }else{
            echo "<br><br>User verification failed";
        	return false;
		}
		
    //$response = $dbconnect->query($query);
    
	if ($dbconnect->errno !=0){
		echo "<br><br>Failed to execute query: ".PHP_EOL;
		echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
		exit(0);
	}

}

echo logintest("david", "password");

?>
