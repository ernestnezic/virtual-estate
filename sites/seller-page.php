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
 
$estate_name = $_POST['estate-name'];
$estate_address = $_POST['estate-address'];
$estate_price = $_POST['estate-price'];
$sale_date = $_POST['sale-date'];
$photos = $_FILE['property-photos'];
$description = $_POST['property-description'];

$sql = "INSERT INTO property (estate_name, estate_address, estate_price, sale_date, photos, description) VALUES ('$estate_name', '$estate_address', '$estate_price', '$sale_date', '$photos', '$description')";
$result = mysqli_query($conn, $sql);
echo("User created successfully");

// Zaustavljanje konekcije
mysqli_close($conn); 



?>