<?php
session_start();
$a=array();
include("config.php");
if(isset($_POST['login'])){
$email=$_POST['email'];
$password=$_POST['password'];
$id=$_POST['id'];


if($email == NULL){
    $a["email_null"] = true;
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $a["email_format"] = true;
}
if($password == NULL){
    $a["password_null"] = true;
}

if(count($a) == 0){
$que= "SELECT  * FROM user_register WHERE email='$email' && password='$password'";
$result=mysqli_Query($conn,$que);
$count=mysqli_fetch_array($result);


if($count>0){
    header("location:index.php");
  $_SESSION['email']=$_POST['email'];
  $_SESSION['name']=$_POST['name'];

//   $_SESSION['user_id'] = $id;
}else{
$a["msg"] = true; 
}
}
}


//register process
if(isset($_POST['register'])){
$name=$_POST['name'];
$gender=$_POST['gender'];
$dob=$_POST['dob'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];


if($name == NULL){
    $a["name_null"] = true;
}
// if($gender == NULL){
//     $a["gender_null"] = true;
// }
if($dob == NULL){
    $a["dob_null"] = true;
}
if($phone == NULL){
    $a["phone_null"] = true;
}
if($email == NULL){
    $a["email_null"] = true;
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $a["email_format"] = true;
}
if($password == NULL){
    $a["password_null"] = true;
}
// if(count($a) == 0){
// $que= "INSERT INTO `user_register` (`name`, `gender`, `dob`, `phone`, `email`, `password`) VALUES ('$name', '$gender', '$dob', '$phone', '$email', '$password');";
// $result=mysqli_Query($conn,$que);

// if ($result == true) {
//     // After successful registration, you might want to log the user in directly
//     $_SESSION['user_id'] = mysqli_insert_id($conn); // Get the last inserted ID
//     $_SESSION['email'] = $email; // Store email in session
//     header("location:index.php");
//     exit(); // Ensure no further code is executed after redirect
// } else {
//     $a["msg"] = true;
// }
// // $count=mysqli_fetch_array($result);

// if($result==true){
//     header("location:login-register.php");
// }else{
//     $a["msg"] = true; 
//     }

// }

}
?>


<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="SemiColonWeb">
    <meta name="description"
        content="Get Canvas to build powerful websites easily with the Highly Customizable &amp; Best Selling Bootstrap Template, today.">

    <!-- Font Imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital@0;1&display=swap"
        rel="stylesheet">

    <!-- Core Style -->
    <link rel="stylesheet" href="csss/style.css">

    <!-- Font Icons -->
    <link rel="stylesheet" href="csss/font-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="csss/custom.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Document Title
	============================================= -->
    <title>Login - JObSeeker</title>

</head>

