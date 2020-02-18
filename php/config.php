<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'sql158.main-hosting.eu');
define('DB_USERNAME', 'u240881153_user');
define('DB_PASSWORD', 'Ambiora@123');
define('DB_NAME', 'u240881153_amb');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
