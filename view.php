<?php
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query PDF files
$sql = "SELECT id, file_name FROM pdf_files";
$result = $conn->query($sql);

// Display PDF files
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<a href='view_pdf.php?id={$row["id"]}'>{$row["file_name"]}</a><br>";
    }
} else {
    echo "No PDF files found.";
}

// Close connection
$conn->close();
?>
