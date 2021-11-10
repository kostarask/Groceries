<?php
  include("includes/header.php");
  require("includes/db.php");
  include("includes/functions.php");

?>
<!DOCTYPE html>
<head>
    <title>Whatever</title>
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="src/css/style.css">     -->
    <link rel="stylesheet" href="src/css/test2.css">    
    <link rel="stylesheet" href="src/css/style.css">    
</head>

<body>
  <div class="form">
  <div class="title">Welcome</div>
  <div class="input-container ic2">
    <input id="lastname" class="input" type="date" placeholder=" " />
    <div class="cut"></div>
    <label for="lastname" class="placeholder">Date of Purchase</label>
  </div>
  <div class="input-container ic2">
    <input id="firstname" class="input" type="text" placeholder=" " />
    <div class="cut cut-short"></div>
    <label for="firstname" class="placeholder">Venue</label>
  </div>
  <div class="input-container ic1">
    <input id="firstname" class="input" type="text" placeholder=" " />
    <div class="cut"></div>
    <label for="firstname" class="placeholder">Product price</label>
  </div>
  <div class="input-container ic1">
    <input id="firstname" class="input" type="number" min="0" step="any" placeholder=" " />
    <div class="cut"></div>
    <label for="firstname" class="placeholder">Number of Products</label>
  </div>
  <div class="input-container ic1">
    <input id="firstname" class="input" type="text" placeholder=" " />
    <div class="cut"></div>
    <label for="firstname" class="placeholder">Product quantity in gr</label>
  </div>
  <div class="input-container ic2">
    <input id="email" class="input" type="text" placeholder=" " />
    <div class="cut cut-short"></div>
    <label for="email" class="placeholder">Offer</>
  </div>
  <button type="text" class="submit btn btn-primary">submit</button>
</div>
  </body>
</html>

