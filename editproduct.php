<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit product</title>
    <style>
.search-form input[type="text"] {
    padding: 10px;
    margin-right: 10px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-top: 7%;
    margin-left: 40%;
    margin-bottom: 2%;
  }

  .search-form button[type="submit"] {
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
  }
  table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom : 5px;
    }
    th, td {
      text-align: left;
      padding: 8px;
    }
    th {
      background-color: #333;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #4CAF50;
      cursor: pointer;
    }
  </style>
</head>
<link rel="stylesheet" type="text/css" href="./style/nav.css">
<body>
<div class="navbar">
  <a  href="addproduct.php">Add Product</a>
  <a href='productlist.php'>Product List</a>
  <a href="dailysells.php">Daily Sales</a>
</div> 
<form method="POST" action="" class="search-form">
    <input type="text" name="quantity" placeholder="Subtract Quatity">
    <button type="submit" name="search">Subtract</button>
<?php
$part_number = $_GET['part_number'];
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invetory";
$conn = new mysqli($servername, $username, $password, $dbname);
// Retrieve form data

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM product WHERE part_number = '$part_number'";
$result = $conn->query($sql);
echo "<table>\n";
echo "<tr><th>Part Number</th><th>Product Description</th><th>Quantity</th></tr>\n";
if ($row = mysqli_fetch_assoc($result)) {
  echo "<tr onclick=\"location.href='editproduct.php?part_number=" . $row["part_number"] . "';\">\n";
  echo "<td>" . $row["part_number"] . "</td><td>" . $row["description"] . "</td><td>" . $row["quantity"] . "</td>\n";
  echo "</tr>\n";
} 
echo "</table>\n";
if (isset($_POST['search'])) {
    $quantity = $_POST['quantity'];
    $new_quantity = $row['quantity'] - $quantity;
    $sql = "UPDATE product SET quantity = '$new_quantity' WHERE part_number = '$part_number'";
  } 
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Quantity Subtracted!.');</script>";
} 
?>
</body>
</html>