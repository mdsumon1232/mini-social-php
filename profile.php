<?php
  
  session_start();
  require('./assets/php/connect.php');

  $user_id = $user = $first_name = $last_name = $bio = $profile = $cover = "";

  if(isset($_SESSION['user'])){
     $user = $_SESSION['user'];
     $user_id = $user['user_id'];
     $bio = $user['bio'];
     $first_name = $user['first_name'];
     $last_name = $user['last_name'];
     $cover = $user['cover'];
     $profile = $user['profile'];
      
  }

  else{
    header('location:login.php');
  }


// create post data 

 if(isset($_POST['post'])){
  $article  = $_POST['article'];
  $image_name = $_FILES['image']['name'];
  $tmp_name = $_FILES['image']['tmp_name'];

  $folder = "./assets/images/". $image_name;
  
  $user_id = $_SESSION['user']['user_id'];

  if($image_name){
    $insert_data = "INSERT INTO post (	article ,	user_id, image)
                     VALUES ('$article' , '$user_id' , '$folder')";
    $conn-> query($insert_data);
  
  }
  else{
    $insert_data = "INSERT INTO post (	article ,	user_id)
                     VALUES ('$article' , '$user_id')";
    $conn -> query($insert_data);
  }


 }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Page</title>
    <link rel="stylesheet" href="./assets/css/profile.css" />
  </head>
  <body>
    <div class="container"> 
      <div class="top_header">
        <div class="cover">
          <img src="<?php  echo !empty($cover) ? $cover : './assets/images/images.jpg' ; ?>" alt="">
        </div>
        <div class="profile_img">
          <img src="<?php  echo !empty($profile) ? $profile : './assets/images/dummy-author.png' ; ?>" alt="">
        </div>
     
      </div>
      <div class="profile_information">
          <h2><?php echo $first_name . " " .$last_name  ?></h2>
          <p><?php  echo !empty($bio) ? $bio : "BIO" ?></p>
          <a href="<?php echo './profile_update.php?id='.$id ?>">Edit profile</a>
        </div>
        <hr>
      <div class="create-post">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
          <div class="file_container">
            <label class="field_name"> Image </label>
            <input type="file" name="image" hidden id="picture">
            <label for="picture" class="input_label">Browse</label>
          </div>
        <textarea placeholder="What's on your mind?" name="article"></textarea>
        <button type="submit" name="post">Create Post</button>
        </form>
      </div>
      <div class="posts">
        <div class="post">
          <h2>Post Title</h2>
          <p>Post content goes here...</p>
        </div>
        <div class="post">
          <h2>Post Title</h2>
          <p>Post content goes here...</p>
        </div>
      </div>
    </div>
  </body>
</html>
