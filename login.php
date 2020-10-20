<!DOCTYPE html>

<html lang="en">

	<head>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<meta charset="utf-8"/>
		<title>Covid Tracker</title>	
	</head>
	
<body>

	<div id="logo">
   <p></p>
   <img src="covid.jpg" alt="COVID"/> 
	</div>
 
  <div id="top">
    <p></p>
    COVID-19 Tracking System
    <p></p>
  </div>


  <div>
    <form name="form" action="" method="post">
		
		<table>
      
			<tr>
				<td align = "right">User Name</td>
				<td><input type = "text" id="email" name = "email" size="50" /></td>
				<span id=”email”></span>
				<td style="color:red">REQUIRED</td>
			</tr>
      
			<tr>
				<td align = "right">Password</td>
				<td><input type = "password" id="password" name ="password" size="50"/></td>
				<span id=”password”></span>
				<td style="color:red">REQUIRED</td>
			</tr>
		  
			<tr>
				<td align = "right"><input type = "reset" value = "Reset" /></td>
				<td align = "center"><input type = "submit" value = "Submit" /></td>	
			</tr>
		</table>

	</form>
  
  </div>
  
  <div>
    <p>If you do not have an account, click the register button below.</p>
    <form name="form" action="register.php" method="post">
      
      <input type = "submit" value = "Register" />
    </form>
  
  </div>
/* <?php
 
   require_once("connection.php");
   
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
     $email = mysqli_real_escape_string($dbc, $_POST['email']);
     $password = mysqli_real_escape_string($dbc, $_POST['password']);
     
     $select = "SELECT id FROM users WHERE email ='$email' and password=SHA1'$password'";
     
     $query = mysqli_query($dbc, $select);
     $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
     $activerow = $row['active'];
     
     $count=mysqli_num_rows($query);
     
     if($count == 1)
     {
       session_register("email");
       $_SESSION['login_user'] = $email;
       
       header("Location: https://web.njit.edu/~jp653/it490/loggedin.php");
     }
     else
     {
       $error = "Sorry, that e-mail/password combination is invalid.  Please try again.";
     }
      
   }
 
   $conn->close();
 ?> */
 
  <?php
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');

    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "test message";
    }

    $request = array();
    $request['type'] = "Login";
    $request['username'] = "steve";
    $request['password'] = "password";
    $request['message'] = $msg;
    $response = $client->send_request($request);
    //$response = $client->publish($request);

    echo "client received response: ".PHP_EOL;
    print_r($response);
    echo "\n\n";

    echo $argv[0]." END".PHP_EOL;
  ?>


</body>

</html>
