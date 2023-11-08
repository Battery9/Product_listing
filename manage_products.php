<?php include 'connectToDb.php';
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard - Manage Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="m-2 d-flex justify-content-end align-items-center gap-2">
        <h5>Welcome, <?php echo $_SESSION["username"]; ?></h5>
        <button class="btn btn-info d-inline margin-left-2"><a href="logout.php" class="text-light">Logout</a></button>
    </div>
    <div class="d-flex justify-content-center align-items-center gap-2">
        <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="./dash.php">Manage Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="./manage_products.php">Manage Products</a>
        </li>
    </ul>
    </div>
    <div class="container p-4">
        <button type="button" class="btn btn-success mb-5"><a href="add_product.php" class="link-light link-underline-opacity-0">+ Add a Product</a></button>
        <button type="button" class="btn btn-secondary mb-5"><a href="add_category.php" class="link-light link-underline-opacity-0">+ Add a Category</a></button>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM `products`";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        echo "<tr>";
                        echo "<th scope='row'>" . $id . "</th>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td><img src='" . $row['image'] . "' height='100px' width='150px'</td>";
                        echo "<td><button class='btn btn-primary mx-1'><a href='edit_product.php?pid=" . $id . "' class='link-light link-underline-opacity-0'>Edit</a></button>
                        <button class='btn btn-danger mx-1'><a href='del_product.php?delid=" . $id . "' class='link-light link-underline-opacity-0'>Delete</a></button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td>No records found.</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>