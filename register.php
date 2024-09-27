<?php
session_start();
error_reporting(E_ALL);
include('shortcode/config.php');

if (isset($_POST['register'])) {
    $fullname = htmlspecialchars($_POST['fullname']);
    $mobile = htmlspecialchars($_POST['mobilenumber']);
    $email = filter_var($_POST['emailid'], FILTER_SANITIZE_EMAIL);
    $age = (int)$_POST['age'];
    $gender = htmlspecialchars($_POST['gender']);
    $bloodgroup = htmlspecialchars($_POST['bloodgroup']);
    $address = htmlspecialchars($_POST['address']);
    $message = htmlspecialchars($_POST['message']);
    $status = 1;
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $latitude = $_POST['latitude']; // Retrieve latitude from form
    $longitude = $_POST['longitude']; // Retrieve longitude from form

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
    } else {
        $ret = "SELECT EmailId FROM tblblooddonars WHERE EmailId=:email";
        $query = $dbh->prepare($ret);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() == 0) {
            $sql = "INSERT INTO tblblooddonars (FullName, MobileNumber, EmailId, Age, Gender, BloodGroup, Address, Message, status, Password, latitude, longitude) 
                    VALUES (:fullname, :mobile, :email, :age, :gender, :bloodgroup, :address, :message, :status, :password, :latitude, :longitude)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_INT);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':message', $message, PDO::PARAM_STR);
            $query->bindParam(':status', $status, PDO::PARAM_INT);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':latitude', $latitude, PDO::PARAM_STR); // Bind latitude to the parameter
            $query->bindParam(':longitude', $longitude, PDO::PARAM_STR); // Bind longitude to the parameter
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId) {
                echo "<script>alert('You have registered successfully');</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again');</script>";
            }
        }
         else {
            echo "<script>alert('Email-id already exists. Please try again');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        }
    </script>

</head>

<body>
<?php include("shortcode/nav.php")  ?>
    <!-- Page Content -->
    <div class="container pt-1">
        <div class="text-bg-light p-3 mt-4 mb-3"><h1>Become a Donor</h1></div>
        <form name="register" method="post" action="#">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Full Name<span style="color:red">*</span></div>
                    <div><input type="text" name="fullname" id="fullname" class="form-control" required></div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
                    <div><input type="text" name="mobilenumber" class="form-control" required></div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="font-italic">Email Id</div>
                    <div><input type="email" name="emailid" class="form-control"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Age<span style="color:red">*</span></div>
                    <div><input type="number" name="age" class="form-control" required></div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Gender<span style="color:red">*</span></div>
                    <div>
                        <select name="gender" class="form-control" required>
                            <option selected>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Blood Group<span style="color:red">*</span></div>
                    <div>
                        <select name="bloodgroup" class="form-control" aria-label="Default select example" required>
                            <option selected>Select</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Address</div>
                    <div><textarea class="form-control" name="address"></textarea></div>
                </div>
                <div class="col-lg-8 mb-4">
                    <div class="font-italic">Message<span style="color:red">*</span></div>
                    <div><textarea class="form-control" name="message" required></textarea></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <div class="font-italic">Password<span style="color:red">*</span></div>
                    <div><input type="password" class="form-control" name="password" required></div>
                </div>
                <!-- Hidden inputs for latitude and longitude -->
                <input type="hidden" name="latitude" id="latitude" value="">
                <input type="hidden" name="longitude" id="longitude" value="">

                <div class="col-lg-3 mb-4">
                    <button type="button" class="btn btn-info btn-md my-4" onclick="getLocation()">Get My Location</button><br><br>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div><input type="submit" name="register" class="btn btn-primary btn-lg" value="Register" style="cursor:pointer"></div>
            </div>
        </form>
    </div>

    <footer class="mt-4 p-2 bg-dark">
        <div class="row d-flex align-items-center">
            <div class="col-md-7 col-lg-8 text-center text-md-start">
                <div class="p-3 text-white">© 2024 Copyright: <a class="text-white text-decoration-none" href="#">Blood Management. All rights reserved.</a></div>
            </div>
            <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                <a class="btn btn-outline-primary btn-floating m-1" role="button"><i class="fab fa-facebook-f facebook"></i></a>
                <a class="btn btn-outline-info btn-floating m-1" role="button"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-google google"></i></a>
                <a class="btn btn-outline-danger btn-floating m-1" role="button"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
