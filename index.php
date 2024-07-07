<?php
  require('./assets/php/connect.php');
  session_start();
  if(empty($_SESSION['user'])){
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
    <!-- font-awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                <li><a href="#write-post">Write Post</a></li>
                <li>
                    <a href="#profile">Profile</a>
                    <ul class="profile_child">
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="#settings">Settings</a></li>
                        <li><a href="logOut.php">Log Out</a></li>
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

    <div style="margin-top: 80px;"></div>

    <main>
        <div class="posts">
            <?php 
                $select_post = "SELECT * FROM post";
                $query = $conn->query($select_post);

                // Comment section
                if(isset($_POST['submit'])){
                    $comment = $_POST['comment'];
                    $post_id = $_POST['post_id'];
                    $user_id = $_SESSION['user']['user_id'];

                    if(!empty($comment)){
                        $insert_data = "INSERT INTO comment (comment, post_id, cmt_user_id)
                                        VALUES ('$comment', '$post_id', '$user_id')";
                        $conn->query($insert_data);   
                    }
                }

                while($fetch = mysqli_fetch_array($query)) {
                    $post_id = $fetch['post_id'];
                    $article = $fetch['article'];
                    $image = $fetch['image'];
                    $user_id = $fetch['user_id']; 
                    $post_at = $fetch['post_at'];
                    $find_user = "SELECT * FROM user WHERE user_id = '$user_id'";
                    $user_query = $conn->query($find_user);
                    $fetch_user = mysqli_fetch_array($user_query);
                    $user_profile = $fetch_user['profile'];
                    $first_name = $fetch_user['first_name'];
                    $last_name = $fetch_user['last_name'];
                    $full_name = $first_name . " " . $last_name;
                    $user_profile_image = isset($user_profile) && !empty($user_profile) ? $user_profile : './assets/images/dummy-author.png';
                    $post_date = date_create($post_at);
                    $date_of_post = date_format($post_date, "d M Y");

                    echo "
                    <div class='post'>
                        <div class='post-header'>
                            <img src='$user_profile_image' alt=''>
                            <div>
                                <div class='post-author'>$full_name</div>
                                <div class='post-time'>$date_of_post</div>
                            </div>
                        </div>
                        <div class='post-content'>
                            <p>$article</p>
                            <div class='photo'>";
                    if (isset($fetch['image'])) {
                        echo "<img src='{$fetch['image']}' alt='post'>";
                    }
                    echo "</div>
                        </div>
                        <div class='post-footer'>";

                    // Fetch comments for this post
                    $select_comments = "SELECT * FROM comment WHERE post_id = '$post_id'";
                    $comment_query = $conn->query($select_comments);
                    while($comment_fetch = mysqli_fetch_array($comment_query)) {
                        $comment_text = $comment_fetch['comment'];
                        $user_id = $comment_fetch['cmt_user_id'];
                        
                        $select_comment_user = "SELECT * FROM user  WHERE user_id='$user_id'";
                        $select_user_query= $conn->query($select_comment_user);
                        $fetch_user = mysqli_fetch_array($select_user_query);
                       $comment_user_profile =  isset($fetch_user['profile']) && !empty($fetch_user['profile']) ? $fetch_user['profile'] : './assets/images/dummy-author.png';
                    
                        echo "
                        <div class='comment'>
                            <img src='$comment_user_profile' alt='Commenter Image'>
                            <div class='comment-text'>$comment_text</div>
                        </div>";
                    }

                    echo "
                            <form class='comment-input' action='index.php' method='post'>
                                <input type='text' name='comment' placeholder='Add a comment...'>
                                <input type='text' value='$post_id' name='post_id' hidden>
                                <button type='submit' name='submit'>Add Comment</button>
                            </form>
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
