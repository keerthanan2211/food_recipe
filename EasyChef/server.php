<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "food"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Registration Successful")</script>';
        header("refresh:1;url=login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        header("Location: index.html");
        exit();
    } else {
        echo '<script>alert("Invalid Email or Password")</script>';
        header("refresh:1;url=login.php");
        exit;
    }
}

$conn->close();
?>
