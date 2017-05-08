<?php
    require_once('../connection.php');
    session_start();
    
    $_SESSION['errors'] = null;
    
    if($_GET["remove"] == true) {
        $_SESSION["mbSelected"] = NULL;
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    }
    
    if ($_GET["mbId"] != NULL) {
        $_SESSION["mbSelected"]= getMbData($dbConn,$_GET["mbId"]);
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    } 
    
    header("Location: ../index.php");
    
    function getMbData($dbConn, $id) {
        $sql = "SELECT Motherboard.*, Socket.*, MBFormFactors.*, RamType.* 
                FROM Motherboard
                LEFT JOIN Socket
                    ON Motherboard.mbSocketId=Socket.socketId
                LEFT JOIN MBFormFactors
                    ON Motherboard.mbFFId=MBFormFactors.mbFFId
                LEFT JOIN RamType
                    ON Motherboard.mbRamTypeId=RamType.ramTypeId
                WHERE Motherboard.mbId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();

        $row = $stmt->fetch();
        
        return $row;
    }
?>