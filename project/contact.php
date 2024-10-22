<?php
// Start session and connect to the database
session_start();
$connection = mysqli_connect("localhost", "root", "", "shopping");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    // Insert data into the contacts table
    $query = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
    
    if (mysqli_query($connection, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Thank you for contacting us!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: Unable to submit your form. Please try again.']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Modern Shop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .contact-section {
            padding: 60px 0;
        }
        .contact-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .contact-info {
            margin-bottom: 30px;
        }
        .contact-info h4 {
            margin-bottom: 10px;
            font-weight: bold;
        }
        .contact-info p {
            margin-bottom: 0;
        }
        .navbar {
            background-color: #333;
        }
        .navbar-brand, .nav-link {
            color: white !important;
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
                <li class="nav-item ">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Shop</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container contact-section">
    <div class="row">
        <div class="col-lg-6">
            <h2>Contact Us</h2>
            <p class="mb-4">Feel free to reach out to us with any questions or concerns.</p>

            <form id="contactForm" class="contact-form">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>
                </div>
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone number" required>
                </div>
                <div class="form-group">
                    <label for="message"><i class="fas fa-comment"></i> Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Message</button>
            </form>
        </div>

        <div class="col-lg-6">
            <div class="contact-info">
                <h4>Contact Information</h4>
                <p><i class="fas fa-map-marker-alt"></i> 123 Modern Shop, City Avenue, New York, NY 12345</p>
                <p><i class="fas fa-phone"></i> (123) 456-7890</p>
                <p><i class="fas fa-envelope"></i> contact@modernshop.com</p>
            </div>

            <div>
                <h4>Find Us Here</h4>
                <div id="map-container" style="height: 300px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509433!2d144.95373631531694!3d-37.81720997975192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf0727e79993ef3be!2sFederation%20Square!5e0!3m2!1sen!2sau!4v1600132762837!5m2!1sen!2sau" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Handle form submission using AJAX
$('#contactForm').on('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    $.ajax({
        url: 'contact.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent',
                    text: response.message
                });
                $('#contactForm')[0].reset(); // Clear form
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        }
    });
});
</script>

</body>
</html>
