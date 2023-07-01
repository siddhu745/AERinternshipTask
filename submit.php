<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aerformtask";

// Create a new PDO instance
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $age = $_POST["age"];
  $weight = $_POST["weight"];
  $email = $_POST["email"];
  $healthReportName = $_FILES["healthReport"]["name"];
  $healthReportTmpName = $_FILES["healthReport"]["tmp_name"];

  // Move the uploaded file to a desired location
  $uploadDirectory = "uploads/"; // Change this to your desired directory
  $uploadedFilePath = $uploadDirectory . $healthReportName;
  move_uploaded_file($healthReportTmpName, $uploadedFilePath);

  // Insert the user details and file path into the database
  $stmt = $conn->prepare("INSERT INTO users (name, age, weight, email, health_report) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$name, $age, $weight, $email, $uploadedFilePath]);

  // Close the database connection
  $conn = null;

  // Redirect the user to a success page
  header("Location: success.php");
  exit();
}
?>
