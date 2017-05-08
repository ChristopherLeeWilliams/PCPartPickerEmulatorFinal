<?php
    require_once('../connection.php');
    session_start();
    
    $_SESSION['errors'] = null;
    
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
        $sql = "SELECT RAM.*, RamType.*
                FROM RAM 
                LEFT JOIN RamType
                    ON RAM.ramTypeId=RamType.ramTypeId
               WHERE RAM.ramId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        return $row;
    }
?>