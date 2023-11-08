<?php
include 'connectToDb.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Authenticate the user against the database
    $get_admins = $conn->query("SELECT password FROM admins WHERE username = '$username'");
    if($get_admins->num_rows>0) {
        $pass = $get_admins->fetch_assoc();

        if ($pass && $pass['password'] == $password) {
            $_SESSION["username"] = $username;
            $_SESSION["admin"] = true;
            header("location:dash.php");
        } else {
            echo "Incorrect Credentials. Please <a href='login.php'>try again.</a>";
        }
        $conn->close();
    }

    $get_users = $conn->query("SELECT password FROM users WHERE email = '$username'");

    if($get_users->num_rows>0) {
        $pass = $get_users->fetch_assoc();

        if ($pass && $pass['password'] == $password) {
            $_SESSION["username"] = $username;
            $_SESSION["admin"] = false;
            header("location:index.php");
        } else {
            echo "Incorrect Credentials. Please <a href='login.php'>try again.</a>";
        }
        $conn->close();
    }
}