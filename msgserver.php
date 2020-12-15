<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function loginpass($username,$password)
{
    $dbconnect = new mysqli('10.1.0.5','root','it490Group2!!!','user_credentials', '');
	
	if ($dbconnect->errno != 0){

		echo "Failed to connect to database: ".$dbconnect->error.PHP_EOL;
		exit(0);
	}
    else {
	    echo "Successfully connected to database".PHP_EOL;
    }

	$query = mysqli_query($dbconnect,"SELECT * FROM users WHERE username = '$username' AND password = '$password' ");
	$count = mysqli_num_rows($query);

	if ($count == 1){
		echo "User verification successful".PHP_EOL;
		return true;
    }
    else{
        echo "User verification failed".PHP_EOL;
        return false;
    }
		
    $response = $dbconnect->query($query);
    
	if ($dbconnect->errno !=0){
		echo "Failed to execute query: ".PHP_EOL;
		echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
		exit(0);
	}

}

function registerpass($username,$password)
{
    $dbconnect = new mysqli('10.1.0.5','root','it490Group2!!!','user_credentials');

    if ($dbconnect->errno != 0){
        echo "Failed to connect to database: ".$dbconnect>error.PHP_EOL;
        exit(0);
    }
    else {
        echo "Successfully connected to database".PHP_EOL;
    }

    $checkquery = mysqli_query($dbconnect,"SELECT * FROM users WHERE username = '$username' ");
	$count = mysqli_num_rows($checkquery);

    if ($count != 0){
        $query = mysqli_query($dbconnect,"INSERT INTO users (username, password) VALUES ('$username', '$password')");
        echo "Account created".PHP_EOL;
        return true;
    }
    else {
        echo "An account with that username already exists".PHP_EOL;
        return false;
    }

    if ($dbconnect->errno !=0){
        echo "Failed to execute query: ".PHP_EOL;
        echo __FILE__.':'.__LINE__.":error: ".$dbconnect->error.PHP_EOL;
        exit(0);
    }
}

function populatepass ()
{
    $dbconnect = new mysqli('10.1.0.5','root','it490Group2!!!','user_credentials');

    if ($dbconnect->errno != 0){
        echo "Failed to connect to database: ".$dbconnect>error.PHP_EOL;
        exit(0);
    }
    else {
        echo "Successfully connected to database".PHP_EOL;
    }

    $query = mysqli_query($dbconnect,"SELECT * FROM corona_stats ORDER BY my_timestamp DESC LIMIT 1");

    return $query;
}

function apipass ($uscases,$usdeaths,$njcases,$njdeaths,$nycases,$nydeaths)
{
    $dbconnect = new mysqli('10.1.0.5','root','it490Group2!!!','user_credentials');

    if ($dbconnect->errno != 0){
        echo "Failed to connect to database: ".$dbconnect>error.PHP_EOL;
        exit(0);
    }
    else {
        echo "Successfully connected to database".PHP_EOL;
    }

    $query = mysqli_query($dbconnect,"INSERT INTO corona_stats (total_cases, total_deaths, nj_cases, nj_deaths, ny_cases, ny_deaths) VALUES ('$uscases', '$usdeaths', '$njcases', '$njdeaths', '$nycases', '$nydeaths')");
    echo "Database updated".PHP_EOL;
    return true;

    if ($dbconnect->errno !=0){
        echo "Failed to execute query: ".PHP_EOL;
        echo __FILE__.':'.__LINE__.":error: ".$dbconnect->error.PHP_EOL;
        exit(0);
    }
}

function request_processor($request){
	echo "Received Request".PHP_EOL;
    echo "<pre>" . var_dump($request) . "</pre>";
    
	if(!isset($request['type'])){
		return "Error: unsupported message type";
    }
    
	//Handle message type
	$type = $request['type'];
	switch($type){
		case "login":
			return loginpass($request['username'], $request['password']);
		case "register":
            return registerpass($request['username'], $request['password']);
        case "populate":
            return populatepass();
        case "apipush":
            return apipass($request['cases'], $request['deaths']);
    }
    
	return array("return_code" => '0',
		"message" => "Server received request and processed it");
}

$server = new rabbitMQServer("messageServer.ini", "messageServer");

echo "Rabbit MQ Server Start" . PHP_EOL;

$server->process_requests('request_processor');

echo "Rabbit MQ Server Stop" . PHP_EOL;

exit();

?>
