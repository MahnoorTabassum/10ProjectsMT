<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayer Times</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: "DM Serif Text", system-ui;
            font-weight: 400;
            font-style: normal;
            background: #403B4A;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #E7E9BB, #403B4A);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #E7E9BB, #403B4A); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        /* Navbar Styles */
        .navbar {
            width: 100%;
            background-color: #333;
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Card Styles */
        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin-top: -10px; /* Added margin for spacing under navbar */
        }

        h1 {
            font-size: 28px;
            color: #333333;
            margin-bottom: 20px;
        }

        /* Date Section */
        .date-section {
            display: flex;
            justify-content: space-between;
            background-color: #f0f0f5;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .islamic-date, .english-date {
            width: 48%;
            text-align: center;
        }

        .islamic-date h2, .english-date h2 {
            font-size: 18px;
            color: #555555;
        }

        .islamic-date p, .english-date p {
            font-size: 16px;
            font-weight: 600;
            color: #007BFF;
        }

        /* Location Section */
        .location-section {
            margin-bottom: 20px;
        }

        #location-message {
            color: #555;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007BFF;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #28a745;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #218838;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }


        /* Prayer Times Section */
        .prayer-times {
            background-color: #f0f0f5;
            border-radius: 10px;
            padding: 15px;
        }

        .time-box {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .time-box:last-child {
            border-bottom: none;
        }

        .prayer-name {
            font-weight: 600;
            color: #333;
        }

        .prayer-time {
            color: #28a745;
            font-weight: 700;
        }

        /* City Input Section Styling */
.city-input {
   margin-left: 160px;
    display: flex;
    align-items: center;
    gap: 10px; /* Add space between input and button */
}

.city-input input {
    text-align:center;
    padding: 8px 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s ease;
    background-color: #f9f9f9;
}

.city-input input:focus {
    border-color: #007BFF;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.city-input button {
    background-color: #007BFF;
    border: none;
    color: white;
    padding: 8px 14px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.city-input button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <!-- Navbar Section -->
    <div class="navbar">
        <a href="#home">Home</a>
        <a href="#prayer-times">Prayer Times</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
    </div>

    <div class="container">
        <div class="card">
            <h1>Prayer Times</h1>

            <!-- Date Section -->
            <div class="date-section">
                <div class="islamic-date">
                    <h2>Today Islamic Date</h2>
                    <p>13 Rabi Al-Akhar 1446</p> <!-- Islamic Date -->
                </div>
                <div class="english-date">
                    <h2>Today English Date</h2>
                    <p>17 October, 2024</p> <!-- English Date -->
                </div>
            </div>

            <!-- Location Input Section -->
            <div class="location-section">
                <p id="location-message">Fetching your location...</p>
                <button id="detect-location" class="btn btn-primary">Detect Location</button>
                <form id="manual-location-form" style="display:none;">
                    <input type="text" id="city" name="city" placeholder="Enter your city" class="input-field">
                    <button type="submit" class="btn btn-secondary">Get Times</button>
                </form>
                <div class="city-input">
            <input type="text" id="city-navbar" name="city" placeholder="Enter your city">
            <button type="submit" id="submit-city-navbar">Go</button>
        </div>
    
            </div>
           

            <!-- Prayer Times Section -->
            <div class="prayer-times" id="prayer-times">
                <div class="time-box">
                    <span class="prayer-name">Fajr</span>
                    <span class="prayer-time">05:23</span>
                </div>
                <div class="time-box">
                    <span class="prayer-name">Sunrise</span>
                    <span class="prayer-time">06:25</span>
                </div>
                <div class="time-box">
                    <span class="prayer-name">Dhuhr</span>
                    <span class="prayer-time">12:20</span>
                </div>
                <div class="time-box">
                    <span class="prayer-name">Asr</span>
                    <span class="prayer-time">15:43</span>
                </div>
                <div class="time-box">
                    <span class="prayer-name">Maghrib</span>
                    <span class="prayer-time">18:14</span>
                </div>
                <div class="time-box">
                    <span class="prayer-name">Isha</span>
                    <span class="prayer-time">19:17</span>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
