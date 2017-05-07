<?php
$dbHost = getenv("IP");
$dbPort = 3306;
$dbName = "FinalProject";
$dbUsername = getenv("C9_USER");
$dbPassword = "";

// Connect to database
$dbConn = new PDO("mysql:host=$dbHost;dbname=$dbName; port=$dbPort", $dbUsername, $dbPassword);

/*
    $sql = "SELECT";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
*/
?>