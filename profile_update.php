
<?php
 session_start();
 require('./assets/php/connect.php');
  $bio_length = "";

if(!isset($_SESSION['user'])){
    header('location:login.php');
}


  $id = $_GET['id'];

  $select_data = "SELECT * FROM user WHERE user_id = '$id'";
   $query = $conn -> query($select_data);

   $fetch = mysqli_fetch_array($query);

   $first_name = $fetch['first_name'];
   $last_name = $fetch['last_name'];

 
// receive data from form

if(isset($_POST['submit'])){
    $user_id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $bio = $_POST['bio'];
    $profile_name = $_FILES['profile']['name'];
    $profile_tmp = $_FILES['profile']['tmp_name'];
    $cover_name = $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];
    
    $profile_folder = "./assets/images/". $profile_name;
    move_uploaded_file($profile_tmp , $profile_folder);

    $cover_folder = "./assets/images/".$cover_name;
    move_uploaded_file($cover_tmp , $cover_folder);

   if(strlen($bio) > 100){
        $bio_length = "100 character only";
   }
   else{
    $update_data = "UPDATE user SET first_name = '$first_name' , last_name = '$last_name' , profile = '$profile_folder' , cover = '$cover_folder' , 	bio = '$bio'
    WHERE user_id = '$user_id' ";
   
  $query = $conn -> query($update_data);
   
  if($query){
    header('location:profile.php?update=success');
  }
  else{
    echo "something wrong";
  }
    
}


    
   

}
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link rel="stylesheet" href="./assets/css/profile_update.css">
</head>
<body>
    <div class="container">
        <h2>Update Profile</h2>
        <form action="<?php  $_SERVER['PHP_SELF'] ; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $first_name ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $last_name ?>" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="4" required></textarea>
                <?php echo isset($_POST['submit']) ? $bio_length : "";  ?>
            </div>
            <div class="form-group">
                <label for="profile">Profile Picture:</label>
                <input type="file" id="profile" name="profile" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="cover">Cover Photo:</label>
                <input type="file" id="cover" name="cover" accept="image/*" required>
            </div>
            <input type="text" name="id" hidden value="<?php echo $id ?>" >
            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
