<?php 
session_start();
error_reporting(0);
include('shortcode/config.php');
if (strlen($_SESSION['bbdmsdid']==0)) {
  header('location:logout.php');
} 
else {

 if(isset($_POST['update'])) {
    $uid=$_SESSION['bbdmsdid'];
    $name=$_POST['fullname'];
    $mno=$_POST['mobileno']; 
    $emailid=$_POST['emailid'];
    $age=$_POST['age']; 
    $gender=$_POST['gender'];
    $bloodgroup=$_POST['bloodgroup']; 
    $address=$_POST['address'];
    $message=$_POST['message']; 
    $sql="update tblblooddonars set FullName=:name,MobileNumber=:mno, Age=:age,Gender=:gender,BloodGroup=:bloodgroup,Address=:address,Message=:message where id=:uid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':mno',$mno,PDO::PARAM_STR);
    $query->bindParam(':age',$age,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->bindParam(':uid',$uid,PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Profile has been updated")</script>';
  }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Blood Bank Donor Management System !! Donor Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
</head>
<body>
    <?php include('shortcode/nav.php');?>

    <div class="container my-5">
        <h3 class="text-center mb-5">Donor Profile</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="#" method="post">
                    <?php
                    $uid=$_SESSION['bbdmsdid'];
                    $sql="SELECT * from tblblooddonars where id=:uid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0) {
                    foreach($results as $row) { ?>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $row->FullName;?>">
                        </div>
                        <div class="mb-3">
                            <label for="mobileno" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" name="mobileno" id="mobileno" required="true" maxlength="10" pattern="[0-9]+" value="<?php echo $row->MobileNumber;?>">
                        </div>
                        <div class="mb-3">
                            <label for="emailid" class="form-label">Email Id <span class="text-danger" style="font-size:10px;">(Can't be Changed)</span></label>
                            <input type="email" name="emailid" class="form-control" value="<?php echo $row->EmailId;?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="text" class="form-control" name="age" id="age" required value="<?php echo $row->Age;?>">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" required>
                                <option value="<?php echo $row->Gender;?>"><?php echo $row->Gender;?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bloodgroup" class="form-label">Blood Group</label>
                            <select name="bloodgroup" class="form-select" required>
                                <option value="<?php echo $row->BloodGroup;?>"><?php echo $row->BloodGroup;?></option>
                                <?php 
                                $sql = "SELECT * from tblbloodgroup";
                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0) {
                                foreach($results as $result) { ?>  
                                    <option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
                                <?php }} ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" required value="<?php echo $row->Address;?>">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" name="message" required><?php echo $row->Message;?></textarea>
                        </div>
                    <?php }} ?>
                    <div class="d-grid">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('shortcode/footer.php');?>

</body>
</html>
<?php } ?>
