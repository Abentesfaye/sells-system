<?php
// Connect to the database
include('conn.php');
// Retrieve form data
$description = $_POST['description'];
$part_number = $_POST['part_number'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$supplier = $_POST['supplier'];
// Check connection

// Create a new table for products if it doesn't already exist
$sql = "CREATE TABLE IF NOT EXISTS product (
  description VARCHAR(30) NOT NULL,
  part_number VARCHAR(30) NOT NULL PRIMARY KEY,
  quantity INT(6) NOT NULL,
  price INT(6) NOT NULL,
  supplier VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

// Insert the new product into the table
// Query the database for existing product with the same part number
$sql = "SELECT * FROM product WHERE part_number = '$part_number'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Product already exists, update its quantity
  $row = $result->fetch_assoc();
  $new_quantity = $row['quantity'] + $quantity;
  $sql = "UPDATE product SET quantity = '$new_quantity' WHERE part_number = '$part_number'";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Product already exists. Quantity added.');</script>";
} else {
  echo "Error updating record: " . $conn->error;
}
} else {
// Product does not exist, insert a new row into the table
$sql = "INSERT INTO product (description, part_number, quantity, price, supplier) VALUES ('$description', '$part_number', '$quantity', '$price', '$supplier')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Product added successfully.');</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close the database connection
$conn->close();
echo "<script>window.location.href = 'addproduct.php';</script>";
?>