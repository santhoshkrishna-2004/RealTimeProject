<?php error_reporting(0);
session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top sticky-top m-lg-0 p-lg-0 p-sm-3  ">
    <div class="container-fluid">
    
      <a class="navbar-brand active fs-2  text-capitalize px-lg-1 " href="Home.php"><i class="fas fa-tint red-droplet "
         style="color: red;font-size: 2.2rem; padding-right:3px;"></i>Blood Donor System</a>
      
      <button class="navbar-toggler shadow-none border-0" 
           type="button" data-bs-toggle="offcanvas" 
           data-bs-target="#offcanvasNavbar" 
           aria-controls="offcanvasNavbar" 
           aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
      <div class="sidebar offcanvas offcanvas-start bg-black " tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title text-white fs-4 border-bottom" id="offcanvasNavbarLabel">Blood bank Management System</h5>
          <button type="button" class="btn-close btn-close-white " data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
        <div class="offcanvas-body d-flex flex-column p-4 flex-lg-row">
          <ul class="navbar-nav  nav-underline align-items-center  justify-content-center fs-5 flex-grow-1 m-md-0 flex-nowrap">
            <li class="nav-item mx-1">
              <a class="nav-link" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item mx-1 ">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item mx-1">
              <a class="nav-link" href="search-donor.php">Search Donor</a>
            </li>
            <li class="nav-item mx-1">
              <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
          </ul>
         
         <div class="d-flex mx-lg-2 justify-content-center align-items-center gap-lg-2 flex-column flex-lg-row gap-sm-4 flex-sm-row">
         <?php if (strlen($_SESSION['bbdmsdid']) != 0) { ?>
                   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <button class=" btn btn-outline-danger rounded-5 btn-lg text-white px-4">My Account</button>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
    </li>
               <?php } ?>
               <?php if (strlen($_SESSION['bbdmsdid']==0)) {?>

                         <a href="login.php" class="text-white btn btn-outline-danger rounded-5 btn-lg px-5 mx-lg-2">Login</a>  <?php }?>
          </div>
        </div>
      </div>
    </div>
  </nav>