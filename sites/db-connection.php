<?php

// db_connection.php

// Povezivanje sa bazom podataka
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital-estate";

// Stvaranje konekcije
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Provjera konekcije
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Podešavanje UTF-8 kodiranja za hr znakove u bazi
mysqli_query($conn, "SET NAMES utf8");
?>