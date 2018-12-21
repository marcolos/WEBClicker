<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 2018-12-15
 * Time: 18:57
 */

$servername = "localhost";
$username = "webclicker";
$password = "";
$dbname = "my_webclicker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>