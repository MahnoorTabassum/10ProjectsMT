<?php
session_start();
include 'db.php';

// Admin authentication would go here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "images/$image");

    $query = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
    mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
            background-color: #f4f7f6; /* Light background */
        }

        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 40px;
            background-color: #ffffff; /* White */
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Soft shadow */
            text-align: center;
        }

        h2 {
            font-size: 28px;
            font-weight: 600;
            color: #333333; /* Dark gray */
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-control {
            height: 45px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #e1e1e1; /* Light gray */
            border-radius: 6px;
            background-color: #fafafa; /* Very light gray */
        }

        .form-control:focus {
            border-color: #4d90fe; /* Blue highlight */
            box-shadow: 0 0 8px rgba(77, 144, 254, 0.2);
        }

        textarea.form-control {
            height: auto;
            resize: vertical;
        }

        .btn-primary {
            width: 100%;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 8px;
            background: #1e130c;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #9a8478, #1e130c);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #9a8478, #1e130c); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            border-color: #9a8478 ;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3;
        }

        /* Placeholder styling */
        ::placeholder {
            color: #888; /* Medium gray */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 30px;
                margin: 50px auto;
            }

            h2 {
                font-size: 24px;
            }

            .btn-primary {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Product Name" required>
        </div>
        <div class="form-group">
            <textarea name="description" class="form-control" placeholder="Description" required></textarea>
        </div>
        <div class="form-group">
            <input type="number" name="price" class="form-control" placeholder="Price" required>
        </div>
        <div class="form-group">
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

</body>
</html>
