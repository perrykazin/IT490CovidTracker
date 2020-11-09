<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//Handles LOGIN from Front End
function loginauth($user,$pass){
    //mysqli connect
    //VERIFY LOGIN CREDENTIALS
    if () {
        return true;
    }
    else {
        return false;
    }
}

//Handles REGISTER from Front End
function registerauth($username,$password){
    //mysqli connect
    //INSERT into users (username, password) values ($request['username'], $request['password']);
}

//Handles API PUSH from Back End
function apidb($cases,$deaths){
    //mysqli connect
    //INSERT into corona_stats (totals_cases, total_deaths) values ($request['cases'], $request['deaths']);
}

//Main Server Thread
function request_processor($request){
	echo "Received Request of type ".$request['type'].PHP_EOL;
    echo "<pre>" . var_dump($request) . "</pre>";
    
    //Check for 'type' variable in array
    if(!isset($request['type'])){
		return "Error: unsupported message type";
    }

    $link = mysqli_connect('localhost', 'root', 'it490Group2!!!', 'user_credentials');

	//Check message type
	$type = $request['type'];
	switch($type){
        case "login":
            return loginauth($request['username'],$request['password']);
        case "register":
            registerauth($request['username'],$request['password']);
            return true;
        case "apipush":
            apidb($request['cases'], $request['deaths']);
            return true;
    }
    
	return array("return_code" => '0',
		"message" => "Server received request and processed it");
}

$server = new rabbitMQServer("DatabaseServer.ini", "databaseServer");

echo "DB Handler Start" . PHP_EOL;
$server->process_requests('request_processor');
echo "DB Handler Stop" . PHP_EOL;
exit();
?>
