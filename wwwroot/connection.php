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

// check request type POST and connect variables from microcontroller
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $volume = $_POST["//"];

    // insert data into connected MySQL database
    // generate SQL query
    $insert_query = "INSERT INTO water_usage (volume) VALUES ($volume)";

    // perform and check query
    // note: if no error occurs, $conn->query($insert_query) returns TRUE. the condition == TRUE is implicit here
    // if unsuccessful, display the error code and the generated query
    if ($conn->query($insert_query)) {
        echo "Insertion successful";
    } else {
        echo "Insertion unsuccessful" . "<br>" . "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

// close the database connection
$conn->close();

// the data from the microcontroller should be sent via POST request (controller side)
// the data needs to be placed in variable with $name = $_POST['name_on_controller']
// the data needs to be inserted into the database. before doing this, the database tables must be created
// the query execution must be checked
// the connection must be closed at the end

?>