<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//Passes LOGIN request to DB and waits for response
function loginpush($username,$password){
    $client = new rabbitMQClient("databaseServer.ini", "databaseServer");

    if (isset($argv[1]))
    {
        $msg = $argv[1];
    }
    else
    {
        $msg = "test message";
    }

    $request = array();
    $request['type'] = "login";
    $request['username'] = $username;
    $request['password'] = $password;
    $request['message'] = $msg;

    $response = $client->send_request($request);
    //$response = $client->publish($request);

    //echo "client received response: ".PHP_EOL;
    //print_r($response);
    return $response;
    echo "\n\n";

    echo $argv[0]." END".PHP_EOL;
}

//Passes REGISTER request to DB and waits for response
function registerpush($username,$password){
    $client = new rabbitMQClient("databaseServer.ini", "databaseServer");

    if (isset($argv[1]))
    {
        $msg = $argv[1];
    }
    else
    {
        $msg = "test message";
    }

    $request = array();
    $request['type'] = "register";
    $request['username'] = $username;
    $request['password'] = $password;
    $request['message'] = $msg;

    $response = $client->send_request($request);
    //$response = $client->publish($request);

    //echo "client received response: ".PHP_EOL;
    //print_r($response);
    return $response;
    echo "\n\n";

    echo $argv[0]." END".PHP_EOL;
}

//Passes API PUSH to DB and waits for response
function apipass($cases, $deaths){
    $client = new rabbitMQClient("databaseServer.ini", "databaseServer");

    if (isset($argv[1]))
    {
        $msg = $argv[1];
    }
    else
    {
        $msg = "test message";
    }

    $request = array();
    $request['type'] = "apipush";
    $request['cases'] = $cases;
    $request['deaths'] = $deaths;
    $request['message'] = $msg;

    $response = $client->send_request($request);
    //$response = $client->publish($request);

    //echo "client received response: ".PHP_EOL;
    //print_r($response);
    return $response;
    echo "\n\n";

    echo $argv[0]." END".PHP_EOL;
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
			return loginpush($request['username'], $request['password']);
		case "register":
            return registerpush($request['username'], $request['password']);
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
