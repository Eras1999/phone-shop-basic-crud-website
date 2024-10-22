<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Shop - Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <style>
        .navbar {
            background-color: #333;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .carousel-inner img {
            width: 100%;
            height: 700px;
        }
        .features-section {
            padding: 60px 0;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
        }
        .feature-box i {
            font-size: 50px;
            margin-bottom: 20px;
            color: #66afe9;
        }
        .shop-now-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            text-decoration: none;
        }
        .shop-now-btn:hover {
            background-color: #218838;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Modern Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Image Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100" src="1.jpg" alt="First slide">          
             <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to Modern Shop</h5>
                    <p>Your one-stop shop for all the best products.</p>
                </div>
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="2.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Exclusive Deals</h5>
                    <p>Grab your favorite items at discounted prices.</p>
                </div>
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" src="3.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>New Arrivals</h5>
                    <p>Check out the latest products in stock.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 feature-box">
                    <i class="fas fa-shipping-fast"></i>
                    <h3>Free Shipping</h3>
                    <p>Get free shipping on all orders over $50.</p>
                </div>
                <div class="col-md-4 feature-box">
                    <i class="fas fa-exchange-alt"></i>
                    <h3>Easy Returns</h3>
                    <p>30-day hassle-free returns on all items.</p>
                </div>
                <div class="col-md-4 feature-box">
                    <i class="fas fa-headphones-alt"></i>
                    <h3>24/7 Support</h3>
                    <p>We're here to help anytime, anywhere.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Button -->
    <div class="text-center" style="margin-bottom: 50px;">
        <a href="index.php" class="shop-now-btn">Shop Now</a>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Modern Shop. All Rights Reserved.</p>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
