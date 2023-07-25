<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Register - Waste Management System</title>
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/argon.css?v=1.1.0" type="text/css">
</head>
<?php 
require_once('./core/db-config.php');
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cpassword = password_hash($_POST['cpassword'], PASSWORD_DEFAULT);
    if($password = $cpassword){
        $sql = "INSERT INTO users (f_name,l_name,contact,password,email) VALUES('$fname','$lname','$contact','$password','$email')";
        $query = mysqli_query($conn,$sql);
        if($query){
            $error = '<div class="alert alert-success" role="alert">User Registration Succesfully Done!</div>';
        }else{
            $error = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>';
        }
    }else{
        $error = '<div class="alert alert-danger" role="alert">Password do not match.</div>';
    }
}
?>
<body class="bg-success">
    <div class="main-content">
        <div class="header bg-success py-7 py-lg-8 pt-lg-9">
        </div>
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <img src="./assets/img/brand/logo.png" width="50%" alt="">
                                <hr>
                            </div>
                            <?php if(isset($error)){ echo $error;} ?>
                            <form method="post">
                                <div class="form-row">
                                    <div class="form-group mb-3 col-md-6">
                                        <input type="text" name="fname" placeholder="First Name" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-md-6">
                                        <input type="text" name="lname" placeholder="Last Name" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group mb-3 col-md-12">
                                        <input type="email" name="email" placeholder="Email" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group mb-3 col-md-12">
                                        <input type="number" name="contact" placeholder="Contact Number" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group mb-3 col-md-6">
                                        <input type="password" name="password" placeholder="Password" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 col-md-6">
                                        <input type="password" name="cpassword" placeholder="Confirm Password" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-success btn-block my-4">Register</button>
                                </div>
                                <div class="form-row">
                                    <p>Already Registerd? <a href="./login.php"> Sign In</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="assets/js/argon.js?v=1.1.0"></script>
    <script src="assets/js/demo.min.js"></script>
</body>