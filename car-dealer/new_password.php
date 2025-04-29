<?php
session_start();

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Fetch the current password from the database (make sure passwords are hashed)
        $query = "SELECT passwordi FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPassword = $row['passwordi']; // Assuming hashed password

            // Verify if the old password matches
            if (password_verify($oldPassword, $storedPassword)) {

                // Check if the new password matches the confirm password
                if ($newPassword === $confirmNewPassword) {

                    // Check password strength (You can implement a more complex check here)
                    if (strlen($newPassword) >= 8 && preg_match('/[A-Za-z]/', $newPassword) && preg_match('/[0-9]/', $newPassword)) {

                        // Hash the new password
                        $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                        // Update the password in the database
                        $updateQuery = "UPDATE users SET passwordi = ? WHERE user_id = ?";
                        $updateStmt = $conn->prepare($updateQuery);
                        $updateStmt->bind_param("si", $hashedNewPassword, $userId);
                        if ($updateStmt->execute()) {
                            // Redirect after success with alert
                            echo "<script>
                                    alert('Password successfully updated!');
                                    window.location.href = 'profile.php';
                                  </script>";
                            exit(); // Stop further execution after redirection
                        } else {
                            // Redirect with an error if update fails
                            echo "<script>
                                    alert('Error updating password. Please try again.');
                                    window.location.href = 'profile.php';
                                  </script>";
                            exit();
                        }

                    } else {
                        // Redirect with an error for weak password
                        echo "<script>
                                alert('New password must be at least 8 characters long and contain both letters and numbers.');
                                window.location.href = 'profile.php';
                              </script>";
                        exit();
                    }

                } else {
                    // Redirect with an error for password mismatch
                    echo "<script>
                            alert('New password and confirm password do not match.');
                            window.location.href = 'profile.php';
                          </script>";
                    exit();
                }

            } else {
                // Redirect with an error for incorrect old password
                echo "<script>
                        alert('Old password is incorrect.');
                        window.location.href = 'profile.php';
                      </script>";
                exit();
            }

        } else {
            // Redirect with an error if user is not found
            echo "<script>
                    alert('User not found.');
                    window.location.href = 'profile.php';
                  </script>";
            exit();
        }

    } else {
        // Redirect with an error if user is not logged in
        echo "<script>
                alert('You must be logged in to change your password.');
                window.location.href = 'profile.php';
              </script>";
        exit();
    }
}
?>
