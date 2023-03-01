<?php
session_start();

$property_id = $_GET['id'];
if(!($property_id)) {
    echo "Error: no property ID was provided.";
} else {
  echo("Property ID: $property_id");
};

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital-estate";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Get the property information from the database
$sql = "SELECT * FROM property WHERE IDProperty = $property_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Pre-populate the form fields with the property information
$estate_name = $row['property_name'];
$estate_address = $row['property_adress'];
$estate_price = $row['property_valuation'];
$sale_date = $row['sale_deadline'];
$estate_description = $row['property_description'];

// Update the property data in the database
if(isset($_POST['form-submit'])) {
  $new_estate_name = $_POST['estate-name'];
  $new_estate_address = $_POST['estate-address'];
  $new_estate_price = $_POST['estate-price'];
  $new_sale_date = $_POST['sale-date'];
  $new_estate_description = $_POST['property-description'];

  $sql = "UPDATE property SET 
          property_name = '$new_estate_name', 
          property_adress = '$new_estate_address', 
          property_valuation = '$new_estate_price', 
          sale_deadline = '$new_sale_date', 
          property_description = '$new_estate_description' 
          WHERE IDProperty = $property_id";

  if(mysqli_query($conn, $sql)) {
    echo "Property updated successfully!";
    if(isset($_FILES['property-photos'])) {
      $target_dir = "../Assets/RealEstateImages/";
      $file = $_FILES["property-photos"];
      $name  = $_FILES["property-photos"]["name"];
      $tmp_name = $_FILES["property-photos"]["tmp_name"];
      echo("TMP Name".$tmp_name);
      $name_array = explode(".", $name);
        $ext = end($name_array);
      $image_name = "img_" . time() . "." . $ext;
      echo("Image Name: ".$image_name);
      $target_file = $target_dir . $image_name;
      echo("Target File: ".$target_file);
      if ($file["error"] !== UPLOAD_ERR_OK) {
            // Handle the error here
            echo "Error uploading file: " . $file["error"];
        } else {
            // Move the file to the target directory
        //echo("Moving file to target directory");
            if(move_uploaded_file($tmp_name, $target_file)) {
            //echo "File uploaded successfully";
            $sql = "UPDATE photo SET 
                    photo_path = '$target_file' 
                    WHERE propertyID = $property_id";
                if(mysqli_query($conn, $sql)) {
                    echo "Property photo updated successfully!";
                    header('Location: index.php?page=seller-property-list');
                    exit;
                } else {
                    echo "Error updating property photo: " . mysqli_error($conn);
                }
        } else {
          echo "File upload failed";
        }
      }
    }
    header('Location: index.php?page=seller-property-list');
    exit;
  } else {
    echo "Error updating property: " . mysqli_error($conn);
  }

  if(isset($_POST['delete-button'])) {
    // Delete the photos related to the property
    echo "Deleting photos...";
    $sql = "DELETE FROM photo WHERE propertyID = $property_id";
    if(mysqli_query($conn, $sql)) {
      // Delete the property from the database
      echo("Deleting property...");
      $sql = "DELETE FROM property WHERE IDProperty = $property_id";
      if(mysqli_query($conn, $sql)) {
        echo "Property and photos deleted successfully!";
        header('Location: index.php?page=seller-property-list');
        exit;
      } else {
        echo "Error deleting property: " . mysqli_error($conn);
        echo("ERROR!!!!");
      }
    } else {
      echo "Error deleting photos: " . mysqli_error($conn);
      echo("ERROR!!!!");
    }
  }
  

  
}



mysqli_close($conn);

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
		  <form action="#" method="POST" enctype="multipart/form-data">
			<div class="form-group">
			  <label for="estate-name">Estate Name:</label>
			  <input type="text" id="estate-name" name="estate-name" value="' . $estate_name . '" required>
			</div>
			<div class="form-group">
			  <label for="estate-address">Estate Address:</label>
			  <input type="text" id="estate-address" name="estate-address" value="' . $estate_address . '" required>
			</div>
			<div class="form-group">
			  <label for="estate-price">Estate Estimate:</label>
			  <input type="number" id="estate-price" name="estate-price" value="' . $estate_price . '" required>
			</div>
			<div class="form-group">
			  <label for="sale-date">Sale deadline:</label>
			  <input type="date" id="sale-date" name="sale-date" value="' . $sale_date . '" required>
			</div>
			<div class="form-group">
			  <label for="property-photos">Replace photos:</label>
			  <input type="file" name="property-photos" />
			</div>
			<div class="form-group">
			  <label for="property-description">Short description:</label>
			  <textarea id="property-description" name="property-description" minlength="10" required>'. $estate_description .'</textarea>
			</div>
			<button type="submit" id="submit-button" name="form-submit">SAVE CHANGES</button>
      <button type="submit" id="delete-button" name="delete-button">DELETE PROPERTY :(</button>
		  </form>
		</div>
	  </div>
      <form method="post">
      <input class="more-info-button" type="submit" name="back_button_click" value="Back">
      </form>
';


?>