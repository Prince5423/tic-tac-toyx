<?php

include "db.php";
include "header.php";

if(!isset($_SESSION["uid"])){
    header("location:index.php");
}

// Fetch user information from the database
$user_id = $_SESSION["uid"];
$query = "SELECT * FROM user_info WHERE user_id='$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update user information
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $mobile = $_POST["mobile"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];

    // Hash the password if it has been changed
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $update_query = "UPDATE user_info SET first_name='$first_name', last_name='$last_name', email='$email', password='$password', mobile='$mobile', address1='$address1', address2='$address2' WHERE user_id='$user_id'";
    } else {
        $update_query = "UPDATE user_info SET first_name='$first_name', last_name='$last_name', email='$email', mobile='$mobile', address1='$address1', address2='$address2' WHERE user_id='$user_id'";
    }

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Profile updated successfully!');</script>";
        // Reload user data
        $query = "SELECT * FROM user_info WHERE user_id='$user_id'";
        $result = mysqli_query($con, $query);
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Failed to update profile. Please try again.');</script>";
    }
}
?>

<div class="container">
    <h2>Edit Profile</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
        </div>
        <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" required>
        </div>
        <div class="form-group">
            <label for="address1">Address Line 1:</label>
            <input type="text" class="form-control" id="address1" name="address1" value="<?php echo $user['address1']; ?>" required>
        </div>
        <div class="form-group">
            <label for="address2">Address Line 2:</label>
            <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $user['address2']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<?php
include "footer.php";
?>
