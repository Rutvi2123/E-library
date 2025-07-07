 <?php 
session_start(); // Start the session to persist user authentication

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if(isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Prepare a SQL statement to check user credentials
    $stmt = $conn->prepare("SELECT username, email, password FROM users WHERE (username = ? OR email = ?) LIMIT 1");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows == 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, log in the user
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];
           
            // Redirect to a dashboard or welcome page
            header("Location: index.html");
            exit();
        } else {
            // Password is incorrect
            $error_message = "Invalid username/email or password.";
        }
    } else {
        // User not found
        $error_message = "Invalid username/email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style1.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="content">
         <div class="text">
            Login Form
         </div>
         <form action="login.php" method="post">
            <div class="field">
               <input type="email" name="email" id="email" required placeholder="Email">
               <span class="fas fa-user"></span>
               
               
            </div>
            <div class="field">
               <input type="password" name="password" id="password" required placeholder="Password">
               <span class="fas fa-lock"></span>
               
            </div>
            <?php if(isset($error_message)) { ?>
                <div class="error"><?php echo $error_message; ?></div>
            <?php } ?>
            <div class="forgot-pass">
               <a href="Forgot pass.html">Forgot Password?</a>
            </div>
            <button type="submit">Sign in</button>
            <div class="sign-up">
               Not a member?
               <a href="signupf.php">Register now</a>
            </div>
         </form>
      </div>
   </body>
</html>
