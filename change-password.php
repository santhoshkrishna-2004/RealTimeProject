<?php 
session_start();
error_reporting(0);
include('shortcode/config.php');

if (strlen($_SESSION['bbdmsdid']) == 0) {
  header('location: logout.php');
} else {
  if (isset($_POST['change'])) {
    $uid = $_SESSION['bbdmsdid']; 
    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];

    // Fetch user's current hashed password from database
    $sql = "SELECT ID, Password FROM tblblooddonars WHERE id=:uid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0) {
      // Verify if the current password matches
      if (password_verify($currentpassword, $results['Password'])) {
        // Update password
        $newhashedpassword = password_hash($newpassword, PASSWORD_BCRYPT);
        $con = "UPDATE tblblooddonars SET Password=:newpassword WHERE id=:uid";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':uid', $uid, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newhashedpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        echo '<script>alert("Your password successfully changed")</script>';
      } else {
        echo '<script>alert("Your current password is wrong")</script>';
      }
    } else {
      echo '<script>alert("User not found")</script>';
    }
  }
}
?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blood Bank Donar Management System !! Change Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
  <script type="text/javascript">
    function checkpass() {
      if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value) {
        alert('New Password and Confirm Password field does not match');
        document.changepassword.confirmpassword.focus();
        return false;
      }
      return true;
    }   
  </script>
</head>
<body>
  <?php include('shortcode/nav.php');?>


  <!-- Change Password Form -->
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title text-center">Change Password</h3>
            <form action="#" method="post" onsubmit="return checkpass();" name="changepassword">
              <div class="mb-3">
                <label for="currentpassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" name="currentpassword" id="currentpassword" required>
              </div>
              <div class="mb-3">
                <label for="newpassword" class="form-label">New Password</label>
                <input type="password" class="form-control" name="newpassword" id="newpassword" required>
              </div>
              <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
              </div>
              <div class="d-grid">
                <button type="submit" name="change" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('shortcode/footer.php');?>

</body>
</html>