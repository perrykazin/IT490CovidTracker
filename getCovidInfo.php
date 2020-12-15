<?php

	include 'trackerclient.php';
	
	$sql = "SELECT customerid, companyname, contactname, address, city, postalcode, country FROM customers WHERE customerid = ?";

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $_GET['q']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($covidcase, $coviddeath);
	$stmt->fetch();
	$stmt->close();

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