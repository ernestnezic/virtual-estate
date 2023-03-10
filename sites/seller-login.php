<?php 
session_start();
/*
 * SELLER REGISTER FORMA
*/


//INCLUDES
include("db-connection.php");

/*
* HTML FORMA ZA REGISTRACIJU / LOGIN KORISNIKA
*/

echo '
<div class="buyer-login">
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form method="POST" action="">
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your email for registration</span>
      <input type="text" name="name" placeholder="Name" />
			<input type="text" name="username" placeholder="Username" />
      <input type="email" name="email" placeholder="Email" />
      <input type="password" name="password" placeholder="Password" />
			<input type="text" name="phone" placeholder="Phone" />
			<button type="submit" name="register">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form method="POST" action="">
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span>
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<a href="#">Forgot your password?</a>
			<button type="submit" name="login">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script src="../JS/buyer-seller-login.js"></script>
</div>
';
 
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST['login'])) {
    /*
    * LOGIN KORISNIKA
    */ 
    // Check the user's credentials
    echo($username.' Pass:'.$password);
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND status='seller'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Login successful
        echo 'Login successful';
        // Start a new session and redirect to the buyer_page
        
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php?page=seller-property-list");
    } else {
        echo "Error: incorrect username or password";
        $_SESSION['login'] = false;
    }

} else if (isset($_POST['register'])) {
    /*
    *  REGISTRACIJA KORISNIKA
    */
    // Dohva??anje podataka iz forme za registraciju POST metodom
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Provjera da li korisni??ko ime ve?? postoji
    $sql = "SELECT * FROM user WHERE username = '$username'";

    $result = mysqli_query($conn, $sql);

    // Ako korisni??ko ime ve?? postoji, prikazuje gre??ku
    if (mysqli_num_rows($result) > 0) {
      echo "Error: username already exists";
    } else {
      // Stvaranje novog usera i u??itavanje njegovih podataka u bazu
      $sql = "INSERT INTO user (username, email, password, status) VALUES ('$username', '$email', '$password', 'seller')";
      $result = mysqli_query($conn, $sql);
      echo("User created successfully");

      // Dohva??anje ID-a novog usera
      $userID = mysqli_insert_id($conn);

      // Stvaranje novog buyer-a i u??itavanje njegovih podataka u bazu
      $sql = "INSERT INTO seller (userID, seller_name, seller_phone) VALUES ('$userID', '$name', '$phone')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo "New user and buyer created successfully";
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php?page=seller-property-list");
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

    // Zaustavljanje konekcije
    mysqli_close($conn);  
}



?>