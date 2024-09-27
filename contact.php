<?php
session_start();
error_reporting(E_ALL); 
include('shortcode/config.php');
if(isset($_POST['send'])) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['message'];

    $sql = "INSERT INTO tblcontactusquery (name, EmailId, ContactNumber, Message) VALUES (:name, :email, :contactno, :message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    
    $lastInsertId = $dbh->lastInsertId();

    if($lastInsertId) {
        echo '<script>alert("Query Sent. We will contact you shortly.")</script>';
    } 
    else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";  
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Blood Donor System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="overflow-x-hidden">
 
<?php include("shortcode/nav.php") ?>

  <section class="container-xxl py-5"> 
    <h1 class="text-center mb-5 p-0">Contact For Any Query</h1>
    <div class="row g-4">
      <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
          <h3>Get In Touch</h3>
          <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
          <div class="d-flex align-items-center mb-3 gap-1">
              <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                  <i class="fa fa-map-marker-alt text-white"></i>
              </div>
              <div class="ms-3">
                  <h5 class="text-primary">Office</h5>
                  <p class="mb-0">Hyderabad</p>
              </div>
          </div>
          <div class="d-flex align-items-center mb-3 gap-1">
              <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                  <i class="fa fa-phone-alt text-white"></i>
              </div>
              <div class="ms-3">
                  <h5 class="text-primary">Mobile</h5>
                  <p class="mb-0">420999999</p>
              </div>
          </div>
          <div class="d-flex align-items-center gap-1">
              <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                  <i class="fa fa-envelope-open text-white"></i>
              </div>
              <div class="ms-3">
                  <h5 class="text-primary">Email</h5>
                  <p class="mb-0">info@example.com</p>
              </div>
          </div>
      </div>

      <div class="col-lg-6 col-md-6 " >
        <h3 class="mb-3">Send Us A Message</h3>
        <form action="#" method="post">
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Name">
                <label for="fullname">Full Name</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                <label for="email">Email</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Your Phone Number">
                <label for="contactno">Phone Number</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 90px"></textarea>
                <label for="message">Message</label>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-primary rounded-3" type="submit" name="send">Send Message</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <footer class="p-2 pt-0 bg-dark">
    <div class="row d-flex align-items-center">
      <div class="col-md-7 col-lg-8 text-center text-md-start">
        <div class="p-3 text-white">
          © 2024 Copyright:
          <a class="text-white text-decoration-none" href="#">Blood Management. All rights reserved.</a>
        </div>
      </div>
      <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
        <a class="btn btn-outline-primary btn-floating m-1" class="text-white" role="button"><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-outline-info btn-floating m-1" class="text-white" role="button"><i class="fab fa-twitter"></i></a>
        <a class="btn btn-outline-light btn-floating m-1" class="text-white" role="button"><i class="fab fa-google"></i></a>
        <a class="btn btn-outline-danger btn-floating m-1" class="text-white" role="button"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>
</body>
</html>
