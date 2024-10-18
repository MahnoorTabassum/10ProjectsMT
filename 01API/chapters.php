<?php


if (isset($_POST["booksSlug"])) {
    $bookslug = $_POST["booksSlug"];
    $apikey = '$2y$10$BylaBcXs5Lw7ZOtYmQ3PXO1x15zpp26oc1FeGktdmF6YeYoRd88e';
    $response = file_get_contents("https://hadithapi.com/api/$bookslug/chapters?apiKey=$apikey");

    $response = json_decode($response, true);

    // print_r($response["books"]);

    $hadithchapters = $response["chapters"];
} ?>



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
.btn {
    background-color: #54530a; 
    border-color: #d4af37; 
   
    
}

.btn:hover {
    background-color: #d4af37; 
    color: #ffffff; 
    border-color: #d4af37;
}
        @font-face {
            font-family: "jameel";
            src: url(fonts/jameel.ttf);
        }

        .arabic {
            font-family: 'Amiri Quran', serif;
            font-size: 26px; 
        }

        .urdu {
            font-family: "jameel";
            color:#034A01;

        }
       
        .card-img-top{
            width: 280px; 
            height: 360px;
        }

.card {
    background-color: #FFF3C2;
    border-color: #034A01;
    font-size: 26px; 
    border-width: 8px;
    color: #54530a; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    padding: 10px;
    box-sizing: border-box;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-20px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    border-color: #3c6638; 
}

    </style>


</head>

<body>
<?php
         include 'navbar.php';

    ?>
    <br>
    <div class="container">
        <div class="row">
            <?php
            foreach ($hadithchapters as $value) {



                echo '
                  <div class="col-md-6 col-sm-12 mb-4">

                <div class="card" ">
                
                    <div class="card-body">
                        <h5 class="card-title arabic" >' . $value["chapterArabic"] . '</h5>
                        <p class="card-text urdu">  ' . $value["chapterUrdu"] . ' </p>
                        <p class="card-text urdu">  ' . $value["chapterEnglish"] . ' </p>
                           <form action="hadith.php" method="post">


                <input type="hidden"  name="booksSlug" value="' . $value['bookSlug'] . '">
                <input type="hidden"  name="chapnum" value="' . $value['chapterNumber'] . '">

                <input type="submit" class="btn btn-dark" value="Read Hadiths">



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