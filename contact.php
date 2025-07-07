<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us:- E-library</title>
    <!-- Include CSS and any other necessary resources for this page -->
    <style>
        body {
            background-image: url("phone1.jpg");
            background-position: center left;
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Contact Us</h1>
    </header>
    <section class="contact-info">
        <h2>Contact Information</h2>
        <p>Email: elibrary@gmail.com</p>
        <p>Phone: +1 (123) 456-7890</p>
        <!-- Add more contact information as needed -->
    </section>
    <section class="contact-form">
        <h2>Contact Form</h2>
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = ""; // Assuming no password set for your MySQL server
            $dbname = "library";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind parameters for SQL insertion
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);

            // Set parameters and execute
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            if ($stmt->execute()) {
                echo "Message submitted successfully";
            } else {
                echo "Error: " . $conn->error;
            }

            // Close statement
            $stmt->close();

            // Close connection
            $conn->close();
        }
        ?>
        <!-- Add your contact form HTML code here -->
        <form action="contact.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea><br>

            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html>
