<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="src\css\style.css">
</head>

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="show_expences.php">Expenses</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="show_product_categories">Show Data<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-options" href="show_purchases.php">Purchases</a></li>
              <li><a class="dropdown-options" href="show_products.php">Products</a></li>
              <li><a class="dropdown-options" href="show_product_categories.php">Product Categories</a></li>
              <li><a class="dropdown-options" href="show_product_types.php">Product Types</a></li>
              <li><a class="dropdown-options" href="show_product_subtypes.php">Product Subtypes</a></li>
              <li><a class="dropdown-options" href="show_venues.php">Venues</a></li>
              <li><a class="dropdown-options" href="show_offers.php">Offers</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Log New Data<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-options" href="add_purchase.php">Log Purchase</a></li>
              <li><a href="add_prod.php">Add Product</a></li>
              <li><a href="add_product_category.php">Add Category</a></li>
              <li><a href="add_product_type.php">Add Product Type</a></li>
              <li><a href="add_product_subtype.php">Add Product Subtype</a></li>
              <li><a href="add_venue.php">Add new venue</a></li>
              <li><a href="add_offer.php">Add new offer</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-form navbar-right" action="search.php" method="post" enctype="multipart/form-data">
          <input list="products_header" id="product_name" name="product_name" placeholder="Search for product..." class="form-control" autocomplete="off" type="text">
          <button type="submit" class="btn btn-primary">Search</button>
        </form>
      </div>
    </div>
  </nav>

</body>

</html>