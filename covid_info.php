<!DOCTYPE html>

<html lang="en">

	<head>
		<link rel="stylesheet" href="styles.css">
		<meta charset="utf-8"/>
		<title>Covid Tracker</title>	
	</head>
<body>

<div class="header">
  <img src="virus.jpg" alt="COVID"/>
  <p>Current Information on Covid-19.</p>
</div>

<div class="topnav">
  <a href="#">Home</a>
  <a href="#"></a>
  
  <div class="dropdown">
	<button class="dropbtn">States
		<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
			<select name="state" id="state">
			<option value="noSelection">Select a State</option>
			<option value="newJersey">New Jersey</option>
			<option value="newYork">New York</option>
			<option value="alabama">Alabama</option>
			<option value="alaska">Alaska</option>
			<option value="arizona">Arizona</option>
			<option value="arkansas">Arkansas</option>
			<option value="california">California</option>
			<option value="colorado">Colorado</option>
			<option value="connecticut">Connecticut</option>
			<option value="delaware">Delaware</option>
			<option value="dc">District of Columbia</option>
			<option value="florida">Florida</option>
			<option value="georgia">Georgia</option>
			<option value="hawaii">Hawaii</option>
			<option value="idaho">Idaho</option>
			<option value="illinois">Illinois</option>
			<option value="indiana">Indiana</option>
			<option value="iowa">Iowa</option>
			<option value="kansas">Kansas</option>
			<option value="kentucky">Kentucky</option>
			<option value="louisiana">Louisiana</option>
			<option value="maine">Maine</option>
			<option value="maryland">Maryland</option>
			<option value="massachusetts">Massachusetts</option>
			<option value="michigan">Michigan</option>
			<option value="minnesota">Minnesota</option>
			<option value="mississippi">Mississippi</option>
			<option value="missouri">Missouri</option>
			<option value="montana">Montana</option>
			<option value="nebraska">Nebraska</option>
			<option value="nevada">Nevada</option>
			<option value="newHampshire">New Hampshire</option>
			<option value="newMexico">New Mexico</option>
			<option value="northCarolina">North Carolina</option>
			<option value="northDakota">North Dakota</option>
			<option value="ohio">Ohio</option>
			<option value="oklahoma">Oklahoma</option>
			<option value="oregon">Oregon</option>
			<option value="pennsylvania">Pennsylvania</option>
			<option value="rhodeIsland">Rhode Island</option>
			<option value="southCarolina">South Carolina</option>
			<option value="southDakota">South Dakota</option>
			<option value="tennessee">Tennessee</option>
			<option value="texas">Texas</option>
			<option value="utah">Utah</option>
			<option value="vermont">Vermont</option>
			<option value="virginia">Virginia</option>
			<option value="washington">Washington</option>
			<option value="westVirginia">West Virginia</option>
			<option value="wisconsin">Wisconsin</option>
			<option value="wyoming">Wyoming</option>
		</select>
		</div>
		
		</div>
  
  <a href="index.html" style="float:right">Logout</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
	
		<h2><span id="stateName"></span></h2>
	
		<script>
			var state = document.getElementById("state"),
			stateName = document.getElementById("stateName"), 
			states = 
			{
				noSelection: "U.S.",
				newJersey: "New Jersey",
				newYork: "New York",
				alabama: "Alabama",
				alaska: "Alaska"
			}
			state.onchange = function()
			{
				stateName.innerHTML = states[this.value];
			}
		</script>
		
      <h5><span id="datetime"></span></h5>
	  
		<script>
			var dt = new Date();
			document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
		</script>
	  
	  
      <p>Some text...</p>
      <p>More text...</p>
	  
	  <?php
	  
	  include 'trackerclient.php';
	  
	  switch ($_POST["value"])
    {
      case "noSelection":
      
        $sql = "SELECT `total_cases`, `total_deaths` FROM `corona_stats`";
    
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
              print
              "Total Cases: " . $row["total_cases"]. 
              "  Total Stats: " . $row["total_deaths"]."<br>";
            }
        } 
        else 
        {
          echo "0 results";
        }
        break;
        
      case "2":
      
        print "<h1>Dentist Perry's Procedures and Appointments</h1> <br />";
          
        $docs = "SELECT * FROM patient_procedures WHERE dentist LIKE 'perry'";
        
        $doctor = $conn->query($docs);
        
        if ($doctor->num_rows > 0) 
        {
            while($row = $doctor->fetch_assoc()) 
            {
              print 
              "  Procedure No.: " . $row["id"].  
              "  Dental Procedure: " . $row["dental_procedure"]. 
              "  Date and Time: " . $row["date"]. "  " . $row[time]."<br>";
            }
        } 
        else 
        {
          echo "0 results";
        }
        break;
        
      case "3":
          
        print "<h1>Dentist Puhalka's Procedures and Appointments</h1> <br />";
        
        $docs = "SELECT * FROM patient_procedures WHERE dentist LIKE 'puhalka'";
        
        $doctor = $conn->query($docs);
        
        if ($doctor->num_rows > 0) 
        {
            while($row = $doctor->fetch_assoc()) 
            {
              print 
              "  Procedure No: " . $row["id"].  
              "  Dental Procedure: " . $row["dental_procedure"]. 
              "  Date and Time: " . $row["date"]. "  " . $row[time]."<br>";
            }
        } 
        else 
        {
          echo "0 results";
        }
        break;
        
      case "4":
      
        print "<h1>Dentist Davis' Procedures and Appointments</h1> <br />";
          
        $docs = "SELECT * FROM patient_procedures WHERE dentist LIKE 'davis'";
        
        $doctor = $conn->query($docs);
        
        if ($doctor->num_rows > 0) 
        {
            while($row = $doctor->fetch_assoc()) 
            {
              print 
              "  Procedure No: " . $row["id"].  
              "  Dental Procedure: " . $row["dental_procedure"]. 
              "  Date and Time: " . $row["date"]. "  " . $row[time]."<br>";
            }
        } 
        else 
        {
          echo "0 results";
        }
        break;
        
       case "5":
       
         print "<h1>Dentist Friedman's Procedures and Appointments</h1> <br />";
         
         $docs = "SELECT * FROM patient_procedures WHERE dentist LIKE 'friedman'";
         
         $doctor = $conn->query($docs);
         
         if ($doctor->num_rows > 0)
         {
            while($row = $doctor->fetch_assoc()) 
            {
              print
              "  Procedure No: " . $row["id"].  
              "  Dental Procedure: " . $row["dental_procedure"]. 
              "  Date and Time: " . $row["date"]. "  " . $row[time]."<br>";
            }
        } 
        else 
        {
          echo "0 results";
        }
        break;
    }
    
    $conn->close();
	?>
    </div>

  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>Additional Resources</h2>
    </div>

    <div class="card">
      <h3>CDC</h3>
	  <a href="https://www.cdc.gov/coronavirus/2019-nCoV/index.html"><img src="CDC.jpeg" alt="CDC Logo"/></a>
      <p>For additional resources on symptoms, correct mask usage, staying safe, and the latest vaccine updates, check the CDC's website at the link above.</p>
    </div>

    <div class="card">
      <h3>NIH</h3>
	  <a href="https://www.nih.gov/coronavirus"><img src="nih.png" alt="NIH Logo"/></a>
      <p>The NIH is a great resource on testing, clinical trials, and current treatment guidelines. </p>
    </div>
  </div>
</div>

<div class="footer">
  <h2></h2>
</div>

</body>
</html>