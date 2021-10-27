<?php
$title = array("PRODUCT", "COLOR", "PRICE", "STOCK");
$products = array(
["iPad", "black", 400, 5, "iPad is popular product of Apple Inc."], 
["Camera", "gray", 180, 3, "Camera is an optical instrument used to record images."],
["Bucket", "blue", 12, 7, "Bucket is usually an open-top container."], 
["Bottle", "pink", 15, 9, "Bottle is a glass or plastic container with a narrow neck, used for storing drinks or other liquids."],
["T-Shirt", "yellow", 20, 10, "T-Shirt is a style of fabric shirt named after the T shape of its body and sleeves."], 
["Coat", "navy", 35, 7, "Coat is a garment worn on the upper body by either sex, for warmth or fashion."]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>The Simplest Way to Collapse Table Rows with jQuery</title>
    <meta charset="UTF-8">
    <meta name="description" content="Scripts for Learning Programming">
    <meta name="author" content="Easy Code Share">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="collapse.css">
</head>
<body>
    <table>
    <!-- Title -->
    <tr><?php foreach($title as $data) echo "<th>$data</th>"; ?></tr>
    <!-- Rows -->
    <?php foreach($products as $key=>$data) { 
        echo "<tr class='expand' place='r-$key'>";
        $last = count($data) - 1;
        foreach($data as $kk=>$field) {
            if($kk == $last) $desc = "<b>Desc:</b><br>$field";
            else echo "<td>$field</td>";
        }
        echo "</tr><tr><td colspan='$last' class='desc' id='r-$key'>$desc</td></tr>";
    } ?>
    </table>
</body>
</html>
<script>
$(document).ready(function() {  
    $('tr.expand').on("click", function() {
        ele = "td#" + $(this).attr("place");
        /* duration:
           "fast" or 200 for FAST easing
           "slow" or 600 milliseconds for SLOW easing
        */
        duration = null;
        $(ele).toggle(duration);
    }); 
});
</script>
