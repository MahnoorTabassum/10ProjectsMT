<?php

if (isset($_POST["snum"])) {
    $snumber = $_POST["snum"];
    $response = file_get_contents("https://api.alquran.cloud/v1/surah/$snumber/ar.abdurrahmaansudais");
    $response = json_decode($response, true);
    $dataQuran = $response["data"]["ayahs"];
}

// Handle search for specific Ayah
$ayahSearch = '';
if (isset($_POST['ayah_search'])) {
    $ayahSearch = intval(trim($_POST['ayah_search']));
    $dataQuran = array_filter($dataQuran, function($ayah) use ($ayahSearch) {
        return $ayah["number"] === $ayahSearch;
    });
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surah Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&display=swap" rel="stylesheet">
    <!-- Add Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Amiri Quran', serif;
            background-color: #dbc78f;
            font-size: 29px;
            text-align: center;
            background-color: #FFF3C2;
            color: #54530a;
        }

        .navbar {
            background-color: #695735 !important;
        }

        .navbar-brand {
            color: white;
            font-size: 25px;
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: white;
            transform: scale(1.05);
            text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5);
        }

        .nav-link {
            color: white !important;
            font-size: 19px;
        }

        .nav-link:hover {
            color: black !important;
            background-color: #e3e0a6;
            border-radius: 5px;
            padding: 5px;
        }

        .form-control {
            border-color: #473a21;
            border-width: 3px;
            padding: 10px;
            font-size: 18px;
        }

        .btn-warning {
            background-color: #c69c06;
            border-color: #b58b05;
            color: #fff;
            font-size: 18px;
        }

        .btn-warning:hover {
            background-color: #a88204;
            border-color: #967504;
        }

        .search-container {
            margin-top: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>


<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="quran.php">Quran Recitation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
        </div>
    </nav>
   <!-- Search Ayah Form -->
   <div class="container search-container">
        <form method="post" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input type="number" name="ayah_search" class="form-control" placeholder="Search by Ayah" value="<?= htmlspecialchars($ayahSearch) ?>">
                    <input type="hidden" name="snum" value="<?= htmlspecialchars($snumber) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-warning mt-2 w-100">Search Ayah</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if (!empty($dataQuran)) {
        foreach ($dataQuran as $value) {
            // Fetch the translation for this Ayah
            $translationResponse = file_get_contents("https://api.alquran.cloud/v1/ayah/{$value['number']}/en.sahih");
            $translationData = json_decode($translationResponse, true);
            $translationText = $translationData["data"]["text"] ?? "Translation not available";

            echo '<p>' . $value["text"] . ' (' . $value["number"] . ')</p>';
            echo '<p><strong>Translation:</strong> ' . $translationText . '</p>';
            echo '<audio controls src="' . $value["audio"] . '"></audio>';
        }
    } else {
        echo '<p>No Ayahs found.</p>';
    }
    ?>

    <!-- Add Bootstrap JS for responsive features -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>






