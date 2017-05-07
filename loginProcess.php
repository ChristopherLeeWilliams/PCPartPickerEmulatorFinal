<?php 
    session_start(); //start or resume an existing session 
    
    require_once("connection.php");
     
    $username = $_POST['username'];
    $password = sha1($_POST['password']);         
    
    try {
        $sql = "SELECT *  
                FROM AdminUsers
                WHERE username = :username";  //Preventing SQL Injection
                
        $namedParameters = array(); 
        $namedParameters[':username'] = $username;   
         
        $statement = $dbConn->prepare($sql);  
        $statement->execute($namedParameters); 
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        if (empty($record)) { //wrong username
            $_SESSION["errors"] = "Username Not Found";
            $results = ["status_code" => "0"];
            echo json_encode($results); 
            
        } else {
            if ( strcmp($record['password'],$password)==0 ) {
                
                
                $results = ["status_code" => "1",
                            "username" => $record['username'],
                            "userId" => $record['userId'],
                            "sessionId" => session_id()];
                
                
                $_SESSION['userId'] = $results['userId'];
                $_SESSION['username'] = $results['username']; 
                
                echo json_encode($results);
            } else {
                $results = ["status_code" => "0"];
                 echo json_encode($results);
            }
        } 
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>