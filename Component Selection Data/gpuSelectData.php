<?php
    require_once('../connection.php');
    session_start();
    
    // Used to display information on hub page
    if($_GET["remove"] == true) {
        $_SESSION["gpuSelected"] = NULL;
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    }
    
    if ($_GET["gpuId"] != NULL) {
        $_SESSION["gpuSelected"]= getGPUData($dbConn,$_GET["gpuId"]);
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    } 
    header("Location: ../index.php");
    
    function getGPUData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT gpuId, gpuName, gpuManufacturer, gpuLengthInches, gpuPrice, gpuTDP
                FROM GPU WHERE gpuId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $gpu = [];
        $row = $stmt->fetch();
        $gpu["gpuId"] = $row["gpuId"];
        $gpu["gpuName"] = $row["gpuName"];
        $gpu["gpuPrice"] = $row["gpuPrice"];
        $gpu["gpuLengthInches"] = $row["gpuLengthInches"];
        $cpu["gpuTDP"] = $row["gpuTDP"];
        
        return $gpu;
    }
?>