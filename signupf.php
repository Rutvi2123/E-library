<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Check if all form fields are set
        if (isset($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            // Prepare and bind parameters for SQL insertion
            $stmt = $conn->prepare("INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $phone, $password);
            $execval = $stmt->execute();

            if ($execval) {
                echo "Registration successful...";
            } else {
                echo "Error: " . $conn->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "All form fields are required.";
        }

        // Close connection
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style1.css">
   </head>
   <body>
      <div class="content">
         <div class="text">
            Registration Form
         </div>
         <form action="signupf.php" method="post">
            <div class="field">
               <input type="text" id="username" name="username" required>
               <span class="fas fa-user"></span>
               <label>Name</label>
            </div>
            <div class="field">
                <input type="text" id="email" name="email" required>
                <span class="fas fa-user"></span>
                <label>Email</label>
             </div>
             <div class="field">
               <input type="text" id="phone" name="phone" required>
               <span class="fas fa-user"></span>
               <label>Phone</label>
            </div>
            <div class="field">
                <input type="password" id="password" name="password" required>
                <span class="fas fa-lock"></span>
                <label>Password</label>
             </div>
            <button type="submit">Register</button>
            <div class="sign-up">
               Already a member?
               <a href="login.php">Login now</a>
            </div>
         </form>
      </div>
   </body>
</html>
