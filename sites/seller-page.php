<?php 

session_start();



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
		  <form action="#" method="POST">
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
      <form method="post">
      <input class="more-info-button" type="submit" name="back_button_click" value="Back">
      </form>
';


//Back Button
if (isset($_POST['back_button_click'])) {
    header('Location: index.php?page=seller-login.php');
    exit;
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital-estate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$estate_name = $_POST['estate-name'];
$estate_address = $_POST['estate-address'];
$estate_price = $_POST['estate-price'];
$sale_date = $_POST['sale-date'];
$estate_description = $_POST['property-description'];
// echo("Estate Address: ".$estate_address);
// echo("Estate Price: ".$estate_price);
// echo("Estate Deadline: ".$estate_deadline);
// echo("Estate Description: ".$estate_description);


// Get the current user's username
$seller_username = $_SESSION['username'];
echo('Seller Username: '.$seller_username);

// Get the sellerID of the current user
$sql = "SELECT s.IDseller FROM seller s
        JOIN user u ON s.userID = u.IDuser
        WHERE u.username = '$seller_username'";
$result = mysqli_query($conn, $sql);
$seller = mysqli_fetch_assoc($result);
$sellerID = $seller['IDseller'];
echo('Seller ID: '.$sellerID);
echo($estate_deadline);
// Insert the property data into the property table
$sql = "INSERT INTO property (property_name, property_valuation, property_adress, sale_deadline, sellerID, property_description)
        VALUES ('$estate_name', '$estate_price', '$estate_address', '$sale_date', '$sellerID', '$estate_description')";

if (mysqli_query($conn, $sql)) {
    $propertyID = mysqli_insert_id($conn); // Get the propertyID of the inserted property
    $target_dir = "../Assets/RealEstateImages/";
    $image_name = $propertyID . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $relative_path = "../Assets/RealEstateImages/" . $image_name;

    // Insert the photo data into the photo table
    $sql = "INSERT INTO photo (propertyID, photo_path)
            VALUES ('$propertyID', '$relative_path')";
    mysqli_query($conn, $sql);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>




