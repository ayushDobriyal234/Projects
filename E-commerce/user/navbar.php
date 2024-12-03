<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: rgb(53 74 66);
} */
nav {
    background-color: rgb(53 74 66);
    display: flex;
    flex-direction: column;
    padding: 10px 20px;
    justify-content: space-evenly;
    position: sticky;
    width: 100%;
}

.res-nav{
    top: 0;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo {
    display: flex;
    color: rgb(255 189 89);
    font-weight: 700;
    font-size: 22px;
    width: 30%;
}

.menu-toggle {
    cursor: pointer;
    display: none; /* Hidden on larger screens */
}

.links {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 50px ;
    list-style: none;
    margin-top: 10px;
    padding: 30px;
}

.links li, .links a {
    color: rgb(255 189 89);
    text-decoration: none;
    font-size: 18px;
    cursor: pointer;
    /* text-align: center; */
}
/* .links a:hover{
    border-bottom: 1px #ec920c;
} */

.links a i {
    margin-right: 10px;
    /* color: rgb(255 189 89); */
}

.search form {
    display: flex;
    margin-top: 10px;
    justify-content: flex-end;
    min-width: 70%;
    gap: 10px;
}

.search input {
    padding: 10px;
    min-width: 350px;
    border-radius: 10px;
    border: 1px solid #fdee42;
    
}

.search input::placeholder {
    color: black;
}

.search button {
    padding: 10px;
    width: 50px;
    border-radius: 10px;
    border: 1px solid rgb(0, 0, 0);
    background-color: white;
    cursor: pointer;
}
    </style>
</head>
<body>

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

</body>
</html>