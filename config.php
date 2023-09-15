<?php
// Database connection details
$servername = "localhost";
$username = "statehng";
$password = "statehng4991";
$dbname = "statehng";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    
}
?>
