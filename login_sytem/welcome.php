<?php
session_start();


if (!isset($_SESSION["login"]) || $_SESSION["login"] != true) {


    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    
    <style>
        /* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
    height: 100%;
    font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
}

.welcome-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    position: relative;
    overflow: hidden;
    background: #403B4A;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #E7E9BB, #403B4A);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #E7E9BB, #403B4A); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}

.welcome-content {
    text-align: center;
    z-index: 1;
}

.welcome-text {
    font-size: 3em;
    font-weight: 700;
    color: white;
    animation: fadeIn 1.5s ease-in-out forwards;
}

.sub-text {
    font-size: 1.2em;
    margin-top: 20px;
    color: #fefefe;
    opacity: 0.9;
    animation: fadeIn 2s ease-in-out forwards;
}


.animation-bg {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,126,95,0.5) 0%, rgba(255,255,255,0.1) 80%);
    animation: rotateBg 10s infinite linear;
    z-index: 0;
}

@keyframes rotateBg {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
</head>

<body>
    <div class="welcome-container">
        <div class="welcome-content">
            <h1 class="welcome-text">Welcome to Our Website!</h1>
          
        </div>
        <div class="animation-bg"></div>
    </div>

    <script src="script.js"></script>
</body>

</html>