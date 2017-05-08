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

    <h1 class="title">GPU Form:</h1>
    
    
    <h3> Delete / Update: </h3></br>
    <div class="wrapper">
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
                <td></td>
            </tr>
            
            <?php
                // Print out hardware parts with relevant information
                $gpu = getGPUs($dbConn);
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
                    echo '<td><a href="gpuForm.php?gpuId='.$gpu[$i]["gpuId"].'">Update</a></td>';
                    echo '<td><a href="Component Selection Data/gpuSelectData.php?gpuId='.$gpu[$i]["gpuId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
    </br></br>
    
    <?php
        // Print current update target
        $GPU = getGPU($dbConn,$_GET['gpuId']);
        //var_dump($GPU);
    ?>
    
    </br>
    <h3> Add New / Update: </h3></br>
    <form id="dataInputForm">
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">GPU Name</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="gpuNameInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">Manufacturer</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="gpuManufacturerInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Base Clock (GHz)</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="gpuBaseClockInput">
        <small class="form-text text-muted">EX: "1.44GHz"</small>
      </div>
    </div>
    
    
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">GPU Memory Size (GB)</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="gpuMemSizeInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">TDP</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="gpuTDPInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Length (Inches)</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="gpuLengthInchesInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Price (USD)</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="gpuPriceInput">
      </div>
    </div>
    <div class="form-inline">
      </br><button type="reset"  class="btn btn-primary btn-md" value="Reset">Clear Input</button></br>
      </br><button type="button" class="btn btn-primary btn-md" onClick="location.href='/Final Project/Admin Tools/gpuForm.php'">Deselect Update Target</button>
      </div>
    </form>

    <script>
      if ('<?php echo $_GET['gpuId']; ?>' != null) {
        $('#gpuNameInput').val('<?php echo $GPU["gpuName"]; ?>');
        $('#gpuManufacturerInput').val('<?php echo $GPU["gpuManufacturer"]; ?>');
        $('#gpuBaseClockInput').val('<?php echo $GPU["gpuBaseClock"]; ?>');
        $('#gpuMemSizeInput').val('<?php echo $GPU["gpuMemSize"]; ?>');
        $('#gpuTDPInput').val('<?php echo $GPU["gpuTDP"]; ?>');
        $('#gpuLengthInchesInput').val('<?php echo $GPU["gpuLengthInches"]; ?>');
        $('#gpuPriceInput').val('<?php echo $GPU["gpuPrice"]; ?>');
      }
    </script>
</html>