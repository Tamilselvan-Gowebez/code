<?php
define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', 'root');
define('DB_PASS', '');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$mysqli) {
    error_log($_SERVER['PHP_SELF'] . " Line :" . __LINE__ . " connection Failed :: " . $mysqli->connect_error);
    echo $_SERVER['PHP_SELF'] . " Line :" . __LINE__ . " connection Failed :: " . $mysqli->connect_error;
}
