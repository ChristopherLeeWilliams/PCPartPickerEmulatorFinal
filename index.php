<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start(); 
            require_once("connection.php");
            require_once("Component Selection Data/componentSelectionFunctions.php");
        ?>
        <title></title>
    </head>
    
    <!--Imports-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    
    <!--My Stuff-->
    <link rel="stylesheet" href="/Final Project/CSS/finalProject.css">
    <script src="/Final Project/Scripts/loginProcess.js"></script> <!--Handles Ajax for login/logout-->
    <link rel="icon" href="/Final Project/Images/favicon.jpg">
    
    <!--Administrator Login-->
    <div class="admin-login">
        <form class="form-inline" id="login-form">
            <h6 id="adminUsername">Administrator:</h6>
            
            <label class="sr-only" for="inlineFormInputGroup"></label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0 login-input">
                <!--id for inputs? = inlineFormInputGroup-->
                <input type="text" class="form-control" id="username" placeholder="Username" name="username">
            </div>
            
            <div class="input-group mb-2 mr-sm-2 mb-sm-0 login-input">
                <label class="sr-only" for="inlineFormInput"></label>
                <input type="password" class="form-control mb-2 mr-sm-2 mb-sm-0" id="password" placeholder="Password" name="password">
            </div>
            
            <button type="button" class="btn btn-primary active" name="btn-login" id="btn-login">Login</button>
            <button type="button" class="btn btn-primary" style="display:none" id="btn-logout" href="logout.php">Logout</button>
            
            <div id="error"> <!-- error will be shown here ! --> </div>
        </form>
    </div>
    
    <!--Administrator Tools-->
    <div class="admin-tools-menu" id="admin-tools-menu">
        <form class="form-inline" id="admin-tools">
            <button type="button" class="btn btn-primary btn-sm" id="adminTool1">Main Screen</button>
            <button type="button" class="btn btn-primary btn-sm" >Update Database Entry</button>
            <button type="button" class="btn btn-primary btn-sm" >Add Database Entry</button>
            <button type="button" class="btn btn-primary btn-sm" >Delete Database Entry</button>
            <button type="button" class="btn btn-primary btn-sm" >Generate Report</button>
        </form>
    </div>
    
    
    <!-----------------------------------------CASE SELECTION------------------------------------------>
    <div id="caseSelection" class="itemSelection">
        <button id="myBtnCase">Choose Case</button>
        <div id="myModalCase" class="modal">
            <div class="modal-content">
                <!--<span class="close">&times;</span>-->
                <button type="button" onclick=caseCloseModal() class="btn btn-link closeModal">X</button></br>
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Form Factor (Motherboard)</b></td>
                        <td><b>Maximum GPU Length (Inches)</b></td>
                        <td><b>2.5" Bays</b></td>
                        <td><b>3.5" Bays</b></td>
                        <td><b>Price</b></td>
                        <td></td>
                    </tr>
                    
                    <?php
                        // Print out hardware parts with relevant information
                        $case = getCases($dbConn);
                        $i = 0;
                        for($i; $i < count($case); $i++) {
                            echo '<tr>';
                            echo '<td>'.$case[$i]["caseName"].'</td>';
                            echo '<td>'.$case[$i]["caseFFType"].'</td>';
                            echo '<td>'.$case[$i]["maxGPULengthInches"].'</td>';
                            echo '<td>'.$case[$i]["caseNum25Bays"].'</td>';
                            echo '<td>'.$case[$i]["caseNum35Bays"].'</td>';
                            echo '<td>$'.$case[$i]["casePrice"].'</td>';
                            echo '<td><a href="Component Selection Data/caseSelectData.php?caseId='.$case[$i]["caseId"].
                                 '&remove=false">Add</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="caseSelectionData" class="itemSelection">
        <?php echo $_SESSION["caseSelected"]["caseName"].'   '.$_SESSION["caseSelected"]["casePrice"]; ?>
        <a href="Component Selection Data/caseSelectData.php?remove=true">X</a>
    </div>
    <!---------------------------------------END CASE SELECTION---------------------------------------->
    
    <!------------------------------------------CPU SELECTION------------------------------------------>
    <div id="cpuSelection" class="itemSelection">
        <button id="myBtnCPU" class="btn btn-info btn-sm">Choose CPU</button>
        <div id="myModalCPU" class="modal">
            <div class="modal-content">
                <!--<span class="close">&times;</span>-->
                <button type="button" onclick=cpuCloseModal() class="btn btn-link closeModal">X</button></br>
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Socket</b></td>
                        <td><b>Base Clock</b></td>
                        <td><b># Cores</b></td>
                        <td><b>TDP (Watts)</b></td>
                        <td><b>Price</b></td>
                        <td></td>
                    </tr>
                    
                    <?php
                        // Print out hardware parts with relevant information
                        $CPUs = getCPUs($dbConn);
                        $i = 0;
                        for($i; $i < count($CPUs); $i++) {
                            echo '<tr>';
                            echo '<td>'.$CPUs[$i]["cpuName"].'</td>';
                            echo '<td>'.$CPUs[$i]["socketType"].'</td>';
                            echo '<td>'.$CPUs[$i]["cpuBaseClock"].'</td>';
                            echo '<td>'.$CPUs[$i]["cpuNumCores"].'</td>';
                            echo '<td>'.$CPUs[$i]["cpuTDP"].'</td>';
                            echo '<td>$'.$CPUs[$i]["cpuPrice"].'</td>';
                            echo '<td><a href="Component Selection Data/cpuSelectData.php?cpuId='.$CPUs[$i]["cpuId"].
                                 '&remove=false">Add</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="cpuSelectionData" class="itemSelection">
        <?php echo $_SESSION["cpuSelected"]["cpuName"].'   '.$_SESSION["cpuSelected"]["cpuPrice"]; ?>
        <a href="Component Selection Data/cpuSelectData.php?remove=true">X</a>
    </div>
    <!----------------------------------------END CPU SELECTION---------------------------------------->
    
    
    <!------------------------------------------GPU SELECTION------------------------------------------>
    <div id="gpuSelection" class="itemSelection">
        <button id="myBtnGPU">Choose GPU</button>
        <div id="myModalGPU" class="modal">
            <div class="modal-content">
                <!--<span class="close">&times;</span>-->
                <button type="button" onclick=gpuCloseModal() class="btn btn-link closeModal">X</button></br>
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Manufacturer</b></td>
                        <td><b>Base Clock</b></td>
                        <td><b>Memory</b></td>
                        <td><b>Length (Inches)</b></td>
                        <td><b>TDP (Watts)</b></td>
                        <td><b>Price</td>
                        <td></td>
                    </tr>
                    
                    <?php
                        // Print out hardware parts with relevant information
                        $gpu = getGPUs($dbConn, $_SESSION["sql"]);
                        $i = 0;
                        for($i; $i < count($gpu); $i++) {
                            echo '<tr>';
                            echo '<td>'.$gpu[$i]["gpuName"].'</td>';
                            echo '<td>'.$gpu[$i]["gpuManufacturer"].'</td>';
                            echo '<td>'.$gpu[$i]["gpuBaseClock"].'</td>';
                            echo '<td>'.$gpu[$i]["gpuMemSize"].'</td>';
                            echo '<td>'.$gpu[$i]["gpuLengthInches"].'</td>';
                            echo '<td>'.$gpu[$i]["gpuTDP"].'</td>';
                            echo '<td>$'.$gpu[$i]["gpuPrice"].'</td>';
                            echo '<td><a href="Component Selection Data/gpuSelectData.php?gpuId='.$gpu[$i]["gpuId"].
                                 '&remove=false">add</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="gpuSelectionData" class="itemSelection">
        <?php echo $_SESSION["gpuSelected"]["gpuName"].'   '.$_SESSION["gpuSelected"]["gpuPrice"]; ?>
        <a href="Component Selection Data/gpuSelectData.php?remove=true">X</a>
    </div>
    <!----------------------------------------END GPU SELECTION---------------------------------------->
    
    <!--------------------------------------Motherboard SELECTION-------------------------------------->
    <div id="mbSelection" class="itemSelection">
        <button id="myBtnMB">Choose Motherboard</button>
        <div id="myModalMB" class="modal">
            <div class="modal-content">
                <button type="button" onclick=mbCloseModal() class="btn btn-link closeModal">X</button></br>
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Socket</b></td>
                        <td><b>Form Factor</b></td>
                        <td><b># RAM Slots</b></td>
                        <td><b>RAM Type</b></td>
                        <td><b>Price</td>
                        <td></td>
                    </tr>
                    
                    <?php
                        $mbs = getMotherboards($dbConn, $_SESSION["sql"]);
                        $i = 0;
                        for($i; $i < count($mbs); $i++) {
                            echo '<tr>';
                            echo '<td>'.$mbs[$i]["mbName"].'</td>';
                            echo '<td>'.$mbs[$i]["socketType"].'</td>';
                            echo '<td>'.$mbs[$i]["mbFFType"].'</td>';
                            echo '<td>'.$mbs[$i]["mbNumRamSlots"].'</td>';
                            echo '<td>'.$mbs[$i]["ramType"].'</td>';
                            echo '<td>$'.$mbs[$i]["mbPrice"].'</td>';
                            echo '<td><a href="Component Selection Data/motherboardSelectData.php?mbId='.$mbs[$i]["mbId"].
                                 '&remove=false">add</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="mbSelectionData" class="itemSelection">
        <?php echo $_SESSION["mbSelected"]["mbName"].'   '.$_SESSION["mbSelected"]["mbPrice"]; ?>
        <a href="Component Selection Data/motherboardSelectData.php?remove=true">X</a>
    </div>
    <!------------------------------------END Motherboard SELECTION------------------------------------>
    
    <!-------------------------------------POWER SUPPLY SELECTION-------------------------------------->
    <div id="psuSelection" class="itemSelection">
        <button id="myBtnPSU">Choose Power Supply</button>
        <div id="myModalPSU" class="modal">
            <div class="modal-content">
                <!--<span class="close">&times;</span>-->
                <button type="button" onclick=psuCloseModal() class="btn btn-link closeModal">X</button></br>
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Watts</b></td>
                        <td><b>Efficiency</b></td>
                        <td><b>Modularity</b></td>
                        <td><b>Price</td>
                        <td></td>
                    </tr>
                    
                    <?php
                        // Print out hardware parts with relevant information
                        $psu = getPSUs($dbConn, $_SESSION["sql"]);
                        $i = 0;
                        for($i; $i < count($psu); $i++) {
                            echo '<tr>';
                            echo '<td>'.$psu[$i]["psuName"].'</td>';
                            echo '<td>'.$psu[$i]["psuWatts"].'</td>';
                            echo '<td>'.$psu[$i]["psuEfficiency"].'</td>';
                            echo '<td>'.$psu[$i]["psuModularity"].'</td>';
                            echo '<td>$'.$psu[$i]["psuPrice"].'</td>';
                            echo '<td><a href="Component Selection Data/psuSelectData.php?psuId='.$psu[$i]["psuId"].
                                 '&remove=false">add</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="psuSelectionData" class="itemSelection">
        <?php echo $_SESSION["psuSelected"]["psuName"].'   '.$_SESSION["psuSelected"]["psuPrice"]; ?>
        <a href="Component Selection Data/psuSelectData.php?remove=true">X</a>
    </div>
    <!-----------------------------------END POWER SUPPLY SELECTION------------------------------------>
    
    <!----------------------------------------MEMORY SELECTION----------------------------------------->
    <div id="ramSelection" class="itemSelection">
        <button id="myBtnRAM">Choose Memory</button>
        <div id="myModalRAM" class="modal">
            <div class="modal-content">
                <!--<span class="close">&times;</span>-->
                <button type="button" onclick=ramCloseModal() class="btn btn-link closeModal">X</button></br>
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Type</b></td>
                        <td><b>Size (GB)</b></td>
                        <td><b>Speed</b></td>
                        <td><b>Cas</b></td>
                        <td><b>Price</b></td>
                        <td></td>
                    </tr>
                    
                    <?php
                        $ram = getRam($dbConn);
                        $i = 0;
                        for($i; $i < count($ram); $i++) {
                            echo '<tr>';
                            echo '<td>'.$ram[$i]["ramName"].'</td>';
                            echo '<td>'.$ram[$i]["ramType"].'</td>';
                            echo '<td>'.$ram[$i]["ramSizeGB"].'</td>';
                            echo '<td>'.$ram[$i]["ramSpeed"].'</td>';
                            echo '<td>'.$ram[$i]["ramCas"].'</td>';
                            echo '<td>$'.$ram[$i]["ramPrice"].'</td>';
                            echo '<td><a href="Component Selection Data/ramSelectData.php?ramId='.$ram[$i]["ramId"].
                                 '&remove=false">add</a></td>';   
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="ramSelectionData" class="itemSelection">
        <?php echo $_SESSION["ramSelected"]["ramName"].'   '.$_SESSION["ramSelected"]["ramPrice"]; ?>
        <a href="Component Selection Data/ramSelectData.php?remove=true">X</a>
    </div>
    <!--------------------------------------END MEMORY SELECTION--------------------------------------->
    
    <!----------------------------------------STORAGE SELECTION---------------------------------------->
    <div id="storageSelection" class="itemSelection">
        <button id="myBtnStorage">Choose Storage</button>
        <div id="myModalStorage" class="modal">
            <div class="modal-content">
                <!--<span class="close">&times;</span>-->
                <button type="button" onclick=storageCloseModal() class="btn btn-link closeModal">X</button></br>
                <table class="selectTable">
                    <!-- Put column names on top of the table -->
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Size</b></td>
                        <td><b>Type</b></td>
                        <td><b>RPM</b></td>
                        <td><b>Form Factor</b></td>
                        <td><b>Price</b></td>
                        <td></td>
                    </tr>
                    
                    <?php
                        // Print out hardware parts with relevant information
                        $storage = getStorages($dbConn);
                        $i = 0;
                        for($i; $i < count($storage); $i++) {
                            echo '<tr>';
                            echo '<td>'.$storage[$i]["storageName"].'</td>';
                            echo '<td>'.$storage[$i]["storageSize"].'</td>';
                            echo '<td>'.$storage[$i]["storageType"].'</td>';
                            echo '<td>'.$storage[$i]["storageRPM"].'</td>';
                            echo '<td>'.$storage[$i]["storageFFType"].'</td>';
                            echo '<td>$'.$storage[$i]["storagePrice"].'</td>';
                            echo '<td><a href="Component Selection Data/storageSelectData.php?storageId='.$storage[$i]["storageId"].
                                 '&remove=false">add</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div id="storageSelectionData" class="itemSelection">
        <?php echo $_SESSION["storageSelected"]["storageName"].'   '.$_SESSION["storageSelected"]["storagePrice"]; ?>
        <a href="Component Selection Data/storageSelectData.php?remove=true">X</a>
    </div>
    <!--------------------------------------END STORAGE SELECTION-------------------------------------->
    
    <script>
        // When the user clicks anywhere outside of a modal, close it
        window.onclick = function(event) {
            if (event.target == document.getElementById('myModalCase')) {
                document.getElementById('myModalCase').style.display = "none";
            } else if (event.target == document.getElementById('myModalCPU')) {
                document.getElementById('myModalCPU').style.display = "none";
            } else if (event.target == document.getElementById('myModalGPU')) {
                document.getElementById('myModalGPU').style.display = "none";
            } else if (event.target == document.getElementById('myModalMB')) {
                document.getElementById('myModalMB').style.display = "none";
            } else if (event.target == document.getElementById('myModalPSU')) {
                document.getElementById('myModalPSU').style.display = "none";
            } else if (event.target == document.getElementById('myModalRAM')) {
                document.getElementById('myModalRAM').style.display = "none";
            } else if (event.target == document.getElementById('myModalStorage')) {
                document.getElementById('myModalStorage').style.display = "none";
            } 
        }
        
        
        // ------------------------- CASE MODAL ----------------------------
        // Check whether to display the modal button or the case data
        if (<?php echo ($_SESSION["caseSelected"] != NULL) ? 1 : 0; ?> == 1) {
            document.getElementById('caseSelection').style.display = "none";
            document.getElementById('caseSelectionData').style.display = "block";
        } else {
            document.getElementById('caseSelection').style.display = "block";
            document.getElementById('caseSelectionData').style.display = "none";
        }
        
        // When the user clicks on the button, open the modal
        document.getElementById("myBtnCase").onclick = function() {
            document.getElementById('myModalCase').style.display = "block";
        }
        // Function for modal close button
        function caseCloseModal() {
            document.getElementById('myModalCase').style.display = "none";
        }
        // ------------------------- END CASE MODAL ------------------------
        
        
        // -------------------------- CPU MODAL ----------------------------
        // Check whether to display the modal button or the cpu data
        if (<?php echo ($_SESSION["cpuSelected"] != NULL) ? 1 : 0; ?> == 1) {
            document.getElementById('cpuSelection').style.display = "none";
            document.getElementById('cpuSelectionData').style.display = "block";
        } else {
            document.getElementById('cpuSelection').style.display = "block";
            document.getElementById('cpuSelectionData').style.display = "none";
        }
        
        // When the user clicks on the button, open the modal
        document.getElementById("myBtnCPU").onclick = function() {
            document.getElementById('myModalCPU').style.display = "block";
        }
        // Function for modal close button
        function cpuCloseModal() {
            document.getElementById('myModalCPU').style.display = "none";
        }
        // ------------------------- END CPU MODAL -------------------------
        
        // -------------------------- GPU MODAL ----------------------------
        // Check whether to display the modal button or the gpu data
        if (<?php echo ($_SESSION["gpuSelected"] != NULL) ? 1 : 0; ?> == 1) {
            document.getElementById('gpuSelection').style.display = "none";
            document.getElementById('gpuSelectionData').style.display = "block";
        } else {
            document.getElementById('gpuSelection').style.display = "block";
            document.getElementById('gpuSelectionData').style.display = "none";
        }
        
        // When the user clicks on the button, open the modal
        document.getElementById("myBtnGPU").onclick = function() {
            document.getElementById('myModalGPU').style.display = "block";
        }
        // Function for modal close button
        function gpuCloseModal() {
            document.getElementById('myModalGPU').style.display = "none";
        }
        // ------------------------- END GPU MODAL -------------------------
        
        // ---------------------- MOTHERBOARD MODAL ------------------------
        // Check whether to display the modal button or the motherboard data
        if (<?php echo ($_SESSION["mbSelected"] != NULL) ? 1 : 0; ?> == 1) {
            document.getElementById('mbSelection').style.display = "none";
            document.getElementById('mbSelectionData').style.display = "block";
        } else {
            document.getElementById('mbSelection').style.display = "block";
            document.getElementById('mbSelectionData').style.display = "none";
        }
        
        // When the user clicks on the button, open the modal
        document.getElementById("myBtnMB").onclick = function() {
            document.getElementById('myModalMB').style.display = "block";
        }
        // Function for modal close button
        function mbCloseModal() {
            document.getElementById('myModalMB').style.display = "none";
        }
        // --------------------- END MOTHERBOARD MODAL ---------------------
        
        // -------------------------- PSU MODAL ----------------------------
        // Check whether to display the modal button or the psu data
        if (<?php echo ($_SESSION["psuSelected"] != NULL) ? 1 : 0; ?> == 1) {
            document.getElementById('psuSelection').style.display = "none";
            document.getElementById('psuSelectionData').style.display = "block";
        } else {
            document.getElementById('psuSelection').style.display = "block";
            document.getElementById('psuSelectionData').style.display = "none";
        }
        
        // When the user clicks on the button, open the modal
        document.getElementById("myBtnPSU").onclick = function() {
            document.getElementById('myModalPSU').style.display = "block";
        }
        // Function for modal close button
        function psuCloseModal() {
            document.getElementById('myModalPSU').style.display = "none";
        }
        // ------------------------- END PSU MODAL -------------------------
        
        // -------------------------- RAM MODAL ----------------------------
        // Check whether to display the modal button or the ram data
        if (<?php echo ($_SESSION["ramSelected"] != NULL) ? 1 : 0; ?> == 1) {
            document.getElementById('ramSelection').style.display = "none";
            document.getElementById('ramSelectionData').style.display = "block";
        } else {
            document.getElementById('ramSelection').style.display = "block";
            document.getElementById('ramSelectionData').style.display = "none";
        }
        
        // When the user clicks on the button, open the modal
        document.getElementById("myBtnRAM").onclick = function() {
            document.getElementById('myModalRAM').style.display = "block";
        }
        // Function for modal close button
        function ramCloseModal() {
            document.getElementById('myModalRAM').style.display = "none";
        }
        // ------------------------- END RAM MODAL -------------------------
        
        // ------------------------ STORAGE MODAL --------------------------
        // Check whether to display the modal button or the storage data
        if (<?php echo ($_SESSION["storageSelected"] != NULL) ? 1 : 0; ?> == 1) {
            document.getElementById('storageSelection').style.display = "none";
            document.getElementById('storageSelectionData').style.display = "block";
        } else {
            document.getElementById('storageSelection').style.display = "block";
            document.getElementById('storageSelectionData').style.display = "none";
        }
        
        // When the user clicks on the button, open the modal
        document.getElementById("myBtnStorage").onclick = function() {
            document.getElementById('myModalStorage').style.display = "block";
        }
        // Function for modal close button
        function storageCloseModal() {
            document.getElementById('myModalStorage').style.display = "none";
        }
        // ----------------------- END STORAGE MODAL -----------------------
    </script>

    
    <!--Display and tool functions-->
    <script>
        // Manages what the page does when it loaded
        if ('<?php echo strcmp($_SESSION["username"],""); ?>' != 0 ) { loggedInDisplay(); } 
        else {  loggedOutDisplay(); } 
    
    
        function loggedInDisplay() {
            $('#error').html("");
            $('#admin-tools-menu').slideDown(400);
            $('#btn-login').hide();
            $('#btn-logout').show();
            $('.login-input').hide();
            $('#adminUsername').html('Administrator:  <b><?php echo $_SESSION["username"]; ?></b>');
        }
        
        function loggedOutDisplay() {
            $('#admin-tools-menu').slideUp(400);
            $("#login-form").trigger('reset');
            $('#btn-login').show();
            $('#btn-logout').hide();
            $('#adminUsername').html("Administrator: ");
            $('.login-input').show();
        }
    
    </script>


</html>