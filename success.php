<?php
include("src/functions.php");


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Success</title>
</head>
<body>
<p>Great Success</p>

<?php 
if(isset($_GET['message'])){
    popMessage($_GET['message']);
}

?>

</body>
</html>