 
    


    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Start the session if not already started
    }


 


    ?>


    
 
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

       /* Tooltip Style */
.profile-link {
    position: relative;
    display: inline-block;
}

.profile-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.profile-link:hover .profile-pic {
    opacity: 0.8; /* Slight transparency when hovered */
}

/* Tooltip Text */
.profile-link::after {
    content: attr(title); /* Display the username */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -120%);
    background-color: transparent; /* Make background transparent */
    color: white; /* Text color for the username */
    padding: 5px 10px;
    border-radius: 5px;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s;
    white-space: nowrap;
    font-size: 14px;
}

/* Show Tooltip on Hover */
.profile-link:hover::after {
    visibility: visible;
    opacity: 1;
}



    </style>


<!-- navbar.php -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="index.php" class="logo">Auto<em> Motors</em></a>
                    <ul class="nav" >
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="cars.php">Cars</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li ><a href="contact.php">Contact</a></li>
                        


                        <?php        
    



// hi
$conn = new mysqli('localhost','root','','cars');

if(!$conn)
die(mysqli_error($conn));
// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare & execute query to fetch profile picture and username
    $stmt = $conn->prepare("SELECT profile_picture FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Get profile pic or fallback
    $profilePic = $user['profile_picture'] ?? 'assets/images/default-user.png';
    
    // Output profile image with hover tooltip
    echo '<li class="sign-in">';
    echo '<a href="profile.php" class="profile-link">';
    echo '<img src="' . htmlspecialchars($profilePic) . '" alt="Profile" class="profile-pic" title="' . htmlspecialchars($username) . '">';
    echo '</a>';
    echo '</li>';
} else {
    // If not logged in, show Sign In
    echo '<li class="sign-in">';
    echo '<a href="Signin.php" class="sign-in-btn">';
    echo '<i class="fas fa-user"></i> Sign In';
    echo '</a>';
    echo '</li>';
}


?>


                    </ul>        
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
