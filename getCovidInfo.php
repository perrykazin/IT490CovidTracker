<?php
$con=mysqli_connect("10.1.0.5","root","it490Group2!!!","user_credentials");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM corona_stats");

echo "<table border='1'>
<tr>
<th>my_timestamp</th>
<th>totals_cases</th>
<th>total_deaths</th>
<th>nj_cases</th>
<th>nj_deaths</th>
<th>ny_cases</th>
<th>ny_deaths</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['my_timestamp'] . "</td>";
echo "<td>" . $row['totals_cases'] . "</td>";
echo "<td>" . $row['total_deaths'] . "</td>";
echo "<td>" . $row['nj_cases'] . "</td>";
echo "<td>" . $row['nj_deaths'] . "</td>";
echo "<td>" . $row['ny_cases'] . "</td>";
echo "<td>" . $row['ny_deaths'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
