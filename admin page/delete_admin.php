<?php
/* Define the parameters for the database connection */
$servername = "localhost";
$username = "root";
$password = "tolossa";
$dbname = "LinkMarket";

/* Establish a new connection to the database */
$conn = new mysqli($servername, $username, $password, $dbname);

/* Verify the connection status */
if ($conn->connect_error) {
    /* Terminate the script and display an error message if the connection fails */
    die("Connection failed: " . $conn->connect_error);
}
?>
