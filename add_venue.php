<?php
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");

if(isset($_GET['message'])){
    popMessage($_GET['message']);
}

// Function that inserts entry into Database
function insertEntryToDatabase(){
  global $mysqli;

  if($_SERVER['REQUEST_METHOD']=='POST'){

    $venue_name = $_POST['venue_name'];

    checkDbForEntry2('venues','venue_name', $venue_name,
                    'add_venue.php?message=Error: Venue already exists!');
  }

  

  if(!($_SERVER['REQUEST_METHOD']== 'POST')){
    return;
  }

  $sql2 = "INSERT INTO venues (venue_name) VALUES ('$venue_name')";
          
    if($mysqli->query($sql2)===true){
      header("location: show_venues.php?message=New venue added successfully!");
    }else{
      header("location: show_venues.php?message=ERROR: New venue was not added!");
    }
}

insertEntryToDatabase();
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="src/css/style.css" />
<link rel="stylesheet" type="text/css" href="src/css/navbar.css" />
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="src/js/jquery-1.4.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action="add_venue.php" method="post" enctype="multipart/form-data">
<fieldset class= "myForm">
<legend>New Category</legend>

<!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="venue_name">New Venue Name:</label>  
      <div class="col-md-4">
      <input id="venue_name" name="venue_name" placeholder="Please enter name..." class="form-control input-md" required="" type="text">
      </div>
    </div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="submit" value="Add New Venue" name="modify" class="btn btn-block btn-primary" />
  </div>
  </div>

</fieldset>
</form>
