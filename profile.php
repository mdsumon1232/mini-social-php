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
          <img src="./assets/images/images.jpg" alt="">
        </div>
        <div class="profile_img">
          <img src="./assets/images/dummy-author.png" alt="">
        </div>
     
      </div>
      <div class="profile_information">
          <h2>User Name</h2>
          <p>Bio</p>
          <a href="">Edit profile</a>
        </div>
        <hr>
      <div class="create-post">
        <form action="">
          <div>
            <label > Image </label>
            <input type="file" name="" hidden id="picture">
            <label for="picture">Browse</label>
          </div>
        <textarea placeholder="What's on your mind?"></textarea>
        <button>Create Post</button>
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
