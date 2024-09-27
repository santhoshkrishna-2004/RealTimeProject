<?php
session_start();
error_reporting(0);
include('shortcode/config.php');

if (isset($_POST['send'])) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $brf = $_POST['brf'];
    $bloodtype = $_POST['bloodgroup'];
    $location = $_POST['location'];
    $message = $_POST['message'];

    // Insert data into tblbloodrequirer
    $sql = "INSERT INTO tblbloodrequirer(name, mobileNumber, emailId, BloodRequirefor, bloodtype, location, Message) VALUES(:name, :contactno, :email, :brf, :bloodtype, :location, :message)";
    $query = $dbh->prepare($sql);

    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':brf', $brf, PDO::PARAM_STR);
    $query->bindParam(':bloodtype', $bloodtype, PDO::PARAM_STR);
    $query->bindParam(':location', $location, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();

    if ($lastInsertId) {
        // Select data from tblblooddonars
        $sql123 = "SELECT id, FullName, BloodGroup, MobileNumber,Age,latitude,longitude FROM tblblooddonars WHERE BloodGroup = :bloodtype";
        $stmt = $dbh->prepare($sql123);
        $stmt->bindParam(':bloodtype', $bloodtype, PDO::PARAM_STR);
        $stmt->execute();
        $donors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Store data in session
        $_SESSION['donors'] = $donors;

        echo "<script type='text/javascript'> document.location ='map.php';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Blood Bank Donor Management System | Search Blood Donor</title>
  <!-- Meta tag Keywords -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Roboto+Condensed:300,400,700" rel="stylesheet">

</head>

<body class="vh-100 overflow-x-hidden">

  <?php include("shortcode/nav.php")  ?>

  <!-- contact -->

  <div class="text-center m-lg-5 pt-lg-4">
    <h1 class="title m-lg-4">Contact For Blood Donors</h1>
  </div>

  <div class="container p-5 m-5 bg-body-tertiary ">
    <form action="#" method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name" class="col-form-label">Your Name</label>
            <input type="text" class="form-control" id="name" name="fullname" placeholder="Please enter your name.">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone" class="col-form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="contactno" placeholder="Please enter your phone number.">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email" class="col-form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Please enter your email address.">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="brf" class="col-form-label">Blood Require For</label>
            <select class="form-control" id="brf" name="brf">
              <option value="">Blood Require For</option>
              <option value="Father">Father</option>
              <option value="Mother">Mother</option>
              <option value="Brother">Brother</option>
              <option value="Sister">Sister</option>
              <option value="Others">Others</option>
            </select>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="bloodgroup" class="form-label">Blood Group <span class="text-danger">*</span></label>
            <select name="bloodgroup" class="form-control" id="bloodgroup" required>
              <?php
              $sql = "SELECT * from tblbloodgroup";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                  <option value="<?php echo htmlentities($result->BloodGroup); ?>"><?php echo htmlentities($result->BloodGroup); ?></option>
              <?php }
              } ?>
            </select>
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="location" class="col-form-label">Location</label>
            <input type="tel" class="form-control" id="location" name="location" placeholder="Please enter location...">
          </div>
        </div>
      </div>


      <div class="form-group">
        <label for="message" class="col-form-label">Message</label>
        <textarea rows="5" class="form-control" id="message" name="message" placeholder="Please enter your message" maxlength="999" style="resize:none"></textarea>
      </div>
      <div class="form-group text-center mt-3">
        <input type="submit" value="Search donor" class="btn btn-outline-primary btn-md" name="send">
      </div>
    </form>
  </div>

  <!-- //Contact Form -->

  <?php include('shortcode/footer.php'); ?>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JavaScript -->
  <script src="js/medic.js"></script>
</body>

</html>