<?php
    require_once('../connection.php');
    session_start();
    
    $_SESSION['errors'] = null;
    
    // Used to display information on hub page
    if($_GET["remove"] == true) {
        $_SESSION["caseSelected"] = NULL;
    }
    
    if ($_GET["caseId"] != NULL) {
        $_SESSION["caseSelected"]= getCaseData($dbConn,$_GET["caseId"]);
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