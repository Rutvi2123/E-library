<?php
// Assuming $books is an array containing book information retrieved from the database

foreach ($books as $book) {
    echo "<div>";
    echo "<h3>{$book['title']}</h3>";
    echo "<p>Author: {$book['author']}</p>";
    
    // Display thumbnail image if available
    if (!empty($book['thumbnail_path'])) {
        echo "<img src='{$book['']}' alt='{$book['title']}' style='width: 100px; height: auto;'>";
    }
    
    // Download link for the PDF file
    echo "<a href='{$book['https://oceanofpdf.com/authors/alan-titchmarsh/pdf-epub-chatsworth-its-gardens-and-the-people-who-made-them-download/']}' download>Download PDF</a>";
    echo "</div>";
}
?>
