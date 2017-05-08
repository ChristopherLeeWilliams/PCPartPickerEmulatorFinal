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

    <h1 class="title">Storage Form:</h1>
    
    
    <h3> Delete / Update: </h3></br>
    <div class="wrapper">
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
                    echo '<td><a href="storageForm.php?storageId='.$storage[$i]["storageId"].'">Update</a></td>';
                    echo '<td><a href="Component Selection Data/storageSelectData.php?storageId='.$storage[$i]["storageId"].
                         '&remove=false">add</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
    </br></br>
    
    <?php
        // Print current update target
        $storageSingle = getStorage($dbConn,$_GET['storageId']);
        //var_dump($storageSingle);
    ?>
    
    </br>
    <h3> Add New / Update: </h3></br>
    <form id="dataInputForm">
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">Storage Name</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="storageNameInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">Size (Append GB/TB)</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="storageSizeInput">
        <small class="form-text text-muted"> EX: "1TB" </small>
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">Type (HDD/SSD)</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="storageTypeInput">
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">RPM (Append RPM)</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="storageRPMInput">
        <small class="form-text text-muted">EX: "7200RPM" or "N/A" if RPM if Not Applicable</small>
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-text-input" class="col-1 col-form-label">Cache Size </br>(Append MB) </label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="storageCacheSizeInput">
        <small class="form-text text-muted">EX: "64MB" or "N/A" if Cache is Not Applicable</small>
      </div>
    </div>
    
    <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Form Factor</label>
      <div class="col-10">
      <select class="form-control" id="storageFFTypeInput">
        <?php
            $storageFormFactions = getStorageFormFactors($dbConn);
            $i = 0;
            for($i; $i < count($storageFormFactions); $i++) {
              echo '<option value='.$storageFormFactions[$i]["storageFFId"].'>'.$storageFormFactions[$i]["storageFFType"].'</option>';
                
            }
        ?>
      </select>
      </div>
    </div>
    
   <div class="form-group row">
      <label for="example-number-input" class="col-1 col-form-label">Price (USD)</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="storagePriceInput">
      </div>
    </div>
    <div class="form-inline">
      </br><button type="reset"  class="btn btn-primary btn-md" value="Reset">Clear</button></br>
      </br><button type="button" class="btn btn-primary btn-md" onClick="location.href='/Final Project/Admin Tools/storageForm.php'">Deselect Update Target</button>
      </div>
    </form>

    <script>
    $('#dataInputForm input').blur(function(){
     if(!$.trim(this.value).length) { // zero-length string AFTER a trim
            $(this).parents('p').addClass('warning');
     }
    });
    
    
      if ('<?php echo $_GET['storageId']; ?>' != null) {
        $('#storageNameInput').val('<?php echo $storageSingle["storageName"]; ?>');
        $('#storageSizeInput').val('<?php echo $storageSingle["storageSize"]; ?>');
        $('#storageTypeInput').val('<?php echo $storageSingle["storageType"]; ?>');
        $('#storageRPMInput').val('<?php echo $storageSingle["storageRPM"]; ?>');
        $('#storageCacheSizeInput').val('<?php echo $storageSingle["storageCache"]; ?>');
        $('#storageFFTypeInput').val('<?php echo $storageSingle["storageFFId"]; ?>');
        $('#storagePriceInput').val('<?php echo $storageSingle["storagePrice"]; ?>');
      }
    </script>
</html>