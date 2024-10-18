<?php
session_start();
include 'db.php';
include 'navbar.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all orders for the logged-in user
$query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <title>Your Orders</title>
    <style>
        body {
            font-family: "DM Serif Text", system-ui;
  font-weight: 400;
  font-style: normal;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #1e130c;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            background: #1e130c;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #9a8478, #1e130c);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #9a8478, #1e130c); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            border: none;
            border-radius: 8px;
            color: white;
            text-align: center;
            transition: background-color 0.3s ease;
            text-decoration: none;
            font-size: 1.1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .no-orders {
            font-size: 1.25rem;
            text-align: center;
            color: #555;
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            h2 {
                font-size: 2rem;
            }

            table th, table td {
                font-size: 0.9rem;
            }

            .btn-primary {
                font-size: 1rem;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Your Orders</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($order = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                    <td><?php echo date('F j, Y', strtotime($order['created_at'])); ?></td>
                    <td>
                        <a href="order_details.php?order_id=<?php echo $order['id']; ?>" class="btn-primary">View Details</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="no-orders">You have no orders yet.</p>
    <?php } ?>

</div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
