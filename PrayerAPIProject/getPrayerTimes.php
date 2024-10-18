<?php
if (isset($_GET['lat']) && isset($_GET['long'])) {
    $latitude = $_GET['lat'];
    $longitude = $_GET['long'];

    $apiUrl = "https://api.aladhan.com/v1/timings?latitude=$latitude&longitude=$longitude&method=2";

    $response = file_get_contents($apiUrl);
    echo $response;
} else {
    echo json_encode(['error' => 'Invalid location parameters']);
}
?>
