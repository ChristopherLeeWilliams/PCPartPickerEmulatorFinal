<?php
    require_once('../connection.php');
    session_start();
    
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
        // Create sql statement
        $sql = "SELECT Motherboard.mbId, Motherboard.mbName, Motherboard.mbPrice,
                Motherboard.mbSocketId, Motherboard.mbFFId, Motherboard.mbRamTypeId, Motherboard.maxRamGB
                FROM Motherboard WHERE Motherboard.mbId=$id";

        
        // prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $mb = [];
        $row = $stmt->fetch();
        $mb["mbId"] = $row["mbId"];
        $mb["mbName"] = $row["mbName"];
        $mb["mbPrice"] = $row["mbPrice"];
        $mb["mbSocketId"] = $row["mbSocketId"];
        $mb["mbFFId"] = $row["mbFFId"];
        $mb["mbRamTypeId"] = $row["mbRamTypeId"];
        $mb["maxRamGB"] = $row["maxRamGB"];
        
        return $mb;
    }
?>