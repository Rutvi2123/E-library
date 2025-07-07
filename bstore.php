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

// Get PDF file data by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT file_data, file_name FROM pdf_files WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($file_data, $file_name);
    if ($stmt->fetch()) {
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename='" . $file_name . "'");
        echo $file_data;
    } else {
        echo "PDF not found.";
    }
    $stmt->close();
} else {
    echo "Invalid PDF ID.";
}

// Close connection
$conn->close();
?>
