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
  $searchTerm = mysqli_real_escape_string($conn, $_POST["searchTerm"]);

  if (is_numeric($searchTerm)) {
    
    $result = $conn->query("SELECT * FROM books WHERE B_id = $searchTerm");
  } else {
    
    $result = $conn->query("SELECT * FROM books WHERE Title LIKE '%$searchTerm%'");
  }

  if ($result->num_rows > 0) {
    echo "<h3>Search Results:</h3>
          <table border='1'>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Author</th>
              <th>Price</th>
              <th>Available</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>" . $row["Bookid"] . "</td>
              <td>" . $row["Title"] . "</td>
              <td>" . $row["Author"] . "</td>
              <td>" . $row["Price"] . "</td>
              <td>" . $row["Available"] . "</td>
            </tr>";
    }

    echo "</table>";
    echo '<br><a href="./index.html"><button>Back to Home</button></a>';
  } else {
    echo "No matching books found.";
    echo '<br><a href="./index.html"><button>Back to Home</button></a>';
  }
  
}

$conn->close();
?>