<?php
include 'connectToDb.php';

if (isset($_GET)) {
    $id = $_GET['upid'];
    // Getting previous Data to be filled in form
    $get_query = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($get_query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $old_name = $row['name'];
            $old_email = $row['email'];
            $old_mobile = $row['mobile'];
        }
    } else {
        die("Some Error fetching Data: " . $insert_query . "<br>" . $conn->error);
    }
}

//Update Data
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

        $update_query = "UPDATE users SET name = '$name', email = '$email', mobile = '$mobile', password='$password' WHERE id = $id";
  
        if ($conn->query($update_query) === true) {
            header('location:dash.php');
        } else {
            die("Error: " . $update_query . "<br>" . $conn->error);
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add a user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <button class="btn btn-danger mb-3"><a href="dash.php" class="link-light link-underline-opacity-0">
                < Cancle Update</a></button>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name.." value=<?php echo $old_name?>>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address.." value=<?php echo $old_email?>>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Mobile No.." pattern="[0-9]{10}" value=<?php echo $old_mobile?>>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password.." required>
                <div class="form-text">Password should be at least 6 charecter long.</div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>