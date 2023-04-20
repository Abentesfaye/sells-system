<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daily Sells</title>
	<link rel="stylesheet" type="text/css" href="./style/addprdstyle.css">
	<link rel="stylesheet" type="text/css" href="./style/nav.css">
</head>
<body>
<div class="navbar">
  <a href="addproduct.php">Add Product</a>
  <a  href='productlist.php'>Stock</a>
  <a class="active" href="dailysells.php">Daily Sells</a>
  <a  href="sells_Report.php">Sales Report</a>
</div> 
<h1>Daily sales</h1>
<?php 
include('conn.php'); 

// Retrieve the list of products 
$sql = "SELECT * FROM product"; 
$result = $conn->query($sql); 

// Display the form 
echo "<form method='post'>"; 
echo "<label for='date' >Date:</label>"; 
echo "<input type='date' name='date' id='date' required>"; 
echo "<br>"; 
echo "<label for='part_number'>Part number:</label>"; 
echo "<input type='text' name='part_number' id='part_number' required>"; 
echo "<br>"; 
echo "<label for='quantity'>Quantity:</label>"; 
echo "<input type='number' name='quantity' id='quantity'>"; 
echo "<br>"; 
echo "<label for='price'>Unit Price w/o/vat:</label>"; 
echo "<input type='number' name='price' id='price'>"; 
echo "<br>"; 
echo "<label for='reason'>Reason:</label>"; 
echo "<input type='text' name='reason' id='reason'>"; 
echo "<br>"; 
echo "<input type='submit' value='Submit'>"; 
echo "</form>"; 

// When the form is submitted 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    // Retrieve the values 
    $date = $_POST['date']; 
    $part_number = $_POST['part_number']; 
    $quantity = $_POST['quantity']; 
    $price = $_POST['price']; 
    $reason = $_POST['reason'];

    // Check to ensure that the product and quantity sold are valid values 

    $sql = "SELECT * FROM product WHERE part_number = '$part_number'"; 
    $result = $conn->query($sql); 
    if ($result->num_rows == 1) { 
        $row = $result->fetch_assoc(); 
        $current_quantity = $row['quantity']; 
        if ($quantity > $current_quantity) { 
            echo "<h2>Error: Not enough products in stock</h2>"; 
            exit; 
        } 
    } else { 
        echo "Error: Invalid product"; 
        exit; 
    } 

    // Calculate the total revenue 
    $revenue = $quantity * $price; 

    // Update the product table 
    $new_quantity = $current_quantity - $quantity; 
    $sql = "UPDATE product SET quantity = $new_quantity WHERE part_number = '$part_number'"; 
    if ($conn->query($sql) === FALSE) { 
        echo "Error updating record: " . $conn->error; 
        exit; 
    } 

    // Insert a new row into the sells table 
    $sql = "INSERT INTO sells (date, part_number, quantity, sells_price , reason) VALUES ('$date', '$part_number', $quantity, $price, '$reason')"; 
    // Execute SQL statement 
    if ($conn->query($sql) === TRUE) { 
        echo "<h2>New sell record created successfully</h2>"; 
    } else { 
        echo "Error: " . $sql . "<br>" . $conn->error; 
    } 
} 

// Close database connection 
$conn->close(); 
?>

</body>
</html>
