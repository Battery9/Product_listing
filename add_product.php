<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}

if (!$_SESSION['admin']) {
    header("location:index.php");
}

include 'connectToDb.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $insert_query = "INSERT INTO products (name, description, category, price, image) VALUES ('$name','$description','$category','$price','$image')";

    if ($conn->query($insert_query) === true) {
        header('location:manage_products.php');
    } else {
        die("Error: " . $insert_query . "<br>" . $conn->error);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add a Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <button class="btn btn-danger mb-3"><a href="manage_products.php" class="link-light link-underline-opacity-0">
                < Go back</a></button>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name.." required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Product Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Write about the product" required></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Product Category</label>
                <select class="form-select" name="category" required>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        $result = $conn->query("SELECT name FROM category");

                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter Product Value" pattern="[0-9]" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="link" class="form-control" id="image" name="image" placeholder="Paste Image Link">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>