<?php 

echo '
<div class="buyer-property-list">
<!-- Search bar -->
<form action="" method="POST">
  <input type="text" name="search" placeholder="Search by property name...">
  <input type="submit" value="Search">
</form>

<div class="container">

';


// Get the current page number
$propertyPage = isset($_GET['propertyPage']) ? (int) $_GET['propertyPage'] : 1;

// Calculate the offset
$offset = ($propertyPage - 1) * 3;

// Connect to the database
include("db-connection.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the search query
  $search = mysqli_real_escape_string($conn, $_POST["search"]);

  // Query to select all properties and relevant information that match the search query
  $sql = "SELECT property.IDProperty, property.property_name, property.property_adress, property.property_valuation, property.sellerID, property.buyerID, property.property_description, photo.*, seller.*
  FROM property
  LEFT JOIN photo 
  ON property.IDProperty = photo.propertyID
  LEFT JOIN seller 
  ON property.sellerID = seller.IDseller
  WHERE property.property_name LIKE '%$search%'
  LIMIT 3
  OFFSET $offset";

  // Execute the query
  $result = mysqli_query($conn, $sql);

  // Check if the query was successful
  if (mysqli_num_rows($result) > 0) {
    // Loop through each property
    while ($row = mysqli_fetch_assoc($result)) {
      $property_name = $row['property_name'];
      $property_valuation = $row['property_valuation'];
      $property_description = $row['property_description'];
      $photo_url = $row['photo_path'];
      $seller_name = $row['seller_name'];
      echo '
        
      <div class="card">
      <div class="card-header">
          <img src="'.$photo_url.'" alt="ballons" />
      </div>
      <div class="card-body">
          <span class="tag tag-purple">Popular</span>
          <h4>
          '.$property_name.'
          </h4>
          
          <p>
              <i class="fa-solid fa-location-pin"></i> '.$property_adress.'
          </p>
          <h4>
              PRICE EST: <b>$ '.$property_valuation.'</b>
          </h4>
          <div class="user">
          <img src="https://lh3.googleusercontent.com/ogw/ADGmqu8sn9zF15pW59JIYiLgx3PQ3EyZLFp5Zqao906l=s32-c-mo" alt="user" />
          <div class="user-info">
              <h5>'.$seller_name.'</h5>
              <small>Seller</small>
          </div>
          <button class="more-info-button">More Info</button>
          </div>
      </div>
      </div>
  
  ';
   
    }
  } else {
    // No properties found
    echo "No properties found.";
  }
} else {
    // Query to select all properties and relevant information
    //   echo("DEFAULT RESULTS");
    $sql = "SELECT property.IDProperty, property.property_name, property.property_adress, property.property_valuation, property.sellerID, property.buyerID, property.property_description, photo.*, seller.*
    FROM property
    LEFT JOIN photo 
    ON property.IDProperty = photo.propertyID
    LEFT JOIN seller 
    ON property.sellerID = seller.IDseller
    LIMIT 3
    OFFSET $offset;";
    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (mysqli_num_rows($result) > 0) {
        // Loop through each property
        while ($row = mysqli_fetch_assoc($result)) {
        $property_name = $row['property_name'];
        $property_adress = $row['property_adress'];
        $property_description = $row['property_description'];
        $property_valuation = $row['property_valuation'];
        $photo_url = $row['photo_path'];
        $seller_name = $row['seller_name'];
        echo '
        
            <div class="card">
            <div class="card-header">
                <img src="'.$photo_url.'" alt="ballons" />
            </div>
            <div class="card-body">
                <span class="tag tag-purple">Popular</span>
                <h4>
                '.$property_name.'
                </h4>
                
                <p>
                    <i class="fa-solid fa-location-pin"></i> '.$property_adress.'
                </p>
                <h4>
                    PRICE EST: <b>$ '.$property_valuation.'</b>
                </h4>
                <div class="user">
                <img src="https://lh3.googleusercontent.com/ogw/ADGmqu8sn9zF15pW59JIYiLgx3PQ3EyZLFp5Zqao906l=s32-c-mo" alt="user" />
                <div class="user-info">
                    <h5>'.$seller_name.'</h5>
                    <small>Seller</small>
                </div>
                <button class="more-info-button">More Info</button>
                </div>
            </div>
            </div>
        
        ';
         }
    } else {
        // No properties found
        echo "No properties found.";
    }
    }

    // Close the connection
    mysqli_close($conn);
    echo '
    </div>
    </div>
    ';

?>
    
