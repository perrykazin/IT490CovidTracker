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
			<form action="" method="post">
				<select name="state" id="state" onchange="javascript:this.form.submit()">
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
			</form>
			
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
				alaska: "Alaska",
				arizona: "Arizona",
				arkansas: "Arkansas",
				california: "California",
				colorado: "Colorado",
				connecticut: "Connecticut",
				delaware: "Delaware",
				dc: "District of Columbia",
				florida: "Florida",
				georgia: "Georgia",
				hawaii: "Hawaii",
				idaho: "Idaho",
				illinois: "Illinois",
				indiana: "Indiana",
				iowa: "Iowa",
				kansas: "Kansas",
				kentucky: "Kentucky",
				louisiana: "Louisiana",
				maine: "Maine",
				maryland: "Maryland",
				massachusetts: "Massachusetts",
				michigan: "Michigan",
				minnesota: "Minnesota",
				mississippi: "Mississippi",
				missouri: "Missouri",
				montana: "Montana",
				nebraska: "Nebraska",
				nevada: "Nevada",
				newHampshire: "New Hampshire",
				newMexico: "New Mexico",
				northCarolina:"North Carolina",
				northDakota: "North Dakota",
				ohio: "Ohio",
				oklahoma: "Oklahoma",
				oregon: "Oregon",
				pennsylvania: "Pennsylvania",
				rhodeIsland: "Rhode Island",
				southCarolina: "South Carolina",
				southDakota: "South Dakota",
				tennessee: "Tennessee",
				texas: "Texas",
				utah: "Utah",
				vermont: "Vermont",
				virginia: "Virginia",
				washington: "Washington",
				westVirginia: "West Virginia",
				wisconsin: "Wisconsin",
				wyoming: "Wyoming"
				
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

	  <?php
	  
	  include 'trackerclient.php';
	  
	  switch ($_POST['state'])
	  {
        case "noSelection":
            $sql = rabbitPopulate();

			$sqlarray = mysqli_fetch_array($sql);
		  
			print "Total Cases: " . $sqlarray["totals_cases"]. 
              "  Total Stats: " . $sqlarray["total_deaths"]."<br>";
        
			print "No Selection";
			break;
			
			$sql = rabbitPopulate();

            $sqlarray = mysqli_fetch_array($sql);
            
			print "Total Cases: " . $sqlarray["nj_cases"]. 
              "  Total Stats: " . $sqlarray["nj_deaths"]."<br>";
			  break;
			  print "New Jersey";
        
        case "newYork":
            $sql = rabbitPopulate();

            $sqlarray = mysqli_fetch_array($sql);
            
            print "Total Cases: " . $sqlarray["ny_cases"]. 
              "  Total Stats: " . $sqlarray["ny_deaths"]."<br>";
			  break;
			  print "New York";

        default:

            $dbconnect = new mysqli('10.1.0.5','root','it490Group2!!!','user_credentials');

            $query = mysqli_query($dbconnect,"SELECT * FROM corona_stats ORDER BY my_timestamp DESC LIMIT 1");

            $sqlarray = mysqli_fetch_array($query);
		  
            print "Total Cases: " . $sqlarray["totals_cases"]."<br>"; 
            
            print "Total Stats: " . $sqlarray["total_deaths"]."<br>";

            print "New Jersey Cases: " . $sqlarray["nj_cases"]."<br>";

            print "New Jersey Deaths: " . $sqlarray["nj_deaths"]."<br>";

            print "New York Cases: " . $sqlarray["ny_cases"]."<br>";
            
            print "New York Cases: " . $sqlarray["ny_deaths"]."<br>";

			break;
	    }
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