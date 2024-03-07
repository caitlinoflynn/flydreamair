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
    <title>Address Book</title>
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
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/' . $_SESSION['id'] . '/'  ?>">
              <li>
                My Details
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/rewards/' . $_SESSION['id'] . '/'  ?>">
              <li>
                My Rewards
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/wishlist/' . $_SESSION['id'] . '/'  ?>">
              <li>
                My Wishlist
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/order-history/' . $_SESSION['id'] . '/'  ?>">
              <li>
                Order History
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/address-book/' . $_SESSION['id'] . '/'  ?>">
              <li class="active">
                Address Book
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/saved-cards/' . $_SESSION['id'] . '/'  ?>">
              <li>
                Saved Cards
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/track-order/' . $_SESSION['id'] . '/'  ?>">
              <li>
                Track Order
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/sign-out/'  ?>">
              <li>
                Sign Out
              </li>
            </a>
          </ul>
        </div>
                <div class="products">
                    <h1 class="heading">Address Book</h1>
                    <p class="info">View your address(es) here.</p>
                    <button class="primary-btn stretch">Add Address</button>
                    <div class="wishlist">
                        <h3>Total Addresses (1)</h3>
                        <hr>
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
                            <button class="edit primary-btn">Edit</button>
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
                            <button class="edit primary-btn">Edit</button>
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