<?php
include 'connect_database.php';

session_start();

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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Second Self</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../user/CSS/style.css">
    <style>

    .container {
            display: flex;
            flex-direction: column;
        }
        .sidebar {
            display: flex;
            flex-direction: column;
            width: 250px;
            padding: 20px;
            background-color: rgb(255 189 89);
            transition: all 0.3s ease;
            color: black;
            border-radius: 10px;
            margin-left: 10px;
        }
        .sidebar.closed {
            width: 0;
            padding: 0;
            overflow: hidden;
        }
        .sidebar form {
            display: flex;
            flex-direction: column;
        }
        .sidebar .checkbox {
            margin-bottom: 10px;
        }
        .sidebar button[type="submit"] {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #fdee42;
            color: black;
            border: none;
            cursor: pointer;
        }
        .section2 {
            flex-grow: 1;
            padding: 20px;
        }
        .toggle-sidebar {
            display: none;
            background-color: #ec920c;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .apply{
            width: 200px;
            border: 1px solid rgb(53 74 66);
            border-radius: 15px;
            margin: auto;
            height: 40px;
        }
        input[type = "checkbox"]{
                width: 20px;
                height: 20px;
            }
        @media (max-width: 768px) {
            .main {
                flex-direction: column;
            }
            .sidebar {
                width: 90%;
                margin: auto;
                display: flex;
                flex-direction: column;
            }
            .sidebar form{
                display: flex;
                flex-wrap: wrap;
            }
            input[type = "checkbox"]{
                width: 20px;
                height: 20px;
            }
            .toggle-sidebar {
                display: block;
            }
            .filter--category{
                display: grid;
                grid-template-columns: repeat(3, 1fr);
            }
            .filter--category .checkbox{
                display: flex;
                gap: 10px;
            }
            .apply{
                width: 300px;
                border-radius: 15px;
                margin: auto;
                height: 40px;
                border: 1px solid rgb(53 74 66);
            }
        }
    </style>
</head>
<body>
    <?php 
    include 'loader.php';
    ?>
    
    <div class="container">
    <nav class="navbar">
            <div class="res-nav">
                <div class="logo">Second Shelf <sup style="font-size: 10px;"><i class="fa-solid fa-trademark" style="color: rgb(255 189 89);"></i></sup>.</div>
                <div class="search" id="search-bar">
                    <form class="d-flex" role="search">
                        <input class="form-control" type="search" placeholder="Search for Product" aria-label="Search" name =" search">
                        <button class="btn btn-outline-success" type="button" id="search-icon">
                            <i class="fa-solid fa-magnifying-glass" style="color: #0d0d0d;"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="menu-toggle" id="menu-toggle">
                <i class="fa-solid fa-bars" style="color: rgb(255 189 89);"></i>
            </div>
            <div class="links" id="navbar-links">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"><i class="fa-solid fa-bag-shopping" style="color: rgb(255 189 89);"></i>Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="addtocart.php"><i class="fa-solid fa-cart-shopping" style="color: rgb(255 189 89);"></i>Cart</a>
                </li>
            </div>
        </nav>
        <div class="upper--img">
            <img src="../user/product-Source/banner.png" alt="THIS IS DANGROUS KID GO BACK">

                    
        </div>
        
        <div class="main">
            <div class="sidebar">
                <p style="font-weight: 500; height: 60px; font-size: 25px; text-align: center;" >Filter Category</p>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="filter--category">
                    <?php
                        while($category = mysqli_fetch_assoc($results_category)){
                            $cat_name = htmlspecialchars($category['category']);
                            $checked = isset($_POST['categories']) && in_array($category['category'], $_POST['categories']) ? 'checked' : '';
                            echo "
                            <div class='checkbox'>
                                <input type='checkbox' name='categories[]' value='$cat_name' id='$cat_name' $checked>
                                <label for='$cat_name'>$cat_name</label>
                            </div>";
                        }
                        ?>
                    </div>
                    <button type="submit" class="apply">Apply Filters</button>
                </form>
            </div>

            <div class="section2">
                <div class="product-section">
                    <?php
                    if(mysqli_num_rows($results) > 0) {
                        while($row = mysqli_fetch_assoc($results)) {
                            // echo"<i class='fa-solid fa-eye' id='preview' style='color: #000000; position: absolute; font-size: 25px; margin-left: 20px; margin-top: 20px; cursor:pointer; '></i>";
                            echo "<div class='product'>";
                            echo "<img src='../user/product-Source/" . $row['product_image']. "' alt='" . $row['product_name'] . "' />";
                            echo "<p style='font-size: 28px; font-weight: 600; color: #292929;'><sup>₹</sup>" . $row['product_price']. "</p>";
                            echo "<h2 style= ' font-weight: 500; color: #212020;'>" . $row['product_name'] . "</h2>";
                            echo "<p>Category: " . $row['category']. "</p>";
                            // echo "<a href='addtocart.php'><button class='add-to-cart'>Add to Cart</button></a>";
                            // echo "<a href='checkout.php'><button class='buy-now'>Buy Now</button></a>";
                            echo "<button class='btn' onclick=\"window.location.href='productOverview.php?SNO=" . $row['SNO'] . "'\">
            <i class='fa-solid fa-eye' style='color: #000000;'> Preview</i>
          </button>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p style = ' font-size: 25px; color: #fdee42; '>No Products Available.</p>";
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    <!-- </div> -->

</body>
</html>