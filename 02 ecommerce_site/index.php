<?php
include 'db.php';
include 'navbar.php';

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<br>
    <center><h2>Watches</h2></center>
    <br>
        <div class="row g-4 menu-items">
            <?php while ($product = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card__image">
                            <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
                        </div>
                        <div class="product-card__info">
                            <h2 class="product-card__title"><?php echo $product['name']; ?></h2>
                            <p class="product-card__description"><?php echo $product['description']; ?></p>
                            <div class="product-card__price-row">
                                <span class="product-card__price">Rs <?php echo $product['price']; ?></span>
                                <a href="cart.php?action=add&id=<?php echo $product['id']; ?>" class="product-card__btn">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="features-container">
    <div class="feature-box">
        <i class="fas fa-box feature-icon"></i>
        <h3>Secure packaging</h3>
        <p>Your items will arrive in one piece in secure packaging.</p>
    </div>
    
    <div class="feature-box">
        <i class="fas fa-shipping-fast feature-icon"></i>
        <h3>Free shipping</h3>
        <p>Don’t pay extra fees for your delivery. <br> Nationwide free delivery.</p>
    </div>
    
    <div class="feature-box">
        <i class="fas fa-wallet feature-icon"></i>
        <h3>Cash on Delivery</h3>
        <p>iCasioStore is providing easy payment methods. Bank transfer available for payment above 10,000/-.</p>
    </div>
</div>

<footer>
    
    <div class="footer-bottom">
     <p> <center>&copy; 2024 E-Commerce. All rights reserved.</center>  </p>
    </div>
</footer>

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
