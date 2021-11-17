<?php
include("../includes/header.php");
include("../includes/includes.php");

if (isset($_GET['message'])) {
  popMessage($_GET['message']);
}

if (isset($_POST['venue_name'])) {

  if (checkDbForEntry('venues', 'venue_name', $_POST['venue_name'])) {
    header("location:add_venue.php?message=Venue already exists!");
  } else {
    insertEntryToVenues($_POST['venue_name']);
  }
}

?>

<!DOCTYPE html>

<head>
  <title>Add Venue</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="../src/css/style.css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="../src/js/jquery-1.4.2.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<form class="form-horizontal custom-form" action="add_venue.php" method="post" enctype="multipart/form-data">
  <fieldset class="myForm">
    <legend>New Venue</legend>

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