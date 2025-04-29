<?php
include('connection.php'); // Include your DB connection

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate token and check if it’s not expired
    $stmt = $conn->prepare("SELECT user_id, reset_token_expiry FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_id = $result->fetch_assoc()['user_id'];

        // Show the password reset form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $confirm_password = $_POST['confirm_password'];

            // Check if passwords match
            if ($_POST['password'] === $_POST['confirm_password']) {
                // Update the user's password in the database
                $stmt = $conn->prepare("UPDATE users SET passwordi = ?, reset_token = NULL, reset_token_expiry = NULL WHERE user_id = ?");
                $stmt->bind_param("si", $new_password, $user_id);
                $stmt->execute();

                echo "Your password has been updated. <a href='signin.php'>Sign in</a>";
            } else {
                echo "Passwords do not match.";
            }
        }
        ?>

        <form action="reset_password.php?token=<?php echo $token; ?>" method="POST">
            <input type="password" name="password" required placeholder="New Password">
            <input type="password" name="confirm_password" required placeholder="Confirm Password">
            <button type="submit">Reset Password</button>
        </form>

        <?php
    } else {
        echo "Invalid or expired token.";
    }
}
?>
