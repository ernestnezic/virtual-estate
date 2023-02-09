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
<div class="edit-property-container">
  <form action="" method="post">
    <div class="form-field">
      <label for="estate-name">Estate Name:</label>
      <input type="text" id="estate-name" name="estate-name" placeholder="Enter estate name">
    </div>
    <div class="form-field">
      <label for="estate-address">Estate Address:</label>
      <input type="text" id="estate-address" name="estate-address" placeholder="Enter estate address">
    </div>
    <div class="form-field">
      <label for="estate-price">Estate Price:</label>
      <input type="text" id="estate-price" name="estate-price" placeholder="Enter estate price">
    </div>
    <div class="form-field">
      <label for="sale-date">Sale Date:</label>
      <input type="date" id="sale-date" name="sale-date" placeholder="Enter sale date">
    </div>
    <div class="form-field">
      <label for="property-photos">Replace Property Photos:</label>
      <input type="file" id="property-photos" name="property-photos" multiple>
    </div>
    <div class="form-field">
      <label for="property-description">Property Description:</label>
      <textarea id="property-description" name="property-description" rows="5" placeholder="Enter property description"></textarea>
    </div>
    <div class="form-field">
      <input type="submit" value="Upload" class="orange-btn">
      <input type="submit" value="Delete Property" class="delete-btn">
    </div>
  </form>
</div>
';

$estate_name = $_POST['estate_name'];
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