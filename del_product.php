<?php
include 'connectToDb.php';

if (isset($_GET)) {
    $id = $_GET['delid'];
    $del_query = "DELETE FROM products WHERE id=$id";

    if ($conn->query($del_query) === true) {
        header('location:manage_products.php');
    } else {
        echo "Error: " . $del_query . "<br>" . $conn->error;
    }
}