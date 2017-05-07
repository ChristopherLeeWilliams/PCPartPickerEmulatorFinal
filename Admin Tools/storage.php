<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start(); 
            require_once("../connection.php");
            require_once("../Component Selection Data/componentSelectionFunctions.php");
            
            if (strcmp($_SESSION['username'],"")==0) {
                header("location: ../index.php");
            }
        ?>
        <title></title>
    </head>
    
    <style>
        html {
            padding: 20px 5%;
        }
        .title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        .wrapper {
          max-height: 400px;
          overflow: auto;
        }
    </style>
    
    <!--Imports-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    
    <link rel="icon" href="/Final Project/Images/favicon.jpg">
    <link rel="stylesheet" href="../CSS/finalProject.css">

    <button type="button" class="btn btn-primary btn-md" onClick="location.href='/Final Project/index.php'">Main Menu</button>

    <h1 class="title">CPU Form:</h1>
    
    
    <h3> Delete / Update: </h3></br>
    <div class="wrapper">
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
                    echo '<td><a href="cpuForm.php?cpuId='.$CPUs[$i]["cpuId"].'">Update</a></td>';
                    echo '<td><a href="Component Selection Data/cpuSelectData.php?cpuId='.$CPUs[$i]["cpuId"].
                     '&remove=false">Delete</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
    </br></br>
    
    <?php
        // Print current update target
        $CPU = getCPU($dbConn,$_GET['cpuId']);
        // echo '<table class="selectTable"><tr>';
        // echo '<td>'.$CPU["cpuName"].'</td>';
        // echo '<td>'.$CPU["socketType"].'</td>';
        // echo '<td>'.$CPU["cpuBaseClock"].'</td>';
        // echo '<td>'.$CPU["cpuNumCores"].'</td>';
        // echo '<td>'.$CPU["cpuTDP"].'</td>';
        // echo '<td>$'.$CPU["cpuPrice"].'</td>';
        // echo '</table>';
    ?>
    
    </br>
    <h3> Add New / Update: </h3></br>
    <form id="dataInputForm">
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">CPU Name</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="cpuNameInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Base Clock (GHz)</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="cpuBaseClockInput">
      </div>
    </div>
    
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label"># Cores</label>
      <div class="col-10">
        <input class="form-control" type="number" value="" id="cpuNumCoresInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">TDP</label>
      <div class="col-10">
        <input class="form-control" type="number" value="" id="cpuTDPInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Price (USD)</label>
      <div class="col-10">
        <input class="form-control" type="number" value="" id="cpuPriceInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">CPU Socket</label>
      <div class="col-10">
      <select class="form-control" id="cpuSocketTypeInput">
        <?php
            $sockets = getSockets($dbConn);
            $i = 0;
            for($i; $i < count($sockets); $i++) {
              echo '<option value='.$sockets[$i]["socketId"].'>'.$sockets[$i]["socketType"].'</option>';
                
            }
        ?>
      </select>
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">Manufacturer</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="cpuManufacturerInput">
      </div>
    </div>
    </br><button type="reset"  class="btn btn-primary btn-md" value="Reset">Clear</button>
    </form>

    <script>
      if ('<?php echo $_GET['cpuId']; ?>' != null) {
        $('#cpuNameInput').val('<?php echo $CPU["cpuName"]; ?>');
        $('#cpuBaseClockInput').val('<?php echo $CPU["cpuBaseClock"]; ?>');
        $('#cpuNumCoresInput').val('<?php echo $CPU["cpuNumCores"]; ?>');
        $('#cpuTDPInput').val('<?php echo $CPU["cpuTDP"]; ?>');
        $('#cpuPriceInput').val('<?php echo $CPU["cpuPrice"]; ?>');
        $('#cpuSocketTypeInput').val('<?php echo $CPU["cpuSocketId"]; ?>');
        $('#cpuManufacturerInput').val('<?php echo $CPU["cpuManufacturer"]; ?>');
      }
    </script>
</html>