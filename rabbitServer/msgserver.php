<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//Passes LOGIN request to DB and waits for response
//function loginpush($username,$password){
//    $client = new rabbitMQClient("databaseServer.ini", "databaseServer");

//    if (isset($argv[1]))
//    {
//        $msg = $argv[1];
//    }
//    else
//    {
//        $msg = "test message";
//    }

//    $request = array();
//    $request['type'] = "login";
//    $request['username'] = $username;
//    $request['password'] = $password;
//    $request['message'] = $msg;

//    $response = $client->send_request($request);
//    $response = $client->publish($request);

//    echo "client received response: ".PHP_EOL;
//    print_r($response);
//    return $response;
//    echo "\n\n";

//    echo $argv[0]." END".PHP_EOL;
//}

function loginpass($username,$password)
{
    $dbconnect = new mysqli('52.167.119.56','root','it490Group2!!!','user_credentials');
	
	if ($dbconnect->errno != 0){

		echo "Failed to connect to database: ".$dbconnect->error.PHP_EOL;
		exit(0);
	}

	echo "<br><br>Successfully connected to database".PHP_EOL;

	$query = mysqli_query($dbconnect,"SELECT * FROM users WHERE username = '$username' AND password = '$userpass' ");
	$count = mysqli_num_rows($query);

	if ($count == 1){
			echo "<br><br>User verification successful";
			return true;
        }else{
            echo "<br><br>User verification failed";
        	return false;
		}
		
    //$response = $mydb->query($query);
    
	if ($dbconnect->errno !=0){
		echo "<br><br>Failed to execute query: ".PHP_EOL;
		echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
		exit(0);
	}

}

//Passes REGISTER request to DB and waits for response
//function registerpush($username,$password){
//    $client = new rabbitMQClient("databaseServer.ini", "databaseServer");
//
//    if (isset($argv[1]))
//    {
//        $msg = $argv[1];
//    }
//    else
//    {
//        $msg = "test message";
//    }
//
//    $request = array();
//    $request['type'] = "register";
//    $request['username'] = $username;
//    $request['password'] = $password;
//    $request['message'] = $msg;
//
//    $response = $client->send_request($request);
//    $response = $client->publish($request);
//
//    echo "client received response: ".PHP_EOL;
//    print_r($response);
//    return $response;
//    echo "\n\n";
//
//    echo $argv[0]." END".PHP_EOL;
//}

function registerpass($username,$password)
{
    $dbconnect = new mysqli('52.167.119.56','root','it490Group2!!!','user_credentials');

    if ($dbconnect->errno != 0){
        echo "<br><br>Failed to connect to database: ".$dbconnect>error.PHP_EOL;
        exit(0);
    }

    echo "<br><br>Successfully connected to database".PHP_EOL;

    $query = mysqli_query($dbconnect,"INSERT INTO users VALUES ('$username', '$password')");
    echo "<br><br>Account created";
    return true;

    if ($dbconnect->errno !=0){
        echo "<br><br>Failed to execute query: ".PHP_EOL;
        echo __FILE__.':'.__LINE__.":error: ".$dbconnect->error.PHP_EOL;
        exit(0);
    }
}

//Passes API PUSH to DB and waits for response
//function apipass($cases, $deaths){
//    $client = new rabbitMQClient("databaseServer.ini", "databaseServer");
//
//    if (isset($argv[1]))
//    {
//        $msg = $argv[1];
//    }
//    else
//    {
//        $msg = "test message";
//    }
//
//    $request = array();
//    $request['type'] = "apipush";
//    $request['cases'] = $cases;
//    $request['deaths'] = $deaths;
//    $request['message'] = $msg;
//
//    $response = $client->send_request($request);
//    $response = $client->publish($request);
//
//    echo "client received response: ".PHP_EOL;
//    print_r($response);
//    return $response;
//    echo "\n\n";
//
//    echo $argv[0]." END".PHP_EOL;
//}

function apipass ($cases,$deaths)
{
    $dbconnect = new mysqli('52.167.119.56','root','it490Group2!!!','user_credentials');

    if ($dbconnect->errno != 0){
        echo "<br><br>Failed to connect to database: ".$dbconnect>error.PHP_EOL;
        exit(0);
    }

    echo "<br><br>Successfully connected to database".PHP_EOL;

    $query = mysqli_query($dbconnect,"INSERT INTO corona_stats VALUES ('$cases', '$deaths')");
    echo "<br><br>Database updated";
    return true;

    if ($dbconnect->errno !=0){
        echo "<br><br>Failed to execute query: ".PHP_EOL;
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
