<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'base/connection.php';


    $userfname = $_POST["userfname"];
    $userlname = $_POST["userlname"];
    $usergender = $_POST["usergender"];
    $useremail = $_POST["useremail"];
    $password = $_POST["userpass"];
    $confirmpassword = $_POST["usercpass"];
    $uphone = $_POST["uphone"];




    $sqlemail = "select * from info where Email='$useremail'";

    $result = mysqli_query($connection, $sqlemail);

    $row = mysqli_num_rows($result); //1


    if ($row > 0) {
        echo "useremail already exist";
    } else {

        if ($password == $confirmpassword) {

            $hashpass= password_hash($password,PASSWORD_DEFAULT);

            $sqlinsert = "INSERT INTO `info`(`Firstname`, `Lastname`, `Gender`, `Email`, `Password`, `Phone`) VALUES ('$userfname','$userlname ', '$usergender', '$useremail','$hashpass','$uphone')";

            $resultins = mysqli_query($connection, $sqlinsert);
            if ($resultins) {
                echo "inserted";
                header("Location: login.php");
            }
        } else {
            echo "password doesnot match";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
         body {
        font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
       }

        .form-bg {
    min-height: 113vh; 
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 200px;

}

        .form-container{
            font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
    font-size: 0;
    border-radius: 20px;
    overflow: hidden;
    max-width: 100%; 
    margin-top: -150px;
    
}
.form-container .form-img{
    background-image: url('https://i.pinimg.com/564x/18/c1/7c/18c17c6a2db05d2a14247d67bccefef4.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    width: 50%;
    height: 538px;
    vertical-align: top;
    display: inline-block;
}
.form-container .form-horizontal{
    background: #000;
    width: 50%;
    padding: 33px 35px 32.5px;
    display: inline-block;
}
.form-container .title{
    color:#fff;
    font-size: 25px;
    font-weight: 400;
    margin: 0 0 35px;
}
.form-container .form-horizontal .form-group{ margin: 0 0 10px; }
.form-container .form-horizontal .form-control{
    color: #ccc;
    background: transparent;
    padding: 5px 0;
    margin-bottom: 33px;
    border: none;
    border-bottom: 1px solid rgba(255,255,255,.2);
    border-radius: 0;
}
.form-container .form-horizontal .form-control:focus{
    outline: none;
    box-shadow: none;
}
.form-container .form-horizontal .form-control::placeholder{
    color: #ccc;
    font-size: 16px;
    font-weight: 400;
}
.form-container .form-horizontal .form-group select.form-control option{
    color: #000;
    background: #fff;
}
.form-container .form-horizontal .btn{
    color: white;
    background:#4dae3c;
    font-size: 18px;
    letter-spacing: 1px;
    border-radius: 50px;
    padding: 8px 25px;
    border: none;
    transition: all .4s ease;
}
.form-container .form-horizontal .btn:hover{ text-shadow: 2px 2px 2px rgba(0,0,0,.6); }
.form-container .form-horizontal .btn:focus{ outline: none; }
@media only screen and (max-width:576px){
    .form-container .form-img{
        width: 100%;
        height: 400px;
    }
    .form-container .form-horizontal{ width: 100%; }
}
.form-container .form-horizontal .form-group {
    margin: 0 0 8px; 
}

.form-container .form-horizontal .form-control {
    margin-bottom: 17px; 
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
                    <form class="form-horizontal"  action="signup.php" method="post">
                        <h3 class="title">SIGN UP</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" name="userfname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="userlname" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="usergender" >
                                <option value="none" selected="">Gender</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="useremail" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="userpass" placeholder="Password">
                        </div>
                        <div class="form-group">
                                    <input type="password" name="usercpass" class="form-control" placeholder="Confirm Password">
                                </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="uphone" placeholder="Phone">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        
                    </form>
                
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>