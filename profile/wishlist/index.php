<?php
include("../../path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/users.php");

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
}

$wishlists = getWishlist();

if (isset($_POST['add-cart'])) {
    
     $sql = "SELECT product_id FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $_POST['product_id'];
    
                
    if ($result = mysqli_query($conn, $sql)) {
            
            if (mysqli_fetch_row($result)) {
                echo 'You already have this item';
                
                $sql2 = "UPDATE flydreamair_cart
                        SET quantity = quantity + " . $_POST['quantity'] . ", price = price + " . $_POST['price'] * $_POST['quantity'] . ", points = points + " . $_POST['points'] * $_POST['quantity']. "
                        WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $_POST['product_id'];
                        
                        if(mysqli_query($conn, $sql2)) {
                           
                            $sql4 = "DELETE FROM flydreamair_wishlist WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $_POST['product_id'];
                           $results = mysqli_query($conn, $sql4);
                               header('location: ' . FDA_BASE_URL . '/profile/wishlist/');
                           
                
               }
            } else {
                
            $sql3 = "INSERT INTO flydreamair_cart (user_id, product_id, quantity, price, points) VALUES (" . $_POST['user_id'] . ", " . $_POST['product_id'] . ", " . $_POST['quantity'] . ", " . $_POST['price'] * $_POST['quantity']. ", " . $_POST['points'] * $_POST['quantity'] . ")";
     
                           if(mysqli_query($conn, $sql3)) {
                            
                                $sql5 = "DELETE FROM flydreamair_wishlist WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $_POST['product_id'];
                           $results = mysqli_query($conn, $sql5);
                               header('location: ' . FDA_BASE_URL . '/profile/wishlist/');
                               
                            } else 'none';
                          }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Wishlist</title>
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
              <li class="active">
                My Wishlist
              </li>
            </a>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/order-history/' . $_SESSION['id'] . '/'  ?>">
              <li>
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
            <a href="<?php echo BASE_URL . '/projects/flydreamair/sign-out/'  ?>">
              <li>
                Sign Out
              </li>
            </a>
          </ul>
        </div>
        <div class="products">
          <h1 class="heading">My Wishlist</h1>
          <p class="info">Love something but waiting until payday? Save them here, so they will be waiting for you.</p>

          
          
          <?php 
          
          $sql = "SELECT id FROM flydreamair_wishlist WHERE user_id = " . $_SESSION['id'];
          $result = mysqli_query($conn, $sql);
          
          if(mysqli_num_rows($result) > 0): ?>
          
          <div class="wishlist">
            <h3>Total Items (<?php echo countWishlistItems($conn) ?>)</h3>
            <hr>
            <?php foreach($wishlists as $key => $wishlist): ?>
            <div class="product">
              <div class="section">
                <div class="image">
                  <img class="product-img" src="<?php echo FDA_BASE_URL . '/images/products/' . $wishlist['image'] ?>" alt="product name">
                </div>
              </div>
              <div class="section">
                <div class="name">
                  <p>
                      <?php echo $wishlist['brand'] ?> <?php echo $wishlist['description'] ?>
                  </p>
                </div>
                <?php 
                if(isset($_POST['delete'])) {
                $sql = "DELETE FROM flydreamair_wishlist WHERE id = " . $wishlist['wishlist_id'] . " AND user_id = " . $_SESSION['id'];
                $results = mysqli_query($conn, $sql);
                }
                ?>
                <form method="post">
                    <button type="submit" name="delete" class="delete">
                  <img class="icon" src="<?php echo FDA_BASE_URL . '/images/trash.svg'?>" alt="delete">
                </button>
                </form>
                <div class="price">
                  <div class="real-currency">
                        <span>
                            $<?php echo $wishlist['price'] ?>
                        </span>
                  </div>
                  <div class="loyalty-points">
                        <span>
                            or <?php echo number_format($wishlist['points']) ?> points
                        </span>
                  </div>
                </div>
           
                  <div class="quantity">
                    <p><?php echo $wishlist['quantity'] ?></p>
                  </div>
                  <form method="post" id="cart-form">
                      <input type="hidden" name="quantity" value="<?php echo $wishlist['quantity'] ?>">
                      <input type="hidden" name="points" value="<?php echo $wishlist['points'] ?>">
                      <input type="hidden" name="price" value="<?php echo $wishlist['price'] ?>">
                      <input type="hidden" name="product_id" value="<?php echo $wishlist['product_id'] ?>">
                      <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
                  <div class="add">
                    <button type="submit" name="add-cart" class="stretch primary-btn add-to-bag">Add to bag</button>
                  </div>
                </form>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
              
           <?php else: ?>
               
           <div class="details">
            <div class="detail">
              <p>You have no items in your wishlist.</p>
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
<script src="<?php echo FDA_BASE_URL . '/js/js.js' ?>"></script>
<script src="<?php echo FDA_BASE_URL . '/js/profile-validation.js' ?>"></script>
</body>
</html>