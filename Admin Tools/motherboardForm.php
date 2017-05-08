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
          max-height: 340px;
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

    <h1 class="title">Motherboard Form:</h1>
    
    
    <h3> Delete / Update: </h3></br>
    <div class="wrapper">
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
                <td></td>
            </tr>
              
            <?php
                $mbs = getMotherboards($dbConn);
                $i = 0;
                for($i; $i < count($mbs); $i++) {
                    echo '<tr>';
                    echo '<td>'.$mbs[$i]["mbName"].'</td>';
                    echo '<td>'.$mbs[$i]["socketType"].'</td>';
                    echo '<td>'.$mbs[$i]["mbFFType"].'</td>';
                    echo '<td>'.$mbs[$i]["mbNumRamSlots"].'</td>';
                    echo '<td>'.$mbs[$i]["ramType"].'</td>';
                    echo '<td>$'.$mbs[$i]["mbPrice"].'</td>';
                    echo '<td><a href="motherboardForm.php?mbId='.$mbs[$i]["mbId"].'">Update</a></td>';
                    echo '<td><a href="Component Selection Data/motherboardSelectData.php?mbId='.$mbs[$i]["mbId"].
                         '&remove=false">Delete</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
    </br></br>
    
    <?php
        // Print current update target
        $motherboard = getMotherboard($dbConn,$_GET['mbId']);
    ?>
    
    </br>
    <h3> Add New / Update: </h3></br>
    <form id="dataInputForm">
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">Motherboard Name</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="mbNameInput">
      </div>
    </div>
    
     <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Motherboard Socket Type</label>
      <div class="col-10">
      <select class="form-control" id="mbSocketTypeInput">
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
      <label for="example-number-input" class="col-1 col-form-label">Motherboard Form Factor</label>
      <div class="col-10">
      <select class="form-control" id="mbFFTypeInput">
        <?php
            $formFactors = getMBFormFactors($dbConn);
            $i = 0;
            for($i; $i < count($formFactors); $i++) {
              echo '<option value='.$formFactors[$i]["mbFFId"].'>'.$formFactors[$i]["mbFFType"].'</option>';
            }
        ?>
      </select>
      </div>
    </div>
    
     <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label"># Ram Slots</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="mbNumRamSlotsInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Max Ram (GB)</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="mbMaxRamInput">
      </div>
    </div>
    
   <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Ram Type</label>
      <div class="col-10">
      <select class="form-control" id="mbRamTypeInput">
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
      <label for="example-number-input" class="col-1 col-form-label"># Sata 3 Ports</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="mbNumSataPortsInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Price (USD)</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="mbPriceInput">
      </div>
    </div>
    <div class="form-inline">
      </br><button type="reset"  class="btn btn-primary btn-md" value="Reset">Clear</button></br>
      </br><button type="button" class="btn btn-primary btn-md" onClick="location.href='/Final Project/Admin Tools/motherboardForm.php'">Deselect Update Target</button>
    </div>
    </form>

    <script>
      if ('<?php echo $_GET['mbId']; ?>' != null) {
        $('#mbNameInput').val('<?php echo $motherboard["mbName"]; ?>');
        $('#mbSocketTypeInput').val('<?php echo $motherboard["mbSocketId"]; ?>');
        $('#mbFFTypeInput').val('<?php echo $motherboard["mbFFId"]; ?>');
        $('#mbNumRamSlotsInput').val('<?php echo $motherboard["mbNumRamSlots"]; ?>');
        $('#mbMaxRamInput').val('<?php echo $motherboard["maxRamGB"]; ?>');
        $('#mbRamTypeInput').val('<?php echo $motherboard["mbRamTypeId"]; ?>');
        $('#mbNumSataPortsInput').val('<?php echo $motherboard["mbNumSata3Ports"]; ?>');
        $('#mbPriceInput').val('<?php echo $motherboard["mbPrice"]; ?>');
      }
    </script>
</html>