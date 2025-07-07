<?php
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdf"])) {
        $file_name = $_FILES["pdf"]["name"];
        $file_tmp = $_FILES["pdf"]["tmp_name"];

        // Read the file
        $file_data = file_get_contents($file_tmp);

        if ($file_data === false) {
            throw new Exception("Error reading file data.");
        }

        // Prepare SQL insert statement
        $stmt = $conn->prepare("INSERT INTO pdf_files (file_data, file_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $file_data, $file_name);

        // Execute the statement
        if ($stmt->execute()) {
            echo "File uploaded successfully.";
        } else {
            throw new Exception("Error uploading file: " . $conn->error);
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF</title>
</head>
<body>
    <h2>Upload PDF</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select PDF file to upload:
        <input type="file" name="pdf" id="pdf">
        <input type="submit" value="Upload PDF" name="submit">
    </form>
</body>
</html>



