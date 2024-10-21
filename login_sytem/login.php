<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'base/connection.php';

    $useremail = $_POST["useremail"];
    $password = $_POST["userpass"];

    
    $sqlemail = "select * from info where Email='$useremail'";

    $result = mysqli_query($connection, $sqlemail);

    $row = mysqli_num_rows($result);


    if ($row ==1) {
       

     while ($item = mysqli_fetch_assoc($result)) {
            
           password_verify($password,$item["Password"]);
           session_start();
           $_SESSION["login"]=true;
           $_SESSION["email"]=$useremail;
           $_SESSION["name"]=$username;
         header("location:welcome.php");
        }

    } 
   
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <style>
          body {
        font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
       }
        .form-bg {
            min-height: 109vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 270px;
        }

        .form-container {
            font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
            font-size: 0;
            border-radius: 20px;
            overflow: hidden;
            max-width: 100%;
            margin-top: -150px;
            
        }

        .form-container .form-img {
            background-image: url('https://i.pinimg.com/564x/18/c1/7c/18c17c6a2db05d2a14247d67bccefef4.jpg');
            background-repeat: no-repeat;
            background-position: center center;
            width: 45%;
            height: 463px;
            vertical-align: top;
            display: inline-block;
        }

        .form-container .form-horizontal {
            background: #000;
            width: 45%;
            padding: 33px 35px 32.5px;
            display: inline-block;
             
        }

        .form-container .title {
            color: #fff;
            font-size: 25px;
            font-weight: 400;
            margin: 0 0 35px;
        }

        .form-container .form-horizontal .form-group {
            margin: 0 0 10px;
        }

        .form-container .form-horizontal .form-control {
            color: #ccc;
            background: transparent;
            padding: 5px 0;
            margin-bottom: 33px;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, .2);
            border-radius: 0px;
        }

        .form-container .form-horizontal .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        .form-container .form-horizontal .form-control::placeholder {
            color: #ccc;
            font-size: 16px;
            font-weight: 400;
        }

        .form-container .form-horizontal .form-group select.form-control option {
            color: #000;
            background: #fff;
        }

        .form-container .form-horizontal .btn {
            color: #fff;
            background: #4dae3c;
            font-size: 18px;
            letter-spacing: 1px;
            border-radius: 50px;
            padding: 8px 25px;
            border: none;
            transition: all .4s ease;
        }

        .form-container .form-horizontal .btn:hover {
            text-shadow: 2px 2px 2px rgba(0, 0, 0, .6);
        }

        .form-container .form-horizontal .btn:focus {
            outline: none;
        }

        @media only screen and (max-width:576px) {
            .form-container .form-img {
                width: 100%;
                height: 400px;
            }

            .form-container .form-horizontal {
                width: 100%;
            }
        }

        .form-container .form-horizontal .form-group {
            margin: 0 0 8px;
        }

        .form-container .form-horizontal .form-control {
            margin-bottom: 75px;
        }

        .form-container .form-horizontal .forgot {
            color: #999;
            font-size: 12px;
            text-align: right;
            width: 100px;
            vertical-align: top;
            display: inline-block;
            transition: all 0.3s ease 0s;
        }

        .form-container .form-horizontal .forgot:hover {
            text-decoration: underline;
        }

        .separator {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #ccc;
        }

        .signup-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #fff;
            font-size: 14px;
        }

        .signup-link a {
            color: #4dae3c;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

    <?php include "base/navbar.php"; ?>

    <div class="form-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="form-container">
                        <div class="form-img"></div>
                        <form class="form-horizontal" action="login.php" method="post">
                            <h3 class="title">LOGIN</h3>
                           
                            <div class="form-group">
                                <input type="email" class="form-control" name="useremail" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="userpass" placeholder="Password">
                            </div>
                           

                            <input type="submit" class="btn signin" value="Login" />
                            <br><br>

                            <a href="new_password.php" class="forgot">Forgot Password</a>

                            <span class="separator">OR</span>

                            <span class="signup-link">Don't have an account? Sign up <a href="signup.php">here</a></span>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
