<?php
 include('conn.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
  $result = mysqli_query($conn, $sql);

  // Display navigation links
  if (mysqli_num_rows($result) == 1) {
    header("Location: addproduct.php");
    exit();
   } else {
    echo "Login failed.";
  }
  mysqli_close($conn);
?>
