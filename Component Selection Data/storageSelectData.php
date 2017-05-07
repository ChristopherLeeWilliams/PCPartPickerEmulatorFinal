<?php
    require_once('../connection.php');
    session_start();
    
    // Used to display information on hub page
    if($_GET["remove"] == true) {
        $_SESSION["storageSelected"] = NULL;
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    }
    
    if ($_GET["storageId"] != NULL) {
        $_SESSION["storageSelected"]= getStorageData($dbConn,$_GET["storageId"]);
        $_SESSION["checkoutRun"] = false;
        $_SESSION["compatibilityChecked"] = false;
    } 
    header("Location: ../index.php");
    
    function getStorageData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT Storage.* FROM Storage WHERE Storage.storageId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $storage = [];
        $row = $stmt->fetch();
        $storage["storageId"] = $row["storageId"];
        $storage["storageName"] = $row["storageName"];
        $storage["storagePrice"] = $row["storagePrice"];
        
        return $storage;
    }
?>