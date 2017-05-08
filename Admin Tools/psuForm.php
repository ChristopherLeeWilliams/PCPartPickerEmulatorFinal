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

    <h1 class="title">Power Supply Form:</h1>
    
    
    <h3> Delete / Update: </h3></br>
    <div class="wrapper">
        <table class="selectTable">
            <!-- Put column names on top of the table -->
            <tr>
              <td><b>Name</b></td>
              <td><b>Watts</b></td>
              <td><b>Efficiency</b></td>
              <td><b>Modularity</b></td>
              <td><b>Price</td>
              <td></td>
              <td></td>
          </tr>
          
          <?php
              // Print out hardware parts with relevant information
              $psu = getPSUs($dbConn);
              $i = 0;
              for($i; $i < count($psu); $i++) {
                  echo '<tr>';
                  echo '<td>'.$psu[$i]["psuName"].'</td>';
                  echo '<td>'.$psu[$i]["psuWatts"].'</td>';
                  echo '<td>'.$psu[$i]["psuEfficiency"].'</td>';
                  echo '<td>'.$psu[$i]["psuModularity"].'</td>';
                  echo '<td>$'.$psu[$i]["psuPrice"].'</td>';
                  echo '<td><a href="psuForm.php?psuId='.$psu[$i]["psuId"].'">Update</a></td>';
                  echo '<td><a href="Component Selection Data/psuSelectData.php?psuId='.$psu[$i]["psuId"].
                       '&remove=false">add</a></td>';
                  echo '</tr>';
              }
          ?>
        </table>
    </div>
    </br></br>
    
    <?php
        // Print current update target
        $psuSingle = getPSU($dbConn,$_GET['psuId']);
    ?>
    
    </br>
    <h3> Add New / Update: </h3></br>
    <form id="dataInputForm">
      <div class="form-group row">
        <label for="example-text-input" class="col-1 col-form-label">Power Supply Name</label>
        <div class="col-10">
          <input class="form-control" type="text" value="" id="psuNameInput">
        </div>
      </div>
      
      
      <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label">Watts</label>
        <div class="col-10">
          <input class="form-control" type="number" min="0" value="" id="psuWattsInput">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="example-text-input" class="col-1 col-form-label">Modularity</label>
        <div class="col-10">
          <input class="form-control" type="text" value="" id="psuModularityInput">
          <small class="form-text text-muted">EX: "Semi"</small>
        </div>
      </div>
      
      <div class="form-group row">
        <label for="example-text-input" class="col-1 col-form-label">Efficiency</label>
        <div class="col-10">
          <input class="form-control" type="text" value="" id="psuEfficiencyInput">
          <small class="form-text text-muted">EX: "80+ Gold"</small>
        </div>
      </div>
      
      <div class="form-group row">
        <label for="example-number-input" class="col-1 col-form-label">Price (USD)</label>
        <div class="col-10">
          <input class="form-control" type="number" min="0" value="" id="psuPriceInput">
        </div>
      </div>
      
      <div class="form-inline">
        </br><button type="reset"  class="btn btn-primary btn-md" value="Reset">Clear</button></br>
        </br><button type="button" class="btn btn-primary btn-md" onClick="location.href='/Final Project/Admin Tools/psuForm.php'">Deselect Update Target</button>
      </div>
    </form>

    <script>
      if ('<?php echo $_GET['psuId']; ?>' != null) {
        $('#psuNameInput').val('<?php echo $psuSingle["psuName"]; ?>');
        $('#psuWattsInput').val('<?php echo $psuSingle["psuWatts"]; ?>');
        $('#psuModularityInput').val('<?php echo $psuSingle["psuModularity"]; ?>');
        $('#psuEfficiencyInput').val('<?php echo $psuSingle["psuEfficiency"]; ?>');
        $('#psuPriceInput').val('<?php echo $psuSingle["psuPrice"]; ?>');
      }
    </script>
</html>