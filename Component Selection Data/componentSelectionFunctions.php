
<?php
    // Retrieves hardware information from PCParts DB
    function getCases($dbConn) {
        // Create sql statement
        $sql = "SELECT `Case`.*, MBFormFactors.*
                FROM `Case`
                LEFT JOIN MBFormFactors
                    ON `Case`.caseFFId=MBFormFactors.mbFFId
                ORDER BY `Case`.caseName";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) {
            $component["caseId"] = $row["caseId"];
            $component["caseName"] = $row["caseName"];
            $component["caseFFType"] = $row["mbFFType"];
            $component["maxGPULengthInches"] = $row["maxGPULengthInches"];
            $component["caseNum25Bays"] = $row["caseNum25Bays"];
            $component["caseNum35Bays"] = $row["caseNum35Bays"];
            $component["casePrice"] = $row["casePrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getCPUs($dbConn) {
             // Create sql statement
            $sql = "SELECT CPU.*, Socket.*
                    FROM CPU 
                    LEFT JOIN Socket
                        ON CPU.cpuSocketId=Socket.socketId
                    ORDER BY CPU.cpuName";
            
            // Prepare SQL
            $stmt = $dbConn->prepare($sql);
            
            // Execute SQL
            $stmt->execute();
            
            $componentArr = [];
            $component = [];
            $i = 0;
            
            while($row = $stmt->fetch()) { 
                $component["cpuId"] = $row["cpuId"];
                $component["cpuName"] = $row["cpuName"];
                $component["cpuBaseClock"] = $row["cpuBaseClock"];
                $component["socketType"] = $row["socketType"];
                $component["cpuNumCores"] = $row["cpuNumCores"];
                $component["cpuTDP"] = $row["cpuTDP"];
                $component["cpuPrice"] = $row["cpuPrice"];
                $componentArr[$i] = $component;
                $i++;
            }
            
            return $componentArr;
        }
        
        function getGPUs($dbConn) {
        // Create sql statement
        $sql = "SELECT GPU.*
                FROM GPU ORDER BY gpuName";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["gpuId"] = $row["gpuId"];
            $component["gpuName"] = $row["gpuName"];
            $component["gpuManufacturer"] = $row["gpuManufacturer"];
            $component["gpuBaseClock"] = $row["gpuBaseClock"];
            $component["gpuMemSize"] = $row["gpuMemSize"];
            $component["gpuLengthInches"] = $row["gpuLengthInches"];
            $component["gpuTDP"] = $row["gpuTDP"];
            $component["gpuPrice"] = $row["gpuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getMotherboards($dbConn) {
         // Create sql statement
        $sql = "SELECT Motherboard.*, Socket.*, MBFormFactors.*, RamType.* 
                FROM Motherboard
                LEFT JOIN Socket
                    ON Motherboard.mbSocketId=Socket.socketId
                LEFT JOIN MBFormFactors
                    ON Motherboard.mbFFId=MBFormFactors.mbFFId
                LEFT JOIN RamType
                    ON Motherboard.mbRamTypeId=RamType.ramTypeId";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;

        while($row = $stmt->fetch()) { 
            $component["mbId"] = $row["mbId"];
            $component["mbName"] = $row["mbName"];
            $component["socketType"] = $row["socketType"];
            $component["mbFFType"] = $row["mbFFType"];
            $component["mbNumRamSlots"] = $row["mbNumRamSlots"];
            $component["ramType"] = $row["ramType"];
            $component["mbPrice"] = $row["mbPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        return $componentArr;
    }
    
    function getPSUs($dbConn) {
        // Create sql statement
        $sql = "SELECT psuId, psuName, psuWatts, psuModularity, psuPrice, psuEfficiency
                FROM PSU ORDER BY psuName";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["psuId"] = $row["psuId"];
            $component["psuName"] = $row["psuName"];
            $component["psuWatts"] = $row["psuWatts"];
            $component["psuEfficiency"] = $row["psuEfficiency"];
            $component["psuModularity"] = $row["psuModularity"];
            $component["psuPrice"] = $row["psuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getRam($dbConn) {
         // Create sql statement
        $sql = "SELECT RAM.*, RamType.*
                FROM RAM 
                LEFT JOIN RamType
                    ON RAM.ramTypeId=RamType.ramTypeId
                ORDER BY RAM.ramName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["ramId"] = $row["ramId"];
            $component["ramName"] = $row["ramName"];
            $component["ramType"] = $row["ramType"];
            $component["ramSizeGB"] = $row["ramSizeGB"];
            $component["ramSpeed"] = $row["ramSpeed"];
            $component["ramCas"] = $row["ramCas"];
            $component["ramPrice"] = $row["ramPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getStorages($dbConn) {
        // Create sql statement
        $sql = "SELECT Storage.*, StorageFormFactors.*
                FROM Storage 
                LEFT JOIN StorageFormFactors
                    ON Storage.storageFFId=StorageFormFactors.storageFFId
                ORDER BY Storage.storageName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["storageId"] = $row["storageId"];
            $component["storageName"] = $row["storageName"];
            $component["storageSize"] = $row["storageSize"];
            $component["storageType"] = $row["storageType"];
            $component["storageRPM"] = $row["storageRPM"];
            $component["storageFFType"] = $row["storageFFType"];
            $component["storagePrice"] = $row["storagePrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }


?>