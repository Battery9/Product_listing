<?php include 'connectToDb.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION["username"]) && $_SESSION["admin"] == true) {
    header("location:dash.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LogIn Page</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container p-5">
      <form action="check_login.php" method="post">
        <div class="form-outline mb-4">
          <label class="form-label" for="username">Username or Email</label>
          <input type="text" id="username" class="form-control" name="username" required/>
        </div>
        <div class="form-outline mb-4">
          <label class="form-label" for="password">Password</label>
          <input type="password" id="password" class="form-control" name="password" required/>
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-4" value="login">
          Sign in
        </button>
        <div class="text-center">
          <p>Not a member? <a href="register.php">Register</a></p>
        </div>
      </form>
    </div>
  </body>
</html>