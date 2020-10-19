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
     <img src="covid.jpg" alt="COVID-19"/>
	  </div>
 
    <div id="top">
    <p></p>
    COVID-19 Tracking System
    <p></p>
    </div>
    
    	<div>
		
		<form action="register.php" method="post">
		
		<b>Register</b>
		
		<table>
    
      <tr>
        <td align = "right">First Name</td>
        <td><input type="text" id="first_name" name ="first_name" size="50" 
        required value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></td>
        <span id="first_name"></span>
        <td style="color:red">REQUIRED</td>
      </tr>
			
			<tr>
        <td align = "right">Last Name</td>
        <td><input type="text" id="last_name" name ="last_name" size="50" 
        required value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></td>
        <span id="last_name"></span>
        <td style="color:red">REQUIRED</td>
     </tr>
     
     <tr>
       <td align = "right">Password</td>
       <td><input type = "password" id="pass1" name ="pass1" size="50" 
       onblur="isTheFieldEmpty(this, document.getElementById("Password"))" 
       required value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" /></td>
       <span id="pass1"></span>
       <td style="color:red">REQUIRED</td>
     </tr>
     
     <tr>
       <td align = "right">Re-Enter Password</td>
       <td><input type = "password" id="pass2" name ="pass2" size="50" 
       onblur="isTheFieldEmpty(this, document.getElementById("Password"))" 
       required value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" /></td>
       <span id="pass2"></span>
       <td style="color:red">REQUIRED</td>
     </tr>
  
     <tr>
       <td align = "right">Patient E-Mail</td>
       <td><input type="text" id="email" name ="email" size="50" 
        required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></td>
        <span id="email"></span>
        <td style="color:red">REQUIRED</td>
     </tr>
     
     <tr>
       <td align = "center"><input type = "submit" value = "Register" /></td>	
     </tr>
   
   </table>
		 
	</form>

	</div>
  
	<?php
  
    require_once("connection.php");
    
    if ($_SERVER['REQUEST_METHOD']=='POST')
    {
    
      $errors = array();
      
      if (empty($_POST['first_name']))
      {
        $errors[] = 'You forgot to enter your first name.';
      }
      else
      {
        $fn = trim($_POST['first_name']);
		  }
		
		  if (empty($_POST['last_name'])) 
      {
			  $errors[] = 'You forgot to enter your last name.';
		  }   
      else 
      {
			  $ln = trim($_POST['last_name']);
		  }
	
			if (empty($_POST['email'])) 
      {
			  $errors[] = 'You forgot to enter your email address.';
		  } 
      else 
      {
			$e = trim($_POST['email']);
		  }
		
		  if (!empty($_POST['pass1'])) 
      {
			  if ($_POST['pass1'] != $_POST['pass2']) 
        {
				  $errors[] = 'Your password did not match the confirmed password.';
			  } 
        else 
        {
				$p = trim($_POST['pass1']);
			  }
		  } 
      else 
      {
			$errors[] = 'You forgot to enter your password.';
		  }
		
		  if (empty($errors)) 
      { 
			  $q = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$fn', '$ln', '$e', '$p')";		
			  $r = @mysqli_query ($dbc, $q); 
		  	if ($r) 
        { 
				  echo '<h1>Registration Complete!</h1>
			    <p>Thank you!</p><p><br /></p>';	
				} 
        else 
        {
				  echo '<h1>System Error</h1>
				  <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
				
				  echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
							
			  }
      } 			
			exit();
			
		} 
    else 
    {
			echo '<h1>Error!</h1>
			<p class="error">The following error(s) occurred:<br />';
			
      foreach ($errors as $msg) 
      {
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p><p><br /></p>';
			
		}

	?>
    
    $dbc->close();
	</body>
</html>