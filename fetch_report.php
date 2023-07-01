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

// Handle fetching the health report
if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $email = $_GET["email"];

  // Fetch the health report file path from the database
  $stmt = $conn->prepare("SELECT health_report FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $result = $stmt->fetch();

  // Send the PDF file to the user for download
  if ($result && file_exists($result["health_report"])) {
    $filePath = $result["health_report"];
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=\"".basename($filePath)."\"");
    readfile($filePath);
    exit();
  } else {
    die("Health report not found for the given email.");
  }
}

// Close the database connection
$conn = null;
?>
