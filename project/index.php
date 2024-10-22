<?php
    session_start(); // Start a new session or resume the existing session to store shopping cart data.
    
    $db_name = "shopping"; // The name of the database.
    $connection = mysqli_connect("localhost","root","",$db_name); // Establish a connection to the MySQL database.

    // Check if the "add" button is clicked (i.e., if the form is submitted).
    if(isset($_POST["add"])){
        // Check if the shopping cart session variable exists.
        if(isset($_SESSION["shopping_cart"])){
            // Retrieve all product IDs in the shopping cart and store them in an array.
            $item_array_id = array_column($_SESSION["shopping_cart"],"product_id");

            // If the product ID (from GET) is not already in the cart, add the product to the cart.
            if(!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["shopping_cart"]); // Count the current number of items in the cart.
                // Create an array for the selected product's details.
                $item_array = array(
                    'product_id' => $_GET["id"], // Product ID from GET parameter.
                    'product_name' => $_POST["hidden_name"], // Product name hidden in the form.
                    'product_price' => $_POST["hidden_price"], // Product price hidden in the form.
                    'product_quantity' => $_POST["quantity"], // User input quantity from the form.
                );
                $_SESSION["shopping_cart"][$count] = $item_array; // Add the product to the session array.
                echo '<script>window.location="index.php"</script>'; // Redirect to index.php after adding the product.
            }else{
                // If the product is already in the cart, display an alert.
                echo '<script>alert("Product is already in  the cart")</script>';
                echo '<script>window.location="index.php"</script>'; // Redirect to index.php after alert.
            }
        }else{
            // If the shopping cart doesn't exist, initialize it with the first product.
            $item_array = array(
                'product_id' => $_GET["id"], // Product ID from GET.
                'product_name' => $_POST["hidden_name"], // Hidden product name.
                'product_price' => $_POST["hidden_price"], // Hidden product price.
                'product_quantity' => $_POST["quantity"], // User input quantity.
            );
            $_SESSION["shopping_cart"][0] = $item_array; // Initialize the shopping cart with this product.
        }
    }

    // Check if there is any action in the GET parameters (e.g., "delete" action).
    if(isset($_GET["action"])){
        // If the action is "delete," remove the product from the cart.
        if($_GET["action"] == "delete"){
            foreach($_SESSION["shopping_cart"] as $keys => $value){
                // If the product ID matches, remove it from the session array.
                if($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["shopping_cart"][$keys]); // Remove the item from the cart.
                    echo '<script>alert("Product has been removed")</script>'; // Alert the user.
                    echo '<script>window.location="index.php"</script>'; // Redirect to index.php.
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <style>
        .product{
            border: 1px solid #eaeaec; /* Product border */
            margin: 2px 2px 8px 2px; /* Margin between products */
            padding: 10px; /* Inner padding */
            text-align: center; /* Center-align text */
            background-color: #efefef; /* Light background */
        }
        table,th,tr{
              text-align: center; /* Center-align table content */
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Shop</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="width: 65%">
        <h2>Shopping Cart</h2>
        <?php
            // Fetch all products from the database and display them.
            $query = "select * from product order by id asc"; // SQL query to select all products.
            $result = mysqli_query($connection,$query); // Execute the query.
            if(mysqli_num_rows($result)>0){ // Check if there are any results.
                while($row = mysqli_fetch_array($result)){ // Fetch each product's data.
                    ?>
                    <div class="col-md-3" style="float: left;">
                        <!-- Form for adding products to the cart -->
                        <form method="post" action="index.php?action=add&id=<?php echo $row["id"];?>">
                            <div class="product">
                                <img src="<?php echo $row["image"];?>" width="190px" height="200px" class="img-responsive"> <!-- Product image -->
                                <h5 class="text-info"><?php echo $row["description"];?></h5> <!-- Product description -->
                                <h5 class="text-danger"><?php echo $row["price"];?></h5> <!-- Product price -->
                                <input type="text" name="quantity" class="form-control" value="1"> <!-- Quantity input -->
                                <!-- Hidden fields to store product details -->
                                <input type="hidden" name="hidden_name" value="<?php echo $row["description"];?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to cart"> <!-- Add to cart button -->
                            </div>
                        </form>
                    </div>
        <?php
                }
            }
        ?>

        <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Description</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="17%">Remove Item</th>
            </tr>
            <?php
                // Check if there are any items in the shopping cart session.
                if(!empty($_SESSION["shopping_cart"])){
                    $total=0; // Initialize total price.
                    foreach($_SESSION["shopping_cart"] as $key => $value){ // Loop through each item in the cart.
                    ?>
                <tr>
                        <td><?php echo $value["product_name"];?></td> <!-- Display product name -->
                        <td><?php echo $value["product_quantity"];?></td> <!-- Display product quantity -->
                        <td><?php echo $value["product_price"];?></td> <!-- Display product price -->
                        <td><?php echo number_format($value["product_quantity"]*$value["product_price"],2);?></td> <!-- Calculate and display total price for the product -->
                        <td><a href="index.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td> <!-- Link to remove the product -->
                </tr>
                <?php
                    // Add the product's total price to the overall total.
                    $total = $total + ($value["product_quantity"]*$value["product_price"]);
                    }
                ?>
                <tr>
                        <td colspan="3" align="right">Total</td> <!-- Display the overall total -->
                        <td align="right"><?php echo number_format($total,2);?></td> <!-- Show formatted total price -->
                        <td></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>

    </div>
</body>
</html>
