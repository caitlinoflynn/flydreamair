<?php
include("../path.php");
include(ROOT_PATH . "/app/database/config.php");


if(isset($_POST['delete'])) {
    $sql = "DELETE FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $_POST['product_id'];
    $results = mysqli_query($conn, $sql);
    header('location: ' . FDA_BASE_URL . '/cart/');
}

if(isset($_POST['save-quantity'])) {
    if($_POST['quantity'] <= 0) {
        $sql = "DELETE FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $_POST['product_id'];
        $results = mysqli_query($conn, $sql);
        header('location: ' . FDA_BASE_URL . '/cart/');
    } else {
        $sql = "UPDATE flydreamair_cart SET quantity = " . $_POST['quantity'] . ", price = " . $_POST['price'] . " * " . $_POST['quantity'] . ", points = " . $_POST['points'] . " * " . $_POST['quantity'] . "  WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $_POST['product_id'];
        $results = mysqli_query($conn, $sql);
        header('location: ' . FDA_BASE_URL . '/cart/');
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/header.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/footer.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/cart.css' ?>">
</head>
<body>
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
<div class="container">
    <div class="products">
        <h1 class="heading">My Cart</h1>

        <?php

        $sql = "SELECT id FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'];
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0): ?>

            <div class="cart">
                <h3>Total Items (<?php echo countCartItems($conn)?>)</h3>
                <hr>
                <?php foreach($carts as $key => $cart): ?>
                    <div class="product">
                        <div class="section">
                            <div class="image">
                                <img class="product-img" src="<?php echo FDA_BASE_URL . '/images/products/' . $cart['image'] ?>" alt="product name">
                            </div>
                        </div>
                        <div class="section">
                            <p class="name">
                                <?php echo $cart['brand'] ?> <?php echo $cart['description'] ?>
                            </p>
                            <form action="index" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $cart['product_id'] ?>">
                                <button class="delete" type="submit" name="delete">
                                    <img class="icon" src="<?php echo FDA_BASE_URL . '/images/trash.svg' ?>" alt="delete">
                                    <span>Delete</span>
                                </button>
                            </form>

                        </div>
                        <div class="section">
                            <div class="price">
                                <div class="real-currency">
                        <span>
                            $<?php
                            $total_price =  $cart['price'] *  $cart['quantity'];
                            echo number_format($total_price, 2, '.', '');
                            ?>
                        </span>
                                </div>
                                <div class="loyalty-points">
                        <span>
                            or <?php
                            $total_price =  $cart['points'] *  $cart['quantity'];
                            echo number_format($total_price);
                            ?>
                             points
                        </span>
                                </div>
                            </div>
                            <div class="quantity-container">

                                <form action="index" method="post">
                                    <label><span>Quantity</span>
                                        <input type="hidden" name="product_id" value="<?php echo $cart['product_id'] ?>">

                                        <input class="quantity" name="quantity" type="number" value="<?php echo $cart['quantity'] ?>" />
                                    </label>
                                    <input type="hidden" name="price" value="<?php echo $cart['price']?>">
                                    <input type="hidden" name="points" value="<?php echo $cart['points']?>">
                                    <button type="submit" class="primary-btn " name="save-quantity">Save</button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <hr>
                <div class="subtotal">
                    <div class="real-currency">
                        <span>
                            <b>Total: <span>$<?php echo number_format(countTotalPrice($conn), 2, '.', '') ?></b> or <?php echo number_format(countTotalPoints($conn)) ?> points</span>
                        </span>
                    </div>
                </div>

            </div>
            <a href="../cart/<?php echo $_SESSION['id'] ?>/payment/">
                <button class="checkout-btn">Checkout</button>
            </a>

        <?php else: ?>
            <div class="details">
                <div class="detail">
                    <p>You have no items in your cart.</p>
                    <h2>Start shopping now</h2>
                    <a href="<?php echo FDA_BASE_URL . '/start/' ?>">
                        <button class="stretch primary-btn">Let's go</button>
                    </a>
                </div>
            </div>

        <?php endif ?>
    </div>
</div>
<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/js.js"></script>
<script src="../js/profile-validation.js"></script>
</body>
</html>