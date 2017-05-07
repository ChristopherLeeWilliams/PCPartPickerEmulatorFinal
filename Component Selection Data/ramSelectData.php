<?php
    require_once('../connection.php');
    session_start();
    
    if($_GET["remove"] == true) {
        $_SESSION["ramSelected"] = NULL;
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    }
    
    if ($_GET["ramId"] != NULL) {
        $_SESSION["ramSelected"]= getRAMData($dbConn,$_GET["ramId"]);
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    } 
    //var_dump(getRAMData($dbConn,$_GET["ramId"]));
    header("Location: ../index.php");
    
    function getRAMData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT RAM.ramId, RAM.ramName, RAM.ramPrice, RAM.ramTypeId, RAM.ramSizeGB
                FROM RAM WHERE RAM.ramId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $ram = [];
        $row = $stmt->fetch();
        $ram["ramId"] = $row["ramId"];
        $ram["ramName"] = $row["ramName"];
        $ram["ramPrice"] = $row["ramPrice"];
        $ram["ramTypeId"] = $row["ramTypeId"];
        $ram["ramSizeGB"] = $row["ramSizeGB"];
        
        
        return $ram;
    }
?>