<?php 
$conn = mysqli_connect('localhost', 'doan', '123', 'doan');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>
<?php
$host = 'localhost';
$dbname = 'doan';
$username = 'doan';
$password = '123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
