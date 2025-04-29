
<?php
// Check if session is already started, if not, then start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['username'])) {
    header("Location: profile.php"); // or whatever your user profile page is called
    exit();
}

$conn = new mysqli('localhost','root','','cars');

if(!$conn)
die(mysqli_error($conn));






if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to check if username exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if username exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password using password_verify (assuming passwords are hashed in the database)
        if (password_verify($password, $user['passwordi'])) {
            // Login successful, start a session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            
            // Redirect to dashboard or another page
            header("Location: index.php");
            
            exit();
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('Username does not exist!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>



    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

<link rel="stylesheet" href="assets/css/animations.css">


<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/signin.css">


 <!-- Font Awesome CDN -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <!-- Material Icons CDN -->
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
 
 background-color:rgb(17, 100, 172);
 background-image: url('https://giffiles.alphacoders.com/991/99170.gif');
 background-size: cover;
}

    </style>


    
</head>
<body>


<?php 
    
    
    
    
    include('header.php'); ?>



    <div class="glass-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="Signin.php" method="POST">

                <input type="text" id="username" name="username" required placeholder="Username">
                
                <input type="password" id="password" name="password" required placeholder="Password">
                
               
                    <a href="forgot_password.php" style="color:white;">Forgot Password?</a>
               
                
                <button type="submit">Login</button>

                <p>Don't have an account? <a href="SignUp.php" id="register">Register</a></p>
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

</body>
</html>