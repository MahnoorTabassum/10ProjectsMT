<?php

$apikey = '$2y$10$BylaBcXs5Lw7ZOtYmQ3PXO1x15zpp26oc1FeGktdmF6YeYoRd88e';
$response = file_get_contents("https://hadithapi.com/api/books?apiKey=$apikey");

$response = json_decode($response, true);

// print_r($response["books"]);

$hadithbooks = $response["books"];


?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400..700&display=swap" rel="stylesheet">


    <style>
        body {
    font-family: "jameel";
    background-color: #d4c977;
    color: #54530a; 
}

@font-face {
    font-family: "jameel";
    src: url(fonts/jameel.ttf);
}

.btn {
    background-color: #54530a; 
    border-color: #d4af37; 
   
    
}

.btn:hover {
    background-color: #d4af37; 
    color: #ffffff; 
    border-color: #d4af37;
}

.card {
    background-color: #FFF3C2;
    border-color: #034A01;
    border-width: 8px;
    width: 200px;
    height: 270px;
    color: #54530a; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    padding: 15px;
    box-sizing: border-box;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-20px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    border-color: #3c6638; 
} 
.card-text {
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 10px;
}

h1 {
    color: #034A01;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    font-family: serif;
    font-size: 2.3rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    transition: color 0.4s ease, transform 0.4s ease, text-shadow 0.4s ease;
}
 h1:hover {
    color: #0c5717; 
    transform: scale(1.05); 
    text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5); 
}
.card-title {
    color: #034A01;
    font-family: 'Aref Ruqaa', serif;
    font-weight: 600;
}

.container {
    padding-top: 20px;
}

.row {
    justify-content: center;
}

.navbar {
    background-color: #9e9657!important;
    
}

.navbar-brand{
    color: white;
    font-weight: 60px;
    font-size: 25px;
    font-weight:25px;
}
.navbar-brand:hover{
    color: #0c5717; 
    transform: scale(1.05); 
    text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5); 
}
.nav-link {
    color: white;
    font-weight: 60px;
    font-size: 19px;
}
.nav-link:hover{
    color: black !important;
    background-color: #e3e0a6;
    border-radius: 5px;
    
}



    </style>

</head>

<body>
<?php include 'navbar.php'?>
<h1><center>The Hadith of the Prophet Muhammad (صلى الله عليه و سلم)</center></h1>
    <div class="container">
        <div class="row">
        
            <?php
             

            foreach ($hadithbooks as  $value) {



                echo '
                  <div class="col-md-4 col-sm-6 mb-4">

                <div class="card" style="width: 18rem;">
                            
                    <div class="card-body">
                        <h3 class="card-title">' . $value["bookName"] . '</h3>
                        <p class="card-text">  ' . $value["writerName"] . '</p>
                        <p class="card-text"> Hadith Chapters' . $value["chapters_count"] . ' | Total Hadith ' . $value["hadiths_count"] . '</p>
                           <form action="chapters.php" method="post">


                <input type="hidden"  name="booksSlug" value="' . $value['bookSlug'] . '">
<div class="cardbtn">

                <input type="submit" class="btn btn-dark" value="Read Chapters">
</div>


            </form>
                    </div>
                </div>
            </div>
                
                
                ';
            }

            ?>








        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>