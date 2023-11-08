<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}
if ($_SESSION["admin"] == false) {
    header("location:index.php");
    exit();
}

include 'connectToDb.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    $r = $conn->query("SELECT name FROM category");
    if ($r->num_rows > 0) {
        echo "Category already exists.";
    } else {
        $q = "INSERT IN TO category name VALUES '$name'";
        if ($conn->query($q) === true) {
            header('location:manage_products.php');
        } else {
            die("Error: " . $insert_query . "<br>" . $conn->error);
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="container p-5">
        <form method="post">
            <div class="form-outline mb-4">
                <label class="form-label" for="name">Category Name</label>
                <input type="text" id="name" class="form-control" name="name" required />
            </div>
            <button type="submit" class="btn btn-primary btn-block mb-4" name="submit">
                Add
            </button>
        </form>
    </div>
</body>

</html>