<?php
include("../../path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/users.php");

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
}

$orders = getOrders();

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
              <li class="active">
                Order History
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/address-book/' . $_SESSION['id'] . '/'  ?>">
              <li>
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
            <a href="<?php echo BASE_URL . '/projects/flydreamair/sign-out/' ?>">
              <li>
                Sign Out
              </li>
            </a>
          </ul>
        </div>
        <div class="products">
          <h1 class="heading">Order History</h1>
          <p class="info">Track your orders here.</p>

          <?php 
          
          $sql = "SELECT id FROM flydreamair_orders WHERE user_id = " . $_SESSION['id'];
          $result = mysqli_query($conn, $sql);
          
          if(mysqli_num_rows($result) > 0): ?>
          
          <div class="wishlist">
            <h3>Total Orders (<?php echo countOrders($conn) ?>)</h3>
            <hr>
            <?php foreach($orders as $key => $order): ?>
            <?php 
                    
                    $timestamp = $order['order_placed'];
                    $splitTimeStamp = explode(" ",$timestamp);
                    $date = $splitTimeStamp[0];
                    $time = $splitTimeStamp[1];
                    
                    
                    ?>
            <div class="product">
              <div class="section">
                  <div class="order_number">
                      <b>Order:</b>
                    #<?php echo $order['id'] ?>
                  </div>
                <div class="date">
                    <p><b>Placed on: </b><?php echo $date ?> (<?php echo $time ?>)</p>
                </div>
                <div class="total-items">
                     <p><b>Total Items:</b> <?php echo $order['total_items'] ?></p>
                </div>
                <div class="total-items">
                     <p><b>Total Price:</b> <?php echo $order['total_items'] ?></p>
                </div>
                <div class="payment">
                    <p>
                        <b>Card or Points:</b> 
                        <?php if($order['payment'] == 0): ?>
                        Points
                        <?php elseif($order['payment'] == 1): ?>
                        Card
                        <?php endif; ?>
                    </p>
                    
                </div>
              </div>
              </div>
     
            <?php endforeach; ?>
          </div>
              
           <?php else: ?>
               <div class="details">
            <div class="detail">
              <p>You have no orders.</p>
              <h2>Start shopping now</h2>
              <a href="<?php echo FDA_BASE_URL . '/start/' ?>">
                  <button class="stretch primary-btn">Let's go</button>
              </a>
            </div>
          </div>

           
           <?php endif; ?>
          
        </div>

      </div>
    </div>
  </div>
</div>
<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../../js/js.js"></script>
</body>
</html>