<?php
    session_start();
    require_once("../connection.php");
    
    $componentType = $_POST['componentType'];
    $action = $_POST['action'];
    $component = $_POST['component'];
    ////echo 'Reached function page with values: '.$action.' '.$componentType;
    try {
        if (strcmp($_POST['action'], "add") == 0) {
            if (strcmp($componentType, "case") == 0) {
                addCase($component,$dbConn);
            } else if (strcmp($componentType, "cpu") == 0) {
                addCPU($component,$dbConn);
            } else if (strcmp($componentType, "gpu") == 0) {
                addGPU($component,$dbConn);
            } else if (strcmp($componentType, "motherboard") == 0) {
                addMotherboard($component,$dbConn);
            } else if (strcmp($componentType, "psu") == 0) {
                addPSU($component,$dbConn);
            } else if (strcmp($componentType, "ram") == 0) {
                addRAM($component,$dbConn);
            } else if (strcmp($componentType, "storage") == 0) {
                addStorage($component,$dbConn);
            } else {
                
            }
        } else if (strcmp($_POST['action'], "update") == 0) {
            if (strcmp($componentType, "case") == 0) {
                updateCase($component,$dbConn);
            } else if (strcmp($componentType, "cpu") == 0) {
                updateCPU($component,$dbConn);
            } else if (strcmp($componentType, "gpu") == 0) {
                updateGPU($component,$dbConn);
            } else if (strcmp($componentType, "motherboard") == 0) {
                updateMotherboard($component,$dbConn);
            } else if (strcmp($componentType, "psu") == 0) {
                updatePSU($component,$dbConn);
            } else if (strcmp($componentType, "ram") == 0) {
                updateRAM($component,$dbConn);
            } else if (strcmp($componentType, "storage") == 0) {
                updateStorage($component,$dbConn);
            } else {
                
            }
        } else if (strcmp($_POST['action'], "delete") == 0) {
            if (strcmp($componentType, "case") == 0) {
                deleteCase($component,$dbConn);
            } else if (strcmp($componentType, "cpu") == 0) {
                deleteCPU($component,$dbConn);
            } else if (strcmp($componentType, "gpu") == 0) {
                deleteGPU($component,$dbConn);
            } else if (strcmp($componentType, "motherboard") == 0) {
                deleteMotherboard($component,$dbConn);
            } else if (strcmp($componentType, "psu") == 0) {
                deletePSU($component,$dbConn);
            } else if (strcmp($componentType, "ram") == 0) {
                deleteRAM($component,$dbConn);
            } else if (strcmp($componentType, "storage") == 0) {
                deleteStorage($component,$dbConn);
            } else {
                
            }
        } else {
            
        }
    } catch(PDOException $e) {
        //echo 'There was an error: '. $e->getMessage();
    }
    
    
    function addCase($component,$dbConn) {
        //echo 'Inside add case';
        
        $sql = "INSERT INTO `Case` (caseName,caseFFId,maxGPULengthInches, caseNum25Bays,caseNum35Bays,casePrice)
                VALUES (:caseName, :caseFFId, :maxGPULengthInches, :caseNum25Bays, :caseNum35Bays, :casePrice)";
                        
        // $sql = "INSERT INTO Case (caseName,caseFFId,maxGPULengthInches, caseNum25Bays,caseNum35Bays,casePrice)
        //         VALUES ('Test Case', '1', '12', '3', '3', '80.00')";
                
        //echo 'Finished the query';
        
        $namedParameters = array(); 
        $namedParameters[':caseName'] = $component['caseName'];  
        $namedParameters[':caseFFId'] = $component['caseFFId']; 
        $namedParameters[':maxGPULengthInches'] = $component['maxGPULengthInches']; 
        $namedParameters[':caseNum25Bays'] = $component['caseNum25Bays'];  
        $namedParameters[':caseNum35Bays'] = $component['caseNum35Bays'];   
        $namedParameters[':casePrice'] = $component['casePrice'];  
        
        //echo 'Assigneed all the values';
        //echo var_dump($namedParameters);
        //echo var_dump($component); 
        
        $statement = $dbConn->prepare($sql);  
        $statement->execute($namedParameters); 
        //echo 'Successful?';
    }
    
    function updateCase($component,$dbConn) {
        $id = $component['caseId'];
        //echo 'Inside update case';
        $sql = "UPDATE `Case` SET caseName=:caseName, 
                                caseFFId=:caseFFId,
                                maxGPULengthInches=:maxGPULengthInches,
                                caseNum25Bays=:caseNum25Bays,
                                caseNum35Bays=:caseNum35Bays,
                                casePrice=:casePrice
                                WHERE caseId=$id";
                                
        $namedParameters = array(); 
        $namedParameters[':caseName'] = $component['caseName'];  
        $namedParameters[':caseFFId'] = $component['caseFFId']; 
        $namedParameters[':maxGPULengthInches'] = $component['maxGPULengthInches']; 
        $namedParameters[':caseNum25Bays'] = $component['caseNum25Bays'];  
        $namedParameters[':caseNum35Bays'] = $component['caseNum35Bays'];   
        $namedParameters[':casePrice'] = $component['casePrice'];  
        
        //echo 'Assigneed all the values';
        //echo var_dump($namedParameters);
        //echo var_dump($component); 
        
        $statement = $dbConn->prepare($sql);  
        $statement->execute($namedParameters); 
        //echo 'Successful?';
    }
    
    function deleteCase($component,$dbConn) {
        $id = $component['caseId'];
        // echo 'Called to delete '.$id.' in ajax';
        // echo 'Inside update case';
        $sql = "DELETE FROM `Case` WHERE caseId=$id";
        // echo 'Delete Query selected';
        $statement = $dbConn->prepare($sql);  
        $statement->execute(); 
        // echo 'Successful?';
    }
    
    
    
    
    function addCPU($component,$dbConn) {
        
    }
    
    function updateCPU($component,$dbConn) {
        
    }
    
    function deleteCPU($component,$dbConn) {
        
    }
    
    
    
    function addGPU($component,$dbConn) {
        
    }
    
    function updateGPU($component,$dbConn) {
        
    }
    
    function deleteGPU($component,$dbConn) {
        
    }
    
    
    
    
    function addMotherboard($component,$dbConn) {
        
    }
    
    function updateMotherboard($component,$dbConn) {
        
    }
    
    function deleteMotherboard($component,$dbConn) {
        
    }
    
    
    
    
    function addPSU($component,$dbConn) {
        
    }
    
    function updatePSU($component,$dbConn) {
        
    }
    
    function deletePSU($component,$dbConn) {
        
    }
    
    
    
    
    function addRAM($component,$dbConn) {
        
    }
    
    function updateRAM($component,$dbConn) {
        
    }
    
    function deleteRAM($component,$dbConn) {
        
    }
    
    
    
    
    function addStorage($component,$dbConn) {
        
    }
    
    function updateStorage($component,$dbConn) {
        
    }
    
    function deleteStorage($component,$dbConn) {
        
    }


?>