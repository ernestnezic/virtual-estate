<?php 

/*
 * SELLER PAGE
*/


//INCLUDES
// include("db-connection.php");


/*
* HTML FORMA PRODAJU / OGLASAVANJE NEKRETNINE
*/

echo '
<div id="container-seller-page">
		<div class="left-div">
		  <h1>PUBLISH YOUR PROPERTY TODAY!</h1>
		  <p>To get listed instantly on one of the biggest real estate sites today!</p>
		  <div class="contact-info">
			<p><i class="fa fa-phone"></i> Phone number</p>
			<p><i class="fa fa-facebook"></i> Facebook</p>
			<p><i class="fa fa-instagram"></i> Instagram</p>
			<p><i class="fa fa-linkedin"></i> LinkedIn</p>
		  </div>
		</div>
		<div class="right-div">
		  <form>
			<div class="form-group">
			  <label for="estate-name">Estate Name:</label>
			  <input type="text" id="estate-name" name="estate-name" required>
			</div>
			<div class="form-group">
			  <label for="estate-address">Estate Address:</label>
			  <input type="text" id="estate-address" name="estate-address" required>
			</div>
			<div class="form-group">
			  <label for="estate-price">Estate Estimate:</label>
			  <input type="number" id="estate-price" name="estate-price" required>
			</div>
			<div class="form-group">
			  <label for="sale-date">Sale deadline:</label>
			  <input type="date" id="sale-date" name="sale-date" required>
			</div>
			<div class="form-group">
			  <label for="property-photos">Upload photos:</label>
			  <input type="file" id="property-photos" name="property-photos" multiple required>
			</div>
			<div class="form-group">
			  <label for="property-description">Short description:</label>
			  <textarea id="property-description" name="property-description" minlength="100" required></textarea>
			</div>
			<button type="submit" id="submit-button">PUBLISH NOW</button>
		  </form>
		</div>
	  </div>
';
 
// $username = $_POST['username'];
// $password = $_POST['password'];

// if (isset($_POST['login'])) {
//     /*
//     * LOGIN KORISNIKA
//     */ 
//     // Check the user's credentials
//     echo($username.' Pass:'.$password);
//     $sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND status='seller'";
//     $result = mysqli_query($conn, $sql);
//     if (mysqli_num_rows($result) > 0) {
//         // Login successful
//         echo 'Login successful';
//         // Start a new session and redirect to the buyer_page
//         //session_start();
//         //$_SESSION['username'] = $username;
//         header("Location: index.php?page=seller-page");
//     } else {
//         echo "Error: incorrect username or password";
//     }

// } else if (isset($_POST['register'])) {
//     /*
//     *  REGISTRACIJA KORISNIKA
//     */
//     // Dohvaćanje podataka iz forme za registraciju POST metodom
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];

//     // Provjera da li korisničko ime već postoji
//     $sql = "SELECT * FROM user WHERE username = '$username'";

//     $result = mysqli_query($conn, $sql);

//     // Ako korisničko ime već postoji, prikazuje grešku
//     if (mysqli_num_rows($result) > 0) {
//       echo "Error: username already exists";
//     } else {
//       // Stvaranje novog usera i učitavanje njegovih podataka u bazu
//       $sql = "INSERT INTO user (username, email, password, status) VALUES ('$username', '$email', '$password', 'seller')";
//       $result = mysqli_query($conn, $sql);
//       echo("User created successfully");

//       // Dohvaćanje ID-a novog usera
//       $userID = mysqli_insert_id($conn);

//       // Stvaranje novog buyer-a i učitavanje njegovih podataka u bazu
//       $sql = "INSERT INTO seller (userID, seller_name, seller_phone) VALUES ('$userID', '$name', '$phone')";
//       $result = mysqli_query($conn, $sql);

//       if ($result) {
//         echo "New user and buyer created successfully";
//       } else {
//         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//       }
//     }

//     // Zaustavljanje konekcije
//     mysqli_close($conn);  
// }



?>