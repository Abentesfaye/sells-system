<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sells Report</title>
    <link rel="stylesheet" type="text/css" href="./style/list.css">
    <link rel="stylesheet" type="text/css" href="./style/nav.css">
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
  .navbar {
  visibility:hidden;
 }
 .navbar, .pdf-button{
  display:none;
 }
 ul{
    display:none;
 }
}

</style>
</head>
<body>
<div class="navbar">
  <a href="addproduct.php">Add Product</a>
  <a  href='productlist.php'>Stock</a>
  <a  href="dailysells.php">Daily Sales</a>
  <a class="active" href="sells_Report.php">Sales Report</a>
</div> 

<?php 
    include('conn.php'); 

    // Retrieve the list of days with sales 
    $sql = "SELECT DISTINCT date FROM sells ORDER BY date DESC"; 
    $result = $conn->query($sql); 

    // Display the list of days 
    echo "<ul>"; 
    while ($row = $result->fetch_assoc()) { 
        echo "<li><a href='sells_report.php?date=" . $row['date'] . "'>" . $row['date'] . "</a></li>"; 
    } 
    echo "</ul>"; 

    // Check if a date has been selected 
    if (isset($_GET['date'])) { 
        $date = $_GET['date']; 

        // Retrieve the sales for the selected date 
        $sql = "SELECT product.description, sells.quantity, sells.sells_price, sells.part_number, sells.reason 
        FROM sells 
        JOIN product ON sells.part_number = product.part_number 
        WHERE sells.date = '$date'";
        $result = $conn->query($sql); 

        // Display the sales for the selected date 
        echo "<h2>Sales for $date</h2>"; 
        echo "<table>"; 
        echo "<tr><th>Product</th><th>Part Number</th><th>Quantity</th><th>Unit Price w/o/vat</th><th>Total w/o/vat</th><th>Reason</th></tr>"; 
        $total_revenue = 0; 
        while ($row = $result->fetch_assoc()) { 
          $total_revenue += $row['quantity'] * $row['sells_price'];
          echo "<tr>";
          echo "<td>" . $row['description'] . "</td>";
          echo "<td>" . $row['part_number'] . "</td>";
          echo "<td>" . $row['quantity'] . "</td>";
          echo "<td>" . $row['sells_price'] . "</td>";
          echo "<td>" . ($row['quantity'] * $row['sells_price']) . "</td>";
          echo "<td>" . $row['reason'] . "</td>";
          echo "</tr>";
        } 
        echo "<td></td>";
        echo "<tr><td colspan='1' align='right'>Total daily Sales w/o/vat:</td><td>" . $total_revenue . "</td></tr>";
        echo "</table>"; 
    } 

    // Close database connection 
    $conn->close(); 
?>
<button class="pdf-button"  onclick="window.print()">Print</button>
</body>
</html>
