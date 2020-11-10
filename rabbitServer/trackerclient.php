<?php
//session_start();
//ini_set("display_errors", 0);
//ini_set("log_errors",1);
//ini_set("error_log", "/tmp/error.log");

//error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

//if (!isset($_SESSION["user"])){
//    header( "Refresh:1; url=login.html", true, 303);
//}

require_once('path.inc');
require_once('rabbitMQLib.inc');
require_once('get_host_info.inc');

//Sends LOGIN from Front End and waits for response
function rabbitLogin($username,$password){
    $client = new rabbitMQClient("messageServer.ini","messageServer");

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

//Sends REGISTER from Front End and waits for response
function rabbitRegister($username,$password){
    $client = new rabbitMQClient("messageServer.ini","messageServer");

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

//Sends API PUSH from Back End
function rabbitAPIpush($cases, $deaths){
    $client = new rabbitMQClient("messageServer.ini","messageServer");

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
    //return $response;
    echo "\n\n";

    echo $argv[0]." END".PHP_EOL;
}

?>