<body class="stretched">

    <!-- Document Wrapper
	============================================= -->
    <div id="wrapper">


        <!-- <header id="header" class="full-header">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">-->


        <!--	</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header> -->



        <!-- Content
		============================================= -->
        <section id="content">
            <div class="content-wrap">
                <div class="container">

                    <div class="mx-auto mb-0" id="tab-login-register" style="max-width: 500px;">

                        <ul class="nav canvas-alt-tabs2 tabs nav-pills justify-content-center mb-3" id="canvas-tab-nav2"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tab-login-tab" data-bs-toggle="pill"
                                    data-bs-target="#tab-login" type="button" role="tab" aria-controls="tab-login"
                                    aria-selected="true">Login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-register-tab" data-bs-toggle="pill"
                                    data-bs-target="#tab-register" type="button" role="tab" aria-controls="tab-register"
                                    aria-selected="false">Register</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="tab-login" role="tabpanel"
                                aria-labelledby="canvas-tab-login-tab" tabindex="0">
                                <div class="card mb-0">
                                    <div class="card-body" style="padding: 40px;">
                                        <form id="login-form" name="login-form" class="mb-0" action="" method="post">

                                            <h3>Login to your Account</h3>

                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for="login-form-username">Email:</label>
                                                    <input type="email" id="login-form-username" name="email" value="<?php if(isset($_POST['login'])){echo $email;}?>"
                                                        class="form-control">
                                                        <input type="hidden" name="id">
                                                </div>
                                                <div class="mb-2 text-danger">
                                                    <span >
                                                        <?php
                                                        if(array_key_exists("email_null",$a)){
                                                            echo "Please Enter Your Email.";
                                                        }
                                                       elseif(array_key_exists("email_format",$a)){
                                                            echo "Please Enter Valid Email.";
                                                        }
                                                        ?>
                                                    </span>
                                                </div>

                                                <div class="col-12 form-group">
                                                    <label for="login-form-password">Password:</label>
                                                    <input type="password" id="login-form-password" name="password"
                                                    value="<?php if(isset($_POST['login'])){echo $password;}?>" class="form-control">
                                                </div>

                                                <div class="mb-2 text-danger">
                                                    <span >
                                                        <?php
                                                        if(array_key_exists("password_null",$a)){
                                                            echo "Please Enter Your Password.";
                                                        }
                                                      
                                                        ?>
                                                    </span>
                                                </div>

                                                <div class="col-12 form-group">
                                                    <div class="d-flex justify-content-between">
                                                        <button class="button button-3d button-black m-0"
                                                            id="login-form-submit" name="login"
                                                            value="login">Login</button>
                                                        <a href="forget-password.php">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab-register" role="tabpanel"
                                aria-labelledby="canvas-tab-register-tab" tabindex="0">
                                <div class="card mb-0">
                                    <div class="card-body" style="padding: 40px;">
                                        <h3>Register for an Account</h3>

                                        <form id="register-form" name="register-form" class="row mb-0" action=""
                                            method="post">

                                            <div class="col-12 form-group">
                                                <label for="register-form-name">Name:</label>
                                                <input type="text" id="register-form-name" name="name" value="<?php if(isset($_POST['register'])){echo $name;}?>"
                                                    class="form-control" >
                                            </div>

                                            <div class="mb-2 text-danger">
                                                    <span >
                                                        <?php
                                                        if(array_key_exists("name_null",$a)){
                                                            echo "Please Enter Your Name.";
                                                        }
                                                      
                                                        ?>
                                                    </span>
                                                </div>

                                            <div class="col-12 form-group">
                                                <label for="register-form-name">Gender:</label>
                                                <div class="btn-group d-flex" data-bs-toggle="buttons">
                                                    <input type="radio" class="btn-check" name="gender"
                                                        id="jobs-application-gender-male" value="Male">
                                                    <label class="btn btn-outline-secondary text-transform-none ls-0"
                                                        for="jobs-application-gender-male">Male</label>

                                                    <input type="radio" class="btn-check" name="gender"
                                                        id="jobs-application-gender-female" value="Female">
                                                    <label class="btn btn-outline-secondary text-transform-none ls-0"
                                                        for="jobs-application-gender-female">Female</label>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group">
                                                <label for="register-form-dob">Date Of Birth:</label>
                                                <input type="date" id="register-form-dob" name="dob" value="<?php if(isset($_POST['register'])){echo $dob;}?>"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-2 text-danger">
                                                    <span >
                                                        <?php
                                                        if(array_key_exists("dob_null",$a)){
                                                            echo "Please Enter Your Date Of Birth.";
                                                        }
                                                      
                                                        ?>
                                                    </span>
                                                </div>

                                            <div class="col-12 form-group">
                                                <label for="register-form-email">Email Address:</label>
                                                <input type="text" id="email" name="email" value="<?php if(isset($_POST['register'])){echo $email;}?>" class="form-control">
                                            </div>

                                            <div class="mb-2 text-danger">
                                                    <span >
                                                        <?php
                                                        if(array_key_exists("email_null",$a)){
                                                            echo "Please Enter Your Email.";
                                                        }
                                                       elseif(array_key_exists("email_format",$a)){
                                                            echo "Please Enter Valid Email.";
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            
                                            <div class="col-12 form-group">
                                                <label for="register-form-phone">Phone:</label>
                                                <input type="text" id="phone" name="phone" value="<?php if(isset($_POST['register'])){echo $phone;}?>" class="form-control" pattern="[1-9]{1}[0-9]{9}" title="Enter 10 Digit Mobile Number">
                                            </div>

                                            <div class="mb-2 text-danger">
                                                    <span >
                                                        <?php
                                                        if(array_key_exists("phone_null",$a)){
                                                            echo "Please Enter Your Phone No.";
                                                        }
                                                        ?>
                                                    </span>
                                                </div>

                                            <div class="col-12 form-group">
                                                <label for="register-form-password">Choose Password:</label>
                                                <input type="password" id="password" name="password" value="<?php if(isset($_POST['register'])){echo $password;}?>"
                                                    class="form-control" >
                                            </div>

                                            <div class="mb-2 text-danger">
                                                    <span >
                                                        <?php
                                                        if(array_key_exists("password_null",$a)){
                                                            echo "Please Enter Your Password.";
                                                        }
                                                      
                                                        ?>
                                                    </span>
                                                </div>

                                            <!-- <div class="col-12 form-group">
                                                    <label for="register-form-repassword">Re-enter Password:</label>
                                                    <input type="password" id="register-form-repassword"
                                                        name="register-form-repassword" value="" class="form-control">
                                                </div> -->

                                            <div class="col-12 form-group">
                                                <button class="button button-3d button-black m-0"
                                                    id="register-form-submit" name="register" value="register">Register
                                                    Now</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section><!-- #content end -->



    </div><!-- #wrapper end -->


    <!-- JavaScripts
	============================================= -->
    <script src="jss/plugins.min.js"></script>
    <script src="jss/functions.bundle.js"></script>

</body>

</html>