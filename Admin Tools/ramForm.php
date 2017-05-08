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

    <h1 class="title">Memory Form:</h1>
    
    
    <h3> Delete / Update: </h3></br>
    <div class="wrapper">
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
                  echo '<td><a href="ramForm.php?ramId='.$ram[$i]["ramId"].'">Update</a></td>';
                  echo '<td><a href="Component Selection Data/ramSelectData.php?ramId='.$ram[$i]["ramId"].
                       '&remove=false">add</a></td>';   
                  echo '</tr>';
              }
          ?>
        </table>
    </div>
    </br></br>
    
    <?php
        // Print current update target
        $ramSingle = getRamSingle($dbConn,$_GET['ramId']);
    ?>
    
    </br>
    <h3> Add New / Update: </h3></br>
    <form id="dataInputForm">
        
      <div class="form-group row">
        <label for="example-text-input" class="col-1 col-form-label">Ram Name</label>
        <div class="col-10">
          <input class="form-control" type="text" value="" id="ramNameInput">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label">Ram Type</label>
        <div class="col-10">
        <select class="form-control" id="ramTypeInput">
          <?php
              $ramTypes = getRamTypes($dbConn);
              $i = 0;
              for($i; $i < count($ramTypes); $i++) {
                echo '<option value='.$ramTypes[$i]["ramTypeId"].'>'.$ramTypes[$i]["ramType"].'</option>';
                  
              }
          ?>
        </select>
        </div>
      </div>
      
      <div class="form-group row">
        <label for="example-text-input" class="col-1 col-form-label">Speed (Append MHz)</label>
        <div class="col-10">
          <input class="form-control" type="text" value="" id="ramSpeedInput">
          <small class="form-text text-muted">EX: "1600MHz"</small>
        </div>
      </div>
      
      
      <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label">CAS (ns)</label>
        <div class="col-10">
          <input class="form-control" type="number" min="0" value="" id="ramCASInput">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label">Size (GB)</label>
        <div class="col-10">
          <input class="form-control" type="number" min="0" value="" id="ramSizeInput">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label">Price (USD)</label>
        <div class="col-10">
          <input class="form-control" type="number" min="0" value="" id="ramPriceInput">
        </div>
      </div>
      <div class="form-inline">
        </br><button type="reset"  class="btn btn-primary btn-md" value="Reset">Clear</button></br>
        </br><button type="button" class="btn btn-primary btn-md" onClick="location.href='/Final Project/Admin Tools/ramForm.php'">Deselect Update Target</button>
      </div>
    
    </form>

    <script>
      if ('<?php echo $_GET['cpuId']; ?>' != null) {
        $('#ramNameInput').val('<?php echo $ramSingle["ramName"]; ?>');
        $('#ramTypeInput').val('<?php echo $ramSingle["ramTypeId"]; ?>');
        $('#ramSpeedInput').val('<?php echo $ramSingle["ramSpeed"]; ?>');
        $('#ramCASInput').val('<?php echo $ramSingle["ramCas"]; ?>');
        $('#ramSizeInput').val('<?php echo $ramSingle["ramSizeGB"]; ?>');
        $('#ramPriceInput').val('<?php echo $ramSingle["ramPrice"]; ?>');
      }
    </script>
</html>