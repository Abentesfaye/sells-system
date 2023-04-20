<!DOCTYPE html>
<html>
<head>
  <title>Product List</title>
  <style>
   
  .pdf-button {
  background-color: #4CAF50; /* Green background */
  color: white; /* White text */
  border: none; /* No border */
  padding: 12px 24px; /* Some padding */
  font-size: 16px; /* Set a font size */
  cursor: pointer; /* Change cursor to a hand pointer on hover */
  border-radius: 4px; /* Rounded corners */
  box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2); /* Add a little shadow */
  margin-bottom: 2%;
}

.pdf-button:hover {
  background-color: #3e8e41; /* Darker green on hover */
}

@media print {
 .search , .navbar{
  visibility:hidden;
 }
 .navbar, .pdf-button{
  display:none;
 }
}


  </style>
   <link rel="stylesheet" type="text/css" href="./style/nav.css">
   <link rel="stylesheet" type="text/css" href="./style/list.css">
</head>
<body>
<div class="navbar">
  <a href="addproduct.php">Add Product</a>
  <a class="active" href='productlist.php'>Stock</a>
  <a href="dailysells.php">Daily Sales</a>
  <a href="sells_report.php">Sales Report</a>
</div> 
<!-- search form -->
<form method="POST" action="search.php" class="search-form">
    <input class="search" type="text" name="search_term" placeholder="Search by part number...">
    <button class="search" type="submit" name="search">Search</button>
  </form>
  <button class="pdf-button"  onclick="window.print()">Print</button>
  <?php
  include('conn.php');
   
    
      
    // Retrieve all products from the database
    $sql = "SELECT * FROM product ORDER BY part_number ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Output the table of products
      echo "<table>";
      echo "<tr><th>Product Description </th><th>Part Number</th><th>Quantity</th><th>Price w/o/vat</th><th>Supplier</th></tr>\n";
      while($row = $result->fetch_assoc()) {
      // Make the row clickable with a link to editproduct.php
      echo "<tr onclick=\"location.href='editproduct.php?part_number=" . $row["part_number"] . "';\">\n";
      echo "<td>" . $row["description"] . "</td><td>" . $row["part_number"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["price"] . "</td><td>" . $row["supplier"] . "</td>\n";
      echo "</tr>\n";
    }
    echo "</table>\n";
  } else {
    echo "0 results";
  }
  
    // Close the database connection
    $conn->close();
  ?>
</script>
</body>
</html>
