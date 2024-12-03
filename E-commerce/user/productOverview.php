<?php

include "connect_database.php";
// session_start();

// Fetch all categories
$sql_category = "SELECT * FROM category";
$results_category = mysqli_query($conn, $sql_category);

// Initialize the WHERE clause
$where_clause = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['categories']) && is_array($_POST['categories'])) {
        $selected_categories = array_map(function($cat) use ($conn) {
            return "'" . mysqli_real_escape_string($conn, $cat) . "'";
        }, $_POST['categories']);
        $where_clause = "WHERE category IN (" . implode(",", $selected_categories) . ")";
    }
}

// Fetch products based on filter
$sql = "SELECT * FROM product_details $where_clause";

$results = mysqli_query($conn, $sql);




?>


<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../user/CSS/productpreview.css">
    <style>
        .description{
    /* background-color: gray; */
    width: 500px;
    /* height: 400px; */
    padding: 15px;
    
}
    </style>
</head>
<body>
<?php require 'navbar.php'; 
require 'loader.php'?>

<div class="mainContainer">
    <div class="productImageSection">

    <?php
include "connect_database.php";
if (isset($_GET['SNO'])) {
    $SNO = $_GET['SNO'];

    // Fetch the image path from the database
    $query = "SELECT product_image FROM product_details WHERE SNO = $SNO";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = "../user/product-Source/" . $row['product_image'];

        // Return the image path
        echo "<img src='" . $imagePath . "'/>";
    } else {
        // If no image is found, return a placeholder
        echo "../images/default.jpg";
    }
}
mysqli_close($conn);
?>


    </div>
    <div class="productDetails">
        <div class="productName">
    <?php
include "connect_database.php";
if (isset($_GET['SNO'])) {
    $SNO = $_GET['SNO'];

    // Fetch the image name from the database
    $query = "SELECT product_name FROM product_details WHERE SNO = $SNO";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imageName =  $row['product_name'];

        // Return the image name
        echo "<p>$imageName</p>";
    } else {
        // If no name is found, return a placeholder
        echo "No Title Avilable";
    }
}
mysqli_close($conn);
?>
</div>
<div class="writerName">
<?php
include "connect_database.php";
if (isset($_GET['SNO'])) {
    $SNO = $_GET['SNO'];

    // Fetch the image path from the database
    $query = "SELECT writer_name FROM product_details WHERE SNO = $SNO";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $writerName =  $row['writer_name'];

        // Return the writer name name
        echo "<p>Written by : $writerName </p>";
    } else {
        // If no writer name  found, return a placeholder
        echo "UnKnown";
    }
}
mysqli_close($conn);
?>
</div>
<div class="category">
<?php
include "connect_database.php";
if (isset($_GET['SNO'])) {
    $SNO = $_GET['SNO'];

    // Fetch the image path from the database
    $query = "SELECT category FROM product_details WHERE SNO = $SNO";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $category=  $row['category'];

        echo "<p> Category :  $category </p>";
    } else {
        // If no description found, return a placeholder
        echo "No category Avilable";
    }
}
mysqli_close($conn);
?>
</div>
<div class="productPrice">
<?php
include "connect_database.php";
if (isset($_GET['SNO'])) {
    $SNO = $_GET['SNO'];

    // Fetch the  price from the database
    $query = "SELECT product_price FROM product_details WHERE SNO = $SNO";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $productPrice =  $row['product_price'];

        // Return the price
        echo "<p><sup style='font-size: 20px;'>₹</sup>".$productPrice."</p>";
    } else {
        // If no price is found, return a placeholder
        echo "Unavilable";
    }
}
mysqli_close($conn);
?>
</div>
<div class="description">
<?php
include "connect_database.php";
if (isset($_GET['SNO'])) {
    $SNO = $_GET['SNO'];

    // Fetch the image path from the database
    $query = "SELECT description FROM product_details WHERE SNO = $SNO";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $description =  $row['description'];

        // Return the image name
        echo "<h3>About this Item : </h3>";
        echo "<p> $description </p>";
    } else {
        // If no description found, return a placeholder
        echo "No description Avilable";
    }
}

mysqli_close($conn);
?>
</div>
<div class="more-button">
<a href='addtocart.php'><button class='add-to-cart' id="btn">Add to Cart</button></a>;
<a href='checkout.php'><button class='buy-now'id="btn">Buy Now</button></a>;
</div>
    </div>
</div>

<div class="recommend">
<h1 style="background-color: black; color: aliceblue;">Recommended Books : </h1>
</div>

<div class="recommendation">
<div class="product-section">

<?php
include 'connect_database.php'; // Make sure to include the database connection

if (isset($_GET['SNO'])) {
    $SNO = $_GET['SNO'];

    // Fetch product details including category using SNO
    $query = "SELECT * FROM product_details WHERE SNO = $SNO";
    $result = mysqli_query($conn, $query);

    // Check if the product with the given SNO exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch the row

        // Fetch the category from the current product row
        $category = $row['category'];

        // Now display the current product details
        // echo "<div class='product'>";
        // echo "<img src='../user/product-Source/" . $row['product_image'] . "' alt='" . $row['product_name'] . "' />";
        // echo "<p style='font-size: 28px; font-weight: 600; color: #292929;'><sup>₹</sup>" . $row['product_price'] . "</p>";
        // echo "<h2 style='font-weight: 500; color: #212020;'>" . $row['product_name'] . "</h2>";
        // echo "<p>Category: " . $row['category'] . "</p>";
        // echo "<button class='btn' onclick=\"window.location.href='productOverview.php?SNO=" . $row['SNO'] . "'\">
        //       <i class='fa-solid fa-eye' style='color: #000000;'> Preview</i>
        //       </button>";
        // echo "</div>";

        // Fetch other products that have the same category
        $related_query = "SELECT * FROM product_details WHERE category = '$category' AND SNO != $SNO"; // Exclude the current product
        $related_result = mysqli_query($conn, $related_query);

        if (mysqli_num_rows($related_result) > 0) {
            while ($related_row = mysqli_fetch_assoc($related_result)) {
                echo "<div class='product'>";
                echo "<img src='../user/product-Source/" . $related_row['product_image'] . "' alt='" . $related_row['product_name'] . "' />";
                echo "<p style='font-size: 28px; font-weight: 600; color: #292929;'><sup>₹</sup>" . $related_row['product_price'] . "</p>";
                echo "<p>Category: " . $related_row['category'] . "</p>";
                echo "<h2 style='font-weight: 500; color: #212020;'>" . $related_row['product_name'] . "</h2>";
                echo "<button class='btn' onclick=\"window.location.href='productOverview.php?SNO=" . $related_row['SNO'] . "'\">
                      <i class='fa-solid fa-eye' style='color: #000000;'> Preview</i>
                      </button>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "<p style='font-size: 20px; color: #fff;'>No other products found in this category.</p>";
        }
    } else {
        echo "<p style='font-size: 25px; color: #fdee42;'>No Products Available.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
</div>

</div>
    
</body>
</html>