<?php
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");
include("includes/dbInserts.php");

if (isset($_GET['message'])) {
  popMessage($_GET['message']);
}

if (isset($_POST['offer_name'])) {

  if (checkDbForEntry('offers', 'offer_name', $_POST['offer_name'])) {
    header("location:add_offer.php?message=Offer already exists!");
  } else {
    insertEntryToOffers($_POST['offer_name']);
  }
}
?>

<!DOCTYPE html>

<head>
  <title>Add Offer</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="src/css/style.css" />
  <link rel="stylesheet" type="text/css" href="src/css/navbar.css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="src/js/jquery-1.4.2.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<form class="form-horizontal custom-form" action="add_offer.php" method="post" enctype="multipart/form-data">
  <fieldset class="myForm">
    <legend>New Offer:</legend>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="offer_name">New Venue Name:</label>
      <div class="col-md-4">
        <input id="offer_name" name="offer_name" placeholder="Please enter new offer name..." class="form-control input-md" required autofocus="true" autocomplete="off" type="text">
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="singlebutton"></label>
      <div class="col-md-4">
        <input type="submit" value="Add New Offer" name="modify" class="btn btn-block btn-primary" />
      </div>
    </div>

  </fieldset>
</form>