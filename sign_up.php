<?php
session_start();
if(isset($_SESSION['user'])){
    header('location:index.php');
}
require('./assets/php/connect.php');

$message = "";

if(isset($_POST['signup'])){
 
  			
  $first_name = $_POST['firstName'];
  $last_name = $_POST['lastName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
   
if(strlen($password) < 6){
    $message ="password must be 6 character";
}
else{
    if(empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password) ){
        $message = "Fill all the flied"; 
      }

  
      else{ 

        $select_data = "SELECT * FROM user WHERE email = '$email'";
        $query = $conn -> query($select_data);
 
        if($query -> num_rows > 0){
         $message =  "Email already used";
        }
        else{
 
            $encrypt_password = password_hash($password , PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO user (first_name , last_name , email , password)
                          VALUES (?, ?, ?, ?)");
       if($stmt){
           $stmt->bind_param("ssss", $first_name, $last_name, $email, $encrypt_password);
           if($stmt->execute()){
               header('location:login.php?status=success');
           }else{
               echo $stmt->error;
           }
       }
        }
      }
    
}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./assets/css/signup.css">
</head>
<body>
    <div class="container">
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="form">
            <h2>Sign Up</h2>
            <div class="form-items">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="First Name">
            </div>
            <div class="form-items">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Last Name">
            </div>
            <div class="form-items">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@gmail.com">
            </div>
            <div class="form-items">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password">
            </div>
            <div class="form-items">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password">
            </div>
            <div>
              <?php  echo "<P>". $message . "</p> " ?>
            </div>
            <input type="submit" value="Sign Up" name="signup">
            <p>Have a account <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
