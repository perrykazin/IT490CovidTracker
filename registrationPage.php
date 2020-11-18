<!DOCTYPE html>
<html lang="en">

	<head>
		<link re="stylesheet" type="text/css" href="style.css" />
		<meta charset="utf-8" />
		<title>Covid Tracker</title>
	</head>
	
	<body>
		<div id="logo">
		<p></p>
		<img src="covid.jpg" alt="COVID" />
		</div>
		
		<div id="top">
		<p></p>
		</div>
		
		<div>
			<form name="form" action="register.php" method="post">
				<table>
					<tr>
						<td align="right">Enter a User Name</td>
						<td><input type="text" id="username" name="username" size="50"></td>
						<span id="username"></span>
						<td style="color:red">REQUIRED</td>
					</tr>
					
					<tr>
						<td align="right">Enter a Password</td>
						<td><input type="password" id="password" name="password" size="50"></td>
						<span id="password"></span>
						<td style="color:red">REQUIRED</td>
					</tr>
					
					<tr>
						<td align="right"><input type="reset" value="Reset" /></td>
						<td align="center"><input type="submit" value="Submit" /></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>