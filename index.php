<?php
  require('./assets/php/connect.php');
 session_start();
 if(!isset($_SESSION['user'])){
    header('location:login.php');
 }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/nav.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/post.css">
    <!--  font-awesomeicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <!--  font-awesomeicon -->
    <title>Responsive Navbar</title>
</head>
<body>
    <nav class="navbar">
        <div class="upper-nav">
            <div class="brand">SocialMedia</div>

            <button class="toggle-button" onclick="toggleMenu()">☰</button>
        </div>
        <div class="menu" id="navbarMenu">
           <ul>
           <li><a href="#home">Home</a></li>
            <li><a href="#home">Write Post</a></li>
           <li>
            <a href="#profile">Profile </a>
            <ul class="profile_child">
                <li><a href="profile.php">profile</a></li>
                <li><a href="">setting</a></li>
                <li><a href="">log out</a></li>
               </ul>
            
</li>
            <li><a href="#report">Report Us</a></li>
           </ul>
      

            <div class="search-container">
                <input type="text" placeholder="Search..." class="search-bar">
                <button class="search-button">🔍</button>
            </div>
        </div>
    </nav>

    <div style="margin-top: 80px;">

    </div>

    <main>

        <div class="posts">


     <?php 
 
        $select_post = "SELECT * FROM post";
        $query = $conn->query($select_post);
   

      while( $fetch = mysqli_fetch_array($query) ){
      
      $article = $fetch['article'];
      $image = $fetch['image'];
      $user_id = $fetch['user_id']; 
      $post_at = $fetch['post_at'];
      $find_user = "SELECT* FROM user WHERE  user_id = '$user_id'";
      $user_query = $conn->query($find_user);
      $fetch_user = mysqli_fetch_array($user_query);
      $user_profile = $fetch_user['profile'];
      $first_name =  $fetch_user['first_name'];
      $last_name =  $fetch_user['last_name'];
      $full_name = $first_name . " " . $last_name;

      $user_profile_image = isset($user_profile) && !empty($user_profile) ? $user_profile : './assets/images/dummy-author.png';
    
      $post_date = date_create($post_at);
      $date_of_post =  date_format($post_date,"d M Y ");


      echo "
      <div class='post'>
          <div class='post-header'>
          <img src='$user_profile_image' alt=''>
            <div>
                  <div class='post-author'>$full_name</div>
                  <div class='post-time'> $date_of_post </div>
              </div>
          </div>
          <div class='post-content'>
              <p>{$article}</p>
              <div class='photo'>";
      if (isset($fetch['image'])) {
          echo "<img src='{$fetch['image']}' alt='post'>";
      }
      echo "</div>
          </div>
          <div class='post-footer'>
              <div class='comment'>
                  <img src='./assets/images/dummy-author.png' alt='Commenter Image'>
                  <div class='comment-text'>This is an example comment.</div>
              </div>
              <div class='comment'>
                  <img src='./assets/images/dummy-author.png' alt='Commenter Image'>
                  <div class='comment-text'>This is another example comment.</div>
              </div>
              <div class='comment-input'>
                  <input type='text' placeholder='Add a comment...'>
                  <button>Add Comment</button>
              </div>
          </div>
      </div>";
      }

          
     ?>
         

           

        </div>

        <div class="some-users">
            
                <h2>Users</h2>
                <div class="user-item">
                    <img src="./assets/images/dummy-author.png" alt="User Image">
                    <div class="user-name">Alice Smith</div>
                </div>
                <div class="user-item">
                    <img src="./assets/images/dummy-author.png" alt="User Image">
                    <div class="user-name">Bob Johnson</div>
                </div>
                <div class="user-item">
                    <img src="./assets/images/dummy-author.png" alt="User Image">
                    <div class="user-name">Charlie Brown</div>
                </div>
                <div class="user-item">
                    <img src="./assets/images/dummy-author.png" alt="User Image">
                    <div class="user-name">Charlie Brown</div>
                </div>
                <div class="user-item">
                    <img src="./assets/images/dummy-author.png" alt="User Image">
                    <div class="user-name">Charlie Brown</div>
                </div>
                <div class="user-item">
                    <img src="./assets/images/dummy-author.png" alt="User Image">
                    <div class="user-name">Charlie Brown</div>
                </div>
                <div class="user-item">
                    <img src="./assets/images/dummy-author.png" alt="User Image">
                    <div class="user-name">Charlie Brown</div>
                </div>
                <!-- Add more users as needed -->
            
        </div>

    </main>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('navbarMenu');
            menu.classList.toggle('active');
            menu.classList.add('menuTrans');
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
