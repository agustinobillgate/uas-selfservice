<?php
$DBHOST = "localhost";
$DBUSER = "root";
$DBPASS = "";
$DBNAME = "db_selfService";
$conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}
?>