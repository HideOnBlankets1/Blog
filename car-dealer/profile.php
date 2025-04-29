<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'connection.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT fullname, username, email, profile_picture FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/Admin.css" />
  <link
    rel="stylesheet"
    href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
  />
  <title>Admin Dashboard Panel</title>
  <style>
    .user-section { background: var(--panel-color); padding: 2rem; margin-top:1rem; border-radius:12px; display: none; }
    .user-section.active { display: block; }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; margin-bottom: .5rem; }
    .form-group input { width:100%; padding:.5rem; border-radius:8px; border:1px solid #ccc; }
    .btn-save, .btn-add, .delete { background: orange; color:#fff; padding:.5rem 1rem; border:none; border-radius:8px; cursor:pointer; margin-top:1rem;}
    .card { display:flex; align-items:center; background:#f5f5f5; padding:1rem; border-radius:12px; margin-bottom:1rem; }
    .card img { width:120px; height:80px; border-radius:8px; object-fit:cover; margin-right:1rem; }
    .card-info h4 { margin:0; }
    .upload-area { position:relative; width:150px; height:150px; border:2px dashed #ccc; display:flex; justify-content:center; align-items:center; cursor:pointer; }
    .upload-area:hover { background:#f7f7f7; }
    .image-preview { width:100%; height:100%; display:flex; justify-content:center; align-items:center; color:#aaa; }
    .image-preview img { width:100%; height:100%; object-fit:cover; }
    input[type="file"] { display:none; }
    /* Highlight the active nav link */
.nav-links li a.active {
  background-color: rgba(255,165,0,0.2);
  border-radius: 4px;
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

.change-password-btn {
        background-color:rgb(230, 148, 55); /* Orangebutton */
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        width: 100%;
        max-width: 300px;
        margin: auto;
        display: block;
        margin-bottom: 20px;
    }

    /* Hover effect for Change Password Button */
    .change-password-btn:hover {
        background-color:rgb(218, 158, 48);
    }

    /* Style for the password change form */
    #changePasswordForm {
        display: none; /* Hidden by default */
        margin-top: 20px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        margin: auto;
    }

    /* Style for the input fields inside the form */
    #changePasswordForm input {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    /* Style for the submit button */
    #changePasswordForm button {
        width: 100%;
        background-color: rgb(253, 160, 38); /* Orange color */
        color: white;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    

    /* Hover effect for the submit button */
    #changePasswordForm button:hover {
        background-color: rgb(224, 160, 62);
    }

    /* Error message styling */
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }




    /* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

h3, h4 {
    margin: 0;
}

/* User Section */
.user-section {
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 20px;
}

.title {
    display: flex;
    align-items: center;
    font-size: 24px;
    font-weight: bold;
}

.title i {
    margin-right: 10px;
}

.text {
    color: #333;
}

/* Membership Plans */
.membership-section {
    margin-top: 40px;
    padding: 20px;
    background-color: #eaeaea;
    border-radius: 10px;
}

.membership-section h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

.plans {
    display: flex;
    justify-content: space-between;
}

.plan {
    background-color: #fff;
    padding: 20px;
    width: 48%;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.plan h4 {
    font-size: 20px;
    color: #333;
}

.plan p {
    font-size: 18px;
    margin: 10px 0;
}

.plan ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    font-size: 14px;
    color: #777;
}

.plan .btn-select {
    margin-top: 15px;
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.plan .btn-select:hover {
    background-color: #0056b3;
}

/* Service Listings */
.listing-actions {
    text-align: right;
    margin-top: 20px;
}

.btn-add {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-add:hover {
    background-color: #218838;
}

/* Service Cards */
.listings {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 30px;
}

.card {
    background-color: #fff;
    width: 30%;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    position: relative;
}

.card img {
    width: 100%;
    border-radius: 10px 10px 0 0;
}

.card-info {
    padding: 15px;
}

.card-info h4 {
    font-size: 18px;
    margin-bottom: 10px;
}

.card-info p {
    font-size: 16px;
    color: #555;
}

.card button {
    background-color: #ffc107;
    border: none;
    padding: 8px 16px;
    font-size: 14px;
    margin: 5px;
    cursor: pointer;
    border-radius: 5px;
}

.card button:hover {
    background-color: #e0a800;
}

.delete {
    background-color: #dc3545;
}

.delete:hover {
    background-color: #c82333;
}

/* Premium Badge */
.card.premium .premium-badge {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 10px;
    border-radius: 5px;
}

.card.premium .card-info h4 {
    color: #007bff;
}

@media (max-width: 768px) {
    .plans {
        flex-direction: column;
    }

    .plan {
        width: 100%;
        margin-bottom: 20px;
    }

    .listings {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 80%;
    }
}

    
  </style>
</head>
<body>
  <nav>
    <div class="logo-name">
      <div class="logo-image"><img src="images/logo.png" alt="" /></div>
      <span class="logo_name"><a href="index.php" style="color:orange; text-decoration:none;">AutoMotors</a></span>
    </div>
    <div class="menu-items">
      <ul class="nav-links">
        <li><a href="#" data-target="personal-info"><i class="uil uil-estate"></i><span class="link-name">Personal Info</span></a></li>
        <li><a href="#" data-target="car-listings"><i class="uil uil-files-landscapes"></i><span class="link-name">Car Listings</span></a></li>
        <li><a href="#" data-target="services-listings"><i class="uil uil-wrench"></i><span class="link-name">Services Listings</span></a></li>
       
       
      </ul>
      <ul class="logout-mode">
        <li><a href="Logout.php"><i class="uil uil-signout"></i><span class="link-name">Logout</span></a></li>
        <li class="mode"><a href="#"><i class="uil uil-moon"></i><span class="link-name">Dark Mode</span></a>
          <div class="mode-toggle"><span class="switch"></span></div>
        </li>
      </ul>
    </div>
  </nav>

  <section class="dashboard">
    <div class="top">
      <i class="uil uil-bars sidebar-toggle"></i>
      <div class="search-box"><i class="uil uil-search"></i><input type="text" placeholder="Search here..."></div>
      <img src="images/profile.jpg" alt="">
    </div>

    <div class="dash-content">
      <!-- Personal Info -->
      <div class="user-section" id="personal-info">
        <div class="title"><i class="uil uil-user"></i><span class="text">Personal Information</span></div>
        <div class="form-container">
          <form id="userInfoForm" action="profile_data.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <div class="profile-picture-container">
                <input type="file" name="profile_picture" id="profile_picture" onchange="previewImage(event)">
                <label for="profile_picture" class="upload-area">

                
                  <div class="image-preview" id="imagePreview">
                    <?php if (!empty($user['profile_picture'])): ?>
                      <img src="<?=htmlspecialchars($user['profile_picture'])?>" alt="">
                    <?php else: ?>
                      <span>Drag & Drop Image or Click to Upload</span>
                    <?php endif; ?>
                  </div>
                </label>
              </div>
            </div>

           
</div>


            <div class="form-group"><label>Full Name</label><input type="text" name="full_name" value="<?=htmlspecialchars($user['fullname'])?>"></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" value="<?=htmlspecialchars($user['email'])?>"></div>
            <div class="form-group"><label>Username</label><input type="text" name="username" value="<?=htmlspecialchars($user['username'])?>"></div>
            <button type="submit" class="btn-save">Save Changes</button>
          </form>
          <button onclick="togglePasswordForm()">Change Password</button>

<div class="glass-container" id="changePasswordForm" style="display:none;">
<form action="new_password.php" method="POST">
<input type="password" id="oldPassword" name="oldPassword" required placeholder="Old Password" required="" onkeyup="checkPasswordStrength()">

<input type="password" id="newPassword" name="newPassword" required placeholder="New Password" required="" onkeyup="checkPasswordStrength()">

<div class="password-strength">
<span id="password-strength-text">Weak</span>
<div class="password-strength-bar">
    <span id="password-strength-bar"></span>
</div>
</div>

<input type="password" id="confirmNewPassword" name="confirmNewPassword" required placeholder="Confirm New Password" required="">

<button type="submit">Change Password</button>
</form>
          
        </div>
      </div>
      <!-- Car Listings -->
      <div class="user-section" id="car-listings">
        <div class="title"><i class="uil uil-car"></i><span class="text">My Cars</span></div>
      
        <div>
    <a href="Cars_php/list_all_cars.php"><button class="btn-add">See all listings</button></a>
    <a href="Cars_php/add_cars.php">  <button class="btn-add">Add New Car</button>
    <a href="Cars_php/auction.php">  <button class="btn-add">Add a car for auction</button>
    </div>
      </div>
     <!-- Services Listings Section -->
<div class="user-section" id="services-listings">
    <div class="title">
        <i class="uil uil-wrench"></i><span class="text">My Services</span>
    </div>

    <!-- Membership Plan Section -->
    <div class="membership-section">
        <h3>Choose Your Membership Plan</h3>
        <div class="plans">
            <div class="plan basic-plan">
                <h4>Basic Plan</h4>
                <p>$20/month</p>
                <ul>
                    <li>Activate Service Listing</li>
                    <li>Standard Service Visibility</li>
                </ul>
                <button class="btn-select" onclick="alert('Redirecting to PayPal...')">Select Plan</button>
            </div>
            <div class="plan premium-plan">
                <h4>Premium Plan</h4>
                <p>$30/month</p>
                <ul>
                    <li>Activate Service Listing</li>
                    <li>Premium Service Visibility</li>
                    <li>Blue Badge</li>
                </ul>
                <button class="btn-select" onclick="alert('Redirecting to PayPal...')">Select Plan</button>
            </div>
        </div>
    </div>
   
    <!-- Service Listings -->
    <div style=" display: flex; justify-content: center; align-items: center; gap: 10px;  ">
    <a href="Businesses/list_all_businessess.php"><button class="btn-add">See all listings</button></a>
    <a href="Businesses/add_business.php">  <button class="btn-add">+ Add New Service</button>
    </div>
   

     
    </div>
  </section>

  <script>
    //
    
    const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");


      let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}
 

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark");

    // Determine if the dark mode is enabled or not
    const darkMode = body.classList.contains("dark") ? "dark" : "light";

    // Update localStorage
    localStorage.setItem("mode", darkMode);

    // Send AJAX request to update the database
    fetch("update_dark_mode.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "dark_mode=" + darkMode // Send dark_mode value to the server
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              console.log("Dark mode updated in the database.");
          } else {
              console.log("Error updating dark mode.");
          }
      }).catch(error => {
          console.error('Error:', error);
      });
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})


    // Section toggle
    const navLinks     = document.querySelectorAll(".nav-links li a");
    const userSections = document.querySelectorAll(".user-section");
    // Show default
    document.getElementById("personal-info").classList.add("active");
    const firstLink = document.querySelector('.nav-links li a[data-target="personal-info"]');
if (firstLink) firstLink.classList.add('active');

    navLinks.forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        navLinks.forEach(l => l.classList.remove("active"));
        link.classList.add("active");
        const targetId = link.dataset.target;
        if (!targetId) return;
        userSections.forEach(sec => sec.classList.remove("active"));
        const section = document.getElementById(targetId);
        if (section) section.classList.add("active");
      });
    });

    // Image preview
    function previewImage(event) {
      const file = event.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = e => {
        document.getElementById('imagePreview').innerHTML =
          `<img src="${e.target.result}" alt="Profile Picture">`;
      };
      reader.readAsDataURL(file);
    }

    function togglePasswordForm() {
        const form = document.getElementById('changePasswordForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }










    function checkPasswordStrength() {
    var password = document.getElementById("newPassword").value;
    var strengthText = document.getElementById("password-strength-text");
    var strengthBar = document.getElementById("password-strength-bar");

    var strength = 0;

    // Password strength criteria
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

function togglePasswordVisibility() {
    var oldPasswordField = document.getElementById("oldPassword");
    var newPasswordField = document.getElementById("newPassword");
    var confirmPasswordField = document.getElementById("confirmNewPassword");
    var eyeIcon = document.getElementById("view-password");

    // Toggle visibility for all password fields
    [oldPasswordField, newPasswordField, confirmPasswordField].forEach(function(field) {
        if (field.type === "password") {
            field.type = "text";
            eyeIcon.textContent = "🙈";  // Change the icon to "hidden"
        } else {
            field.type = "password";
            eyeIcon.textContent = "👁️";  // Change the icon to "view"
        }
    });
}


  </script>


</body>
</html>
