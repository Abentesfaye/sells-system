<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="./style/style.css">
  </head>
  <body>
    <div class="container">
      <h1>Login</h1>
      <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
      </form>
    </div>
  </body>
</html>
