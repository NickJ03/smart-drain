<?php

/* Author: Nick Jans
Copyright (c) 2023 - Eindhoven University of Technology, The Netherlands
This software is made available under the terms of the GNU General Public License v3.0. */

// path to log file
$logs_file_path = __DIR__ . "/logs/log.txt";

// force errors to be displayed in the log
ini_set('display_errors', 0);
error_reporting(E_ALL);

// clear previous log and start new log file
file_put_contents($logs_file_path, "");
$message = "Log created " . date("Y-m-d H:i:s") . "\n" . str_repeat("-", 100) . "\n";
file_put_contents($logs_file_path, $message, FILE_APPEND);

// variables for the server name, username, user password and the database name.
$server = "localhost";
$user = "245";
$pass = "245";
$db = "dumb_drain";

// make new connection with MySQL database
$conn = new mysqli($server, $user, $pass, $db);

// check if connection was successful
// if unsuccessful, exit the script and display the error code
if ($conn->connect_error) {
    $message = date("Y-m-d H:i:s") . " - Connection failed: " . $conn->connect_error . "\n";
    file_put_contents($logs_file_path, $message, FILE_APPEND);

    // open error log window (this uses JavaScript)
?>

<script>
    let logFilePath = "<?php echo $logs_file_path; ?>";
    let popUpName = "Error log";

    window.open(logFilePath, popUpName, "_blank");
</script>

<?php

    // exit script
    die();
} else {
    $message = date("Y-m-d H:i:s") . " - Connection successful\n";
    file_put_contents($logs_file_path, $message, FILE_APPEND);
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
        $message = date("Y-m-d H:i:s") . " - Insertion successful\n";
    } else {
        $message = date("Y-m-d H:i:s") . " - Insertion unsuccessful" . "<br>" . "Error: " . $insert_query . "<br>" . $conn->error . "\n";
    }
    file_put_contents($logs_file_path, $message, FILE_APPEND);
}

// close the database connection
$conn->close();

?>