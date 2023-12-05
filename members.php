<?php
// Establish database connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Library_Management_System";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $memDate = $_POST["memDate"];
    $expiryDate = $_POST["expiryDate"];
    $address = $_POST["address"];

    // Get the next available MemId from the database
    $result = $conn->query("SELECT MAX(MemId) FROM Members");
    $row = $result->fetch_assoc();
    $nextMemId = $row["MAX(MemId)"] + 1;

    // Insert data into the Members table
    $sql = "INSERT INTO Members (MemId, Name, MemDate, ExpiryDate, Address)
            VALUES ('$nextMemId', '$name', '$memDate', '$expiryDate', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "Member added successfully. MemId: $nextMemId";
        echo '<br><a href="./index.html"><button>Back to Home</button></a>';

    } else {
        
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
