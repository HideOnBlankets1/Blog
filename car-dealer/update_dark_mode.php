<?php
session_start();


$conn = new mysqli('localhost','root','','cars');

if(!$conn)
die(mysqli_error($conn));

if (isset($_POST['dark_mode']) && isset($_SESSION['username'])) {
    $dark_mode = $_POST['dark_mode'];
    $username = $_SESSION['username'];

    // Sanitize the input to avoid SQL injection
    $dark_mode = $dark_mode == 'dark' ? 'dark' : 'light';

    // Update the dark_mode field in the database
    $sql = "UPDATE users SET dark_mode = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $dark_mode, $username);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
