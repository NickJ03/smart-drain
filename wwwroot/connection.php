<?php

/* Author: Nick Jans
Copyright (c) 2023 - Eindhoven University of Technology, The Netherlands
This software is made available under the terms of the GNU General Public License v3.0. */

// variables for the server name, username, user password and the database name.
$server = "localhost";
$user = "245";
$pass = "245";
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

// the data from the microcontroller should be sent via POST request (controller side)
// the data needs to be placed in variable with $name = $_POST['name_on_controller']
// the data needs to be inserted into the database. before doing this, the database tables must be created
// the query execution must be checked
// the connection must be closed at the end




