<?php
session_start();
include('shortcode/config.php'); // Adjust the path as per your file structure

if(isset($_POST['login'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // Check if it's an admin login attempt
    $sql_admin = "SELECT UserName, Password FROM tbladmin WHERE Email = :email AND Password = :password";
    $query_admin = $dbh->prepare($sql_admin);
    $query_admin->bindParam(':email', $email, PDO::PARAM_STR);
    $query_admin->bindParam(':password', $password, PDO::PARAM_STR);
    $query_admin->execute();
    $result_admin = $query_admin->fetch(PDO::FETCH_OBJ);
    
    // Check if it's a user login attempt if admin login fails
    if(!$result_admin) {
        $sql_user = "SELECT id, Password FROM tblblooddonars WHERE EmailId = :email";
        $query_user = $dbh->prepare($sql_user);
        $query_user->bindParam(':email', $email, PDO::PARAM_STR);
        $query_user->execute();
        $result_user = $query_user->fetch(PDO::FETCH_OBJ);
        
        if($result_user && password_verify($password, $result_user->Password)) {
            $_SESSION['bbdmsdid'] = $result_user->id;
            echo "<script type='text/javascript'> document.location ='Home.php'; alert('Successfully Login');</script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    } else {
        $_SESSION['alogin'] = $email;
        echo "<script type='text/javascript'> document.location = 'admin/dashboard.php'; </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank</title>
    <link rel="stylesheet" href="CSS3/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top m-lg-0 p-lg-0 p-sm-3">
        <div class="container-fluid">
            <a class="navbar-brand active fs-2 text-capitalize px-lg-1" href="Home.php"><i class="fas fa-tint red-droplet" style="color: red;font-size: 2.2rem; padding-right:3px;"></i>Blood Donor System</a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas offcanvas-start bg-black" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white fs-4 border-bottom" id="offcanvasNavbarLabel">Blood Bank Management System</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column p-4 flex-lg-row">
                    <ul class="navbar-nav nav-underline align-items-center justify-content-center fs-5 flex-grow-1 m-md-0 flex-nowrap">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="search-donor.php">Search Donor</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="admin/index.php">Admin</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-center align-items-center gap-lg-5 flex-column flex-lg-row gap-md-2">
                        <a href="login.php" class="text-white btn btn-outline-danger rounded-5 btn-lg px-5">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section>
        <div class="container">
            <div class="heading">Login</div>
            <form action="#" method="post" class="form">
                <input required="" class="input" type="email" name="email" id="email" placeholder="E-mail">
                <input required="" class="input" type="password" name="password" id="password" placeholder="Password">
                <span class="forgot-password"><a href="#">Forgot Password?</a></span>
                <input class="login-button" type="submit" name="login" value="Login">
            </form>
            <div class="social-account-container">
                <span class="title">Or Sign in with</span>
                <div class="social-media">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <p class="text-center my-4 fs-5">
                Don't have an account? <a href="register.php" class="text-decoration-none fw-bolder text-danger">Create one now</a>
            </p>
        </div>
    </section>
</body>
</html>
