<?php

/* connect to the database */

$conn = new mysqli("localhost","root","","Nurseries");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>




