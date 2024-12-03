<?php
session_start();

if(isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    // Initialize the cart if it doesn't exist
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    if(isset($_SESSION['cart'][$product_id])) {
        // If it is, update the quantity
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // If it's not, add the product to the cart
        $_SESSION['cart'][$product_id] = array(
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity
        );
    }

    // Redirect back to the shop page with a success message
    header("Location: index.php?message=Product added to cart");
    exit();
} else {
    // If the form wasn't submitted properly, redirect back to the shop page
    header("Location: index.php");
    exit();
}
?>