<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["username"])) {
    header("location:index.php");
    exit();
}

include 'connectToDb.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    // Check if the email and phone number are unique
    $check_query = "SELECT * FROM users WHERE email='$email' OR mobile='$mobile'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Email or phone number already exists. Please use a different one.";
    } else {
        // Inserting data
        $insert_query = "INSERT INTO users (name, email, mobile, gender, password) VALUES ('$name','$email','$mobile','$gender','$password')";

        if ($conn->query($insert_query) === true) {
            header('location:logIn.php');
        } else {
            die("Error: " . $insert_query . "<br>" . $conn->error);
        }
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
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name..">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address..">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Mobile No.." pattern="[0-9]{10}">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label><br>
                <input type="radio" class="btn-check" name="gender" value="F" id="female" required>
                <label class="btn btn-outline-secondary" for="female">Female</label>
                <input type="radio" class="btn-check" name="gender" value="M" id="male" required>
                <label class="btn btn-outline-secondary" for="male">Male</label>
                <input type="radio" class="btn-check" name="gender" value="O" id="other" required>
                <label class="btn btn-outline-secondary" for="other">Others</label>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password.." required>
                <div class="form-text">Password should be at least 6 charecter long.</div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
        <div class="text-center">
            <p>Already a member? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>

</html>