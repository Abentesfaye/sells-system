<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="stylesheet" type="text/css" href="./style/nav.css">
   <link rel="stylesheet" type="text/css" href="./style/list.css">
</head>
<body>
<div class="navbar">
  <a href="addproduct.php">Add Product</a>
  <a href='productlist.php'>Product List</a>
  <a href="dailysells.php">Daily Sells</a>
  <a href="sells_report.php">Sells Report</a>
</div>
<h1>product Found!</h1>
<?php
 include('conn.php');
 if (isset($_POST['search'])) {
     $search_term = $_POST['search_term'];
     $query = "SELECT * FROM product WHERE part_number = '$search_term' ORDER BY part_number DESC";
   } else {
     $query = "SELECT * FROM product ORDER BY part_number DESC";
   }
 
   $result = mysqli_query($conn, $query);
   echo "<table>\n";
   echo "<tr><th>Part Number</th><th>Product Description</th><th>Quantity</th></tr>\n";
   if ($row = mysqli_fetch_assoc($result)) {
     echo "<tr onclick=\"location.href='editproduct.php?part_number=" . $row["part_number"] . "';\">\n";
     echo "<td>" . $row["part_number"] . "</td><td>" . $row["description"] . "</td><td>" . $row["quantity"] . "</td>\n";
     echo "</tr>\n";
   } 
   echo "</table>\n";
?>

</body>
</html>