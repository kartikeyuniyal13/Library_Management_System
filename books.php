<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Library_Management_System";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $price = $_POST["price"];
    $available = $_POST["available"];

    if (empty($title) || empty($author) || !is_numeric($price)) {
        echo "Invalid input. Please fill in all required fields with valid data.";
    } else {
        // Get the next available Book ID from the database
        $result = $conn->query("SELECT MAX(Bookid) FROM Books");
        $row = $result->fetch_assoc();
        $nextBookId = $row["MAX(Bookid)"] + 1;

        // Insert the new record with the next Book ID
        $sql = "INSERT INTO Books (Bookid, Title, Author, Price, Available) VALUES ('$nextBookId', '$title', '$author', '$price', '$available')";

        if ($conn->query($sql) === TRUE) {
            echo "Book added successfully!";
            
            // Add the link to go back to index.html
            echo '<br><a href="index.html"><button>Back to Home</button></a>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
