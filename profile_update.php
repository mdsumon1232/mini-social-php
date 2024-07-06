
<?php
 require('./assets/php/connect.php');

 
 


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
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="profile">Profile Picture:</label>
                <input type="file" id="profile" name="profile" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="cover">Cover Photo:</label>
                <input type="file" id="cover" name="cover" accept="image/*" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
