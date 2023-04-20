<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
   <link rel="stylesheet" type="text/css" href="./style/nav.css">
   <link rel="stylesheet" type="text/css" href="./style/addprdstyle.css">
</head>
<body>
<div class="navbar">
  <a class="active" href="addproduct.php">Add Product</a>
  <a href='productlist.php'>Stock</a>
  <a href="dailysells.php">Daily Sales</a>
  <a href="sells_report.php">Sales Report</a>
</div> 
<div class="container">
  <form method="post" action="submitproduct.php">
    <label for="description">Product Description</label>
    <input type="text" id="description" name="description" required>

    <label for="part_number">Part Number</label>
    <input type="text" id="part_number" name="part_number" required>

    <label for="quantity">Quantity</label>
    <input type="number" id="quantity" name="quantity" required>
    <label for="price">price</label>
    <input type="number" id="price" name="price" >
   
    <label for="supplier">supplier</label>
    <div class="text-container">
    <input type="text" id="supplier" name="supplier" list="company" requred>
<datalist id="company">
    <option value="Moenco">
    <option value="Meaza Auto Spare parts">
    <option value="MinAddis Paints">
    <option value="Addisgas">
    <option value="Naos">
</datalist>
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>