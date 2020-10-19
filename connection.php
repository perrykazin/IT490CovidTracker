<?php
  DEFINE ('SERVERNAME', 'sql1.njit.edu');
  DEFINE ('USERNAME', 'jp653');
  DEFINE ('PASSWORD', '3IHUwm4l');
  DEFINE ('DBNAME', 'jp653');
  
  $dbc = @mysqli_connect (SERVERNAME, USERNAME, PASSWORD, DBNAME)
  OR die('Could not connect to MySQL ' . mysqli_connect_error());
?>