<?php 

//Provjerava da li je u URL-u definiran parametar 'page', ako je definiran, onda ga sprema u varijablu $page, ako nije, onda sprema 'home' u varijablu $page 
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}


//Početak osnovne HTML strukture
echo '
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="../Style/style.css">
        <link rel="stylesheet" type="text/css" href="../Style/'.$page.'.css">
        <script src="https://kit.fontawesome.com/ced225e596.js" crossorigin="anonymous"></script>
        <title>DIGITAL ESTATE | '.$page.'</title>
    </head>

    <body>
';

//Uključivanje headera
include("header.php");


//U zavisnosti od vrednosti varijable $page, uključuje se odgovarajući file
switch ($page) {
    case 'home':
        include("home.php");
        break;
    case 'buyer-login':
        include("buyer-login.php");
        break;
    case 'seller-page':
        include("seller-page.php");
        break;
    case 'seller-edit-page':
        include("seller-edit-page.php");
        break;
    case 'seller-login':
        include("seller-login.php");
        break;
    case 'buyer-property-list':
        include("buyer-property-list.php");
        break;
    case 'seller-property-list':
        include("seller-property-list.php");
        break;     
    case 'admin-login':
        include("admin-login.php");
        break;
    default:
        include("home.php");
        break;
}


//Uključivanje footer-a
include("footer.php");

//Kraj osnovne HTML strukture
echo '
    </body>

    </html>
';

?>