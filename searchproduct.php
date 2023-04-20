<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search product</title>
    <link rel="stylesheet" type="text/css" href="./style/list.css">
</head>
<body>
     <!-- Navigation bar -->

<!-- search form -->
<form method="POST" action="" class="search-form">
    <input type="text" name="search_term" placeholder="Search by part number...">
    <button type="submit" name="search">Search</button>
  </form>
    <?php
    include('conn.php');
    include('nav.php');
    ?>
</body>
</html>