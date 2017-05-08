<?php
    require_once('../connection.php');
    session_start();
    
    $_SESSION['errors'] = null;
    
    if($_GET["remove"] == true) {
        $_SESSION["cpuSelected"] = NULL;
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    }
    
    if ($_GET["cpuId"] != NULL) {
        $_SESSION["cpuSelected"]= getCPUData($dbConn,$_GET["cpuId"]);
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    } 
    
    header("Location: ../index.php");
    
    function getCPUData($dbConn, $id) {
        $sql = "SELECT CPU.*, Socket.*
                    FROM CPU 
                    LEFT JOIN Socket
                        ON CPU.cpuSocketId=Socket.socketId
                    WHERE CPU.cpuId=$id";
        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        return $row;
    }
?>