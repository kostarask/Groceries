<?php
include("includes/header.php");
require("includes/db.php");
include("includes/functions.php");

if (isset($_GET['message'])) {
    popMessage($_GET['message']);
}
