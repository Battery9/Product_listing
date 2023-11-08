<?php include 'connectToDb.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}

$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$q = "SELECT * FROM products";
if ($category != 'all') {
    $q .= " WHERE category = '$category'";
}
$result = $conn->query($q);

if (isset($_GET['search'])) {
    $search_q = $_GET['search'];
    $sq = $conn->query("SELECT * FROM products WHERE name LIKE '%$search_q%' OR description LIKE '%$search_q%'");
    $result = $sq;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="m-2 d-flex justify-content-end align-items-center gap-2 fixed">
        <h5>Welcome, <?php echo $_SESSION["username"]; ?></h5>
        <button class="btn btn-info d-inline margin-left-2"><a href="logout.php" class="text-light">Logout</a></button>
    </div>
    <div class="container my-3 py-4 bg-light">
        <div class="row text-center mb-5">
            <div class="mx-auto">
                <h1>Browse Products</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-between mb-3">
            <form name="search" class="d-flex w-50">
                <input type="text" class="form-control mx-2" placeholder="Type something" name="search" required>
                <button type="submit" class="btn btn-dark">Search</button>
            </form>
            <select class="form-select w-25 mx-5" id="filter" onchange="filterProducts(this.value)">
                <option value="all">All category</option>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $r = $conn->query("SELECT category FROM products");
                    while ($row = $r->fetch_assoc()) {
                        if ($row['category'] === $category) {
                            echo "<option value='" . $row['category'] . "' selected>" . $row['category'] . "</option>";
                        } else {
                            echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                        }
                    }
                }
                ?>
            </select>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <ul class="list-group shadow">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        while ($row = $result->fetch_assoc()) {
                            echo "<li class='list-group-item'>
                                        <div class='media d-flex align-items-center justify-content-between p-3'>
                                            <div class='media-body'>";
                            echo "<h5>" . $row['name'] . "</h5>";
                            echo "<p class='font-italic text-muted small'>" . $row['description'] . "</p>";
                            echo "<div class='d-flex align-items-center justify-content-between mt-1'>
                                        <h6 class='font-weight-bold my-2'>₹ " . $row['price'] . "</h6>
                                    </div></div>";
                            echo "<img src='" . $row['image'] . "' width='200px' height='150px' class='ml-5'>";
                            echo "</div></li>";
                        }
                        $conn->close();
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterProducts(category) {
            if (category === 'all') {
                window.location.href = './';
            } else {
                window.location.href = '?category=' + category;
            }
        }
    </script>
</body>

</html>