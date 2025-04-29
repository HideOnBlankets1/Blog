

<?php
$conn = new mysqli('localhost','root','','cars');

if(!$conn)
die(mysqli_error($conn));
// Handling form submission and validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Check if username exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $darkmode = "light";

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($result->num_rows > 0) {
        
        echo "<script type='text/javascript'>
        alert('Username already exists.');
      </script>";

      
    } else {
        // Password strength check (min 8 chars, 1 capital, 1 number)
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || strlen($password) < 8) {
            echo "<script type='text/javascript'>
            alert('Password is weak. Try a better password with at least 8 characters, including a capital letter and a number.');
          </script>";
            
        } else {
            // Default profile picture from Firebase
            $profile_picture = 'https://firebasestorage.googleapis.com/v0/b/restaurant-dd2d7.appspot.com/o/Cars%2Fuser.png?alt=media&token=1b3a3ed8-1015-45a1-bdce-42b779a12ac7';
            $created_at = date('Y-m-d H:i:s'); // Timestamp for created at

            // Insert user data into the database
            $sql = "INSERT INTO users (fullname, username, passwordi, email, profile_picture, dark_mode,  created_at, updated) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $name, $username, $hashed_password , $email, $profile_picture, $darkmode,  $created_at, $created_at);
            $stmt->execute();

            //echo "Sign up successful!";

            echo "<script type='text/javascript'>
            alert('Sign up successful! ');
          </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/signin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        @media (min-width: 992px) {
            .sign-in {
                margin-left: 8.8em;
            }
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1em 0;
            background-color: #222;
            color: #fff;
        }

        .social-icons a {
            color: black;
            font-size: 1.5em;
            margin-left: 1em;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #f39c12; /* Golden yellow for a cool hover effect */
        }

        body {
            background-color: rgb(17, 100, 172);
            background-image: url('https://giffiles.alphacoders.com/991/99170.gif');
            background-size: cover;
        }

        .glass-container {
            width: 300px;
            height: 500px;
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #fff;
        }

        .password-strength {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }

        .password-strength span {
            font-size: 12px;
            color: #fff;
        }

        .password-strength-bar {
            width: 100%;
            height: 5px;
            background-color: #ddd;
            border-radius: 3px;
            margin-top: 5px;
        }

        .password-strength-bar span {
            display: block;
            height: 100%;
            width: 0%;
            transition: width 0.3s;
        }

       /* Tooltip Styling */
.tooltip {
    position: absolute;
    top: -5px;
    right: 20px;
    background-color: #222;
    color: white;
    padding: 5px;
    border-radius: 5px;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s;
}


        .password-strength:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        /* View Password Styling */
        .view-password {
            cursor: pointer;
            transform: scale(1.2);
        }

        /* Info icon color */
        #password-tooltip {
            color: white;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="glass-container" id="tooltip1">
    <div class="login-box">
        <h2>Sign Up</h2>
        <form action="Signup.php" method="POST">
            <input type="text" id="name" name="name" required placeholder="Full Name" required=""/>
            <input type="text" id="username" name="username" required placeholder="Username" required=""/>
            <input type="password" id="password" name="password" required placeholder="Password" required="" onkeyup="checkPasswordStrength()"/>
            
            <div class="password-strength">
                <span id="password-strength-text">Weak</span>
                <i class="material-icons" id="password-tooltip" style="cursor: pointer;" onclick="toggleTooltip()">info</i>
                <div id="password-tooltip-text" style="display: none; color: #fff; background: #222; padding: 10px; border-radius: 5px; font-size:12px;">
                    Password should be at least 8 characters long, contain a capital letter, and a number.
                </div>
                <span id="view-password" class="view-password" onclick="togglePasswordVisibility()">👁️</span>
            </div>

            <div class="password-strength-bar">
                <span id="password-strength-bar"></span>
            </div>

            <input name="email" type="email" id="email" required placeholder="Your Email*">
            <button type="submit">Sign Up</button>

            <p>Already have an account? <a href="Signin.php" id="register">Log In</a></p>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="assets/js/jquery-2.1.0.min.js"></script>
<!-- Bootstrap -->
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>


<!-- Plugins -->
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script> 
<script src="assets/js/mixitup.js"></script> 
<script src="assets/js/accordions.js"></script>

<!-- Global Init -->
<script src="assets/js/custom.js"></script>



<script>
    function checkPasswordStrength() {
        var password = document.getElementById("password").value;
        var strengthText = document.getElementById("password-strength-text");
        var strengthBar = document.getElementById("password-strength-bar");
        var tooltip = document.getElementById("password-tooltip");

        var strength = 0;

        // Password strength criteria
        //if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password) && password.length >= 6) strength++;
        if (/[0-9]/.test(password) && password.length >= 6) strength++;

        if (strength === 0) {
            strengthText.textContent = "Weak";
            strengthBar.style.width = "25%";
            strengthBar.style.backgroundColor = "red";
        } else if (strength === 1) {
            strengthText.textContent = "Make it stronger";
            strengthBar.style.width = "50%";
            strengthBar.style.backgroundColor = "yellow";
        } else if (strength === 2) {
            strengthText.textContent = "Strong";
            strengthBar.style.width = "100%";
            strengthBar.style.backgroundColor = "green";
        }
    }

    function toggleTooltip() {
        var tooltip = document.getElementById("password-tooltip-text");
        if (tooltip.style.display === "block") {
            tooltip.style.display = "none"; // Hide tooltip if it's already visible
            tooltip1.style.height = "500px";

        } else {
            tooltip.style.display = "block"; // Show tooltip
            tooltip1.style.height = "548px";
        }
    }

    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var eyeIcon = document.getElementById("view-password");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.textContent = "🙈";  // Change the icon to "hidden"
        } else {
            passwordField.type = "password";
            eyeIcon.textContent = "👁️";  // Change the icon to "view"
        }
    }

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>
</html>
