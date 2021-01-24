<?php


$server   = "localhost";
$username = "pc";
$password = "pc";
$database = "pagina_simple";


$dbconn = new mysqli($server, $username, $password, $database);


if ($dbconn->connect_error) {
    die('error'.$dbconn->connect_error);
}

?>