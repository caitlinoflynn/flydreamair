<?php
include("../../path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/users.php");

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/header.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/footer.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/main.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/profile.css' ?>">
</head>
<body>
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
<div class="container">
    <div class="rewards-container">
        <div class="content">
            <div class="right-side">
                <div class="filter-bar">
          <ul>
            <div class="welcome">
               <h3>Welcome, <?php echo $firstname ?></h3>
            </div>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/' . $_SESSION['id'] . '/' ?>">
              <li>
                My Details
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/rewards/' . $_SESSION['id'] . '/' ?>">
              <li>
                My Rewards
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/wishlist/' . $_SESSION['id'] . '/' ?>">
              <li>
                My Wishlist
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/order-history/' . $_SESSION['id'] . '/' ?>">
              <li>
                Order History
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/address-book/' . $_SESSION['id'] . '/' ?>">
              <li>
                Address Book
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/saved-cards/' . $_SESSION['id'] . '/' ?>">
              <li>
                Saved Cards
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/track-order/' . $_SESSION['id'] . '/' ?>">
              <li class="active">
                Track Order
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/sign-out/' ?>">
              <li>
                Sign Out
              </li>
            </a>
          </ul>
        </div>
                <div class="products">
                    <h1 class="heading">Track Orders</h1>
                    <p class="info">Track your orders here.</p>

                    <div class="details">
                        <div class="detail">
                            <p>Your order number will be 17 digits.</p>
                        </div>
                        <div class="detail">
                            <form id="track-order-form">
                                <div class="form-control">
                                    <small>Error</small>
                                    <br><br>
                                   <input class="input" placeholder="e.g 111-1111111-1111111" type="text" id="order">
                                </div>
                                <button type="submit" class="stretch primary-btn">Track order</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../../js/js.js"></script>
<script src="../../js/order-validation.js"></script>
</body>
</html>