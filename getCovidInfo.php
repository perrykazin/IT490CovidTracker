<?php

	$servername = "10.1.0.5";
	$username = "root";
	$password = "it490Group2!!!";
	$dbname = "user_credentials";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$sql = "SELECT * FROM corona_stats";

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $_GET['q']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($covidcase, $coviddeath);
	$stmt->fetch();
	$stmt->close();
	
	print "AJAX works";

	echo "<table>";
	echo "<tr>";
	echo "<th>Total Cases</th>";
	echo "<td>" . $covidcase . "</td>";
	echo "<th>Total Deaths</th>";
	echo "<td>" . $coviddeath . "</td>";
	echo "</tr>";
	echo "</table>";
	
	  switch ($_POST["value"])
	  {
		case "noSelection":
			$sql = mysqli_fetch_array(rabbitPopulate());
		  
			print "Total Cases: " . $sql["total_cases"]. 
              "  Total Stats: " . $sql["total_deaths"]."<br>";
        

			break;
			
		case "newJersey":
			$sql = mysqli_fetch_array(rabbitPopulate());
		  
			print "Total Cases: " . $sql["nj_cases"]. 
              "  Total Stats: " . $sql["nj_deaths"]."<br>";
			  break;
		}
	  }
?>