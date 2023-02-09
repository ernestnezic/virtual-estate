<?php

//INCLUDES
include("db-connection.php");

echo '
<div class="container">
  <form method="POST" action="">
    <h2>Admin Login</h2>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

 ';

$username = $_POST['username'];
$password = $_POST['password'];

/*
* LOGIN ADMINA
*/ 
// Check the user's credentials
$sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND status='admin'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // Login successful
    echo 'Login successful';
    // Start a new session and redirect to the buyer_page
    //session_start();
    //$_SESSION['username'] = $username;
    header("Location: index.php?page=admin-page");
} else {
    echo "Error: incorrect username or password";
}


?>