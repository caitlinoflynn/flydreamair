<?php
include("../path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/users.php");

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    
    
}

    if(isset($_POST['spend-points'])) {
        
        $sql = "UPDATE users SET points = " . $_POST['points'] . " WHERE id = " . $_SESSION['id'];
        if(mysqli_query($conn, $sql)) {
            $sql2 = "INSERT INTO flydreamair_orders (user_id, product_id, quantity) SELECT user_id, product_id, quantity FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'];
             if(mysqli_query($conn, $sql2)) {
                 $results = mysqli_query($conn, "DELETE FROM flydreamair_cart WHERE user_id = " . $_SESSION['id']);
                 header('location: ' . FDA_BASE_URL . '/profile/order-history/' . $_SESSION['id'] . '/');
             }
            
        } else {
            echo "no";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/footer.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/main.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/payment.css' ?>">
</head>
<body>
<header>
    <div class="inner-header">
        <div class="center">
            <div class="company-name">
                <a href="../index.html">
                    <span>FlyDreamAir</span>
                </a>
            </div>
        </div>
    </div>
</header>
<div class="cart-container">
    <div class="cart-dropdown-content">
        <?php foreach($carts as $key => $cart): ?>
        <div class="cart-product">
            <div class="section">
                <div class="cart-image">
                    <img class="cart-img" src="<?php echo FDA_BASE_URL . '/images/products/' . $cart['image'] ?>" alt="<?php echo $cart['brand'] ?>">
                </div>
            </div>
            <div class="section cart-description">
                <div class="cart-name">
                    <p>
                        <?php echo $cart['brand'] ?> <?php echo $cart['description'] ?>
                    </p>
                </div>
                <div class="cart-price">
                                            <span>
                                                Price: <?php echo number_format($cart['quantity'], 2, '.', '') ?> x $<?php echo $cart['price'] ?> or <?php echo number_format($cart['points']) ?>
                                            </span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <div class="total">
            <span>
                            <b>Total: <span>$<?php echo number_format(countTotalPrice($conn), 2, '.', '') ?></b> or <?php echo number_format(countTotalPoints($conn)) ?> points</span>
                        </span>
        </div>
    </div>
</div>
<div class="billing-container">
    <div>
        <h1>Payment</h1>
        <form>
            <div class="form-control">
                <h3 class="method">Shipping Method</h3>
                <select class="input">
                    <option value="standard">
                        Australian Standard - $14.99
                    </option>
                    <option value="express">
                        Australia Express - $24.99
                    </option>
                </select>
            </div>
            <div class="form-control">
                <h3>Shipping Information</h3>
                <div class="address">
                    <h2 class="heading">Shipping</h2>
                    <div class="details">
                        <div class="detail">
                            <span>John Doe</span>
                        </div>
                        <div class="detail">
                            <span>1 Sydney Street</span>
                        </div>
                        <div class="detail">
                            <span>Sydney, NSW, 1234</span>
                        </div>
                        <div class="detail">
                            <span>Australia</span>
                        </div>
                        <div class="detail">
                            <span>+61 1234 567 890</span>
                        </div>
                    </div>
                    <span><u>Edit</u></span>
                </div>
                <div class="address">
                    <h2 class="heading">Billing</h2>
                    <div class="details">
                        <div class="detail">
                            <span>John Doe</span>
                        </div>
                        <div class="detail">
                            <span>1 Sydney Street</span>
                        </div>
                        <div class="detail">
                            <span>Sydney, NSW, 1234</span>
                        </div>
                        <div class="detail">
                            <span>Australia</span>
                        </div>
                        <div class="detail">
                            <span>+61 1234 567 890</span>
                        </div>


                    </div>
                    <span><u>Edit</u></span>
                </div>
            </div>
            </form>
            <div>
            <p>How would you like to pay?</p>
            <button id="points" style="display:inline; margin: 10px">Points</button>
            <button id="card" style="display:inline; margin: 10px">Card</button>
            
    </div>
    <div id="payment-points">
        
            <p>You currently have: <b><?php echo $points ?> points</b></p>
            <?php if($points < countTotalPoints($conn)): ?>
            <button type="submit" class="submit disabled-btn">Pay now</button>
            <p>You do not have enough points</p>
            <? elseif ($points >= countTotalPoints($conn)): ?>
            <h3>Pay With Points</h3>
            
           <form method="post">
               <input type="hidden" name="points" value="<?php echo $points - countTotalPoints($conn)  ?>">
            <button type="submit" class="submit" name="spend-points">Use Points</button>
            
             </form>
             
            <?php endif ?>
    </div>
            <div id="payment-card">
                <h3>Secure Card Payment</h3>
            
            <div class="section">
                <div class="form-control">
                    <p>Card Holder Name*</p>
                    <input class="input" type="text" id="holder">
                </div>
            </div>
            <div class="section">
                <div class="form-control">
                    <p>Card Number*</p>
                    <input class="input" type="text" id="card-number">
                    <small>Error</small>
                </div>
            </div>
            <div class="section">
                <div class="form-control">
                    <p>Expiry Date*</p>
                    <input class="input" type="month" placeholder="Month" id="expiry">
                    <small>Error</small>
                </div>
                <div class="form-control">
                    <p>CVV/CCV*</p>
                    <input class="input" type="number" id="cvv">
                    <small>Error</small>
                </div>
            </div>
            <button type="submit" class="submit">Pay now</button>
            </div>
       

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo FDA_BASE_URL . '/js/address-validation.js' ?>"></script>
<script src="<?php echo FDA_BASE_URL . '/js/payment-validation.js' ?>"></script>
<script>
    

$('.hamburger-menu').click(function(){
    $('.menu').css("visibility", "visible");
});

$('.close').click(function(){
    $('.menu').css("visibility", "hidden");
});

$('.edit').click(function(){
    $('.show-details').css("display", "none");
    $('form').css("display", "block");
});

$('.cancel').click(function(){
    $('.show-details').css("display", "block");
    $('form').css("display", "none");
});

$('#card').click(function(){
    $('#payment-card').css("display", "block");
    $('#payment-points').css("display", "none");
});

$('#points').click(function(){
    $('#payment-card').css("display", "none");
    $('#payment-points').css("display", "block");
});

$( document ).ready(function() {
    $('.show-details').css("display", "block");
    $('#profile-form').css("display", "none");
    $('#payment-points').css("display", "none");
    $('#payment-card').css("display", "none");

});



//form errors
function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    const inputControls = formControl.querySelector('input');
    inputControls.classList.add("input-error");
    formControl.className = 'form-control error';
    small.innerText = message;
}

//progress bar to be edited
var percent = 5;

$('.increment').click(function () {
    percent++;
    percent++;
    percent++;
    percent++;
    percent++;
    document.querySelector(".progress-bar").style.width = percent + "%";
    document.getElementById('progress-bar').innerText = percent + "points";
    return false;
});

//needs increment quantity at cart function
</script>
</body>
</html>