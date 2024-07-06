<?php
session_start();

if(isset($_SESSION['user'])){
  header('location:index.php');
}

require('./assets/php/connect.php');
$message = "";

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare the SQL statement to prevent SQL injection
  $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      
      // Verify the password
      if (password_verify($password, $user['password'])) {
         
        header('location:index.php');
        $_SESSION['user'] = $user;

          exit();
      } else {
          $message = "Invalid password!";
      }
  } else {
      $message = "No user found with that email!";
  }

  $stmt->close();
}
    
  

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>login</title>
    <link rel="stylesheet" href="./assets/css/login.css" />
    <!-- font awesome -->
    <script
      src="https://kit.fontawesome.com/db1fd23933.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container">
      <form action="<?php  $_SERVER['PHP_SELF'] ?>" method="POST" class="form">
        <div>
          <?php  
           
           echo isset($_GET['status']) ? "<p>" . "Account create successful" . "</p>" : "";

          ?>
        </div>
        <h2>Login</h2>
        <div class="form-items">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="example@gmail.com"
            required
          />
        </div>
        <div class="form-items">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter password"
            required
          />
          <p id="show">show</p>
          <p id="hidden">Hidden</p>
        </div>
        <div>
          <?php "<p>   {$message} </p> "  ?>
        </div>
        <input type="submit" value="login" name="login" />
        <p class="account_status">
          No account ? <span><a href="sign_up.php">Registration</a></span>
        </p>
      </form>
    </div>

    <script src="./assets/js/authentication.js"></script>
  </body>
</html>
