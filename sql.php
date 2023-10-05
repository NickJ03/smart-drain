<?php

/* Author: Nick Jans
Copyright (c) 2023 - Eindhoven University of Technology, The Netherlands
This software is made available under the terms of the GNU General Public License v3.0. */

// variables for the server name, username, user password and the database name.
$server = "localhost";
$user = "Nick_J03";
$pass = "Nick&03J";
$db = "smart_drain";

// make new connection with MySQL database
$conn = new mysqli($server, $user, $pass, $db);

// check if connection was successful
// if unsuccessful, exit the script and display the error code
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful";
}
?>

