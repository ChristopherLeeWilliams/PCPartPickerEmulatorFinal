<?php
    require_once('../connection.php');
    session_start();
    
    // Used to display information on hub page
    if($_GET["remove"] == true) {
        $_SESSION["caseSelected"] = NULL;
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    }
    
    if ($_GET["caseId"] != NULL) {
        $_SESSION["caseSelected"]= getCaseData($dbConn,$_GET["caseId"]);
        $_SESSION["compatibilityChecked"] = false;
        $_SESSION["checkoutRun"] = false;
    } 
    header("Location: ../index.php");
    
    function getCaseData($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT `Case`.* FROM `Case` WHERE `Case`.caseId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        $case = [];
        $row = $stmt->fetch();
        $case["caseId"] = $row["caseId"];
        $case["caseName"] = $row["caseName"];
        $case["casePrice"] = $row["casePrice"];
        $case["caseFFId"] = $row["caseFFId"];
        $case["maxGPULengthInches"] = $row["maxGPULengthInches"];
        return $case;
    }
?>