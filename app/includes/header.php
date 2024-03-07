<header>
  <div class="inner-header">
    <div class="left-side">
      <div class="hamburger-menu">
        <img class="icon" src="<?php echo BASE_URL . '/projects/flydreamair/images/menu.svg ' ?>" alt="menu">
      </div>
      <div class="product-details">
        <div class="currency">
          <img class="icon" src="<?php echo BASE_URL . '/projects/flydreamair/images/aud.svg' ?>" alt="aud">
        </div>
        <form action="<?php echo FDA_BASE_URL . '/search/index'?>" method="post">
            <div class="search">
          <input type="text" placeholder="search" name="search-term">
        </div>
        </form>
        
      </div>

    </div>
    <div class="center">
      <div class="company-name">
        <a href="<?php echo BASE_URL . '/projects/flydreamair/' ?>">
          <span>FlyDreamAir</span>
        </a>
      </div>
    </div>
    <div class="right-side">
      <div class="user-navigation">
        <div class="cart icon-container">
            <?php if (isset($_SESSION['id'])): ?>
                    <div class="dropdown">
                        <a href="<?php echo FDA_BASE_URL . '/cart/' ?>">
                        <div class="cart-quantity">
                            <span><?php echo countCartItems($conn) ?></span>
                        </div>
                        <img class="icon" src="<?php echo FDA_BASE_URL . '/images/shopping-cart.svg' ?>" alt="cart">
                        </a>

                        <div class="cart-dropdown-content" id="cart-list">
                            <?php foreach($carts as $key => $cart): ?>
                            <div class="cart-product">
                                <div class="section">
                                    <div class="cart-image">
                                        <img class="cart-img" src="<?php echo FDA_BASE_URL . '/images/products/' . $cart['image'] ?>" alt="product name">
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
                                                Price: <?php echo $cart['quantity'] ?> x $<?php echo $cart['price'] ?> or <?php echo $cart['points'] ?>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                            <div class="total">
                              
                                <span><b>Total: $<?php echo number_format(countTotalPrice($conn), 2, '.', '') ?></b> or <?php echo number_format(countTotalPoints($conn)) ?> points</span>
                                <a href="<?php echo FDA_BASE_URL . '/cart/' ?>">
                                    <button class="stretch primary-btn">Go To Cart</button>
                                </a>
                                
                            </div>
                        </div>



                    </div>
                    <?php else: ?>
                    <div class="dropdown">
            <img class="icon" src="<?php echo FDA_BASE_URL . '/images/shopping-cart.svg' ?>" alt="cart">
            <div class="dropdown-content">
            <p style="text-align: center">Start shopping now</p>
                <a href="#">
                    <button class="btn black-btn">Start</button>
                </a>

            </div>
          </div>
                    <?php endif; ?>
                </div>
        <?php if (isset($_SESSION['id'])): ?>
        <a href="<?php echo FDA_BASE_URL . '/profile/wishlist/' . $_SESSION['id'] . '/' ?>">  
          <div class="wishlist icon-container">
            <div class="wishlist-quantity">
              <span><?php echo countWishlistItems($conn) ?></span>
            </div>
            <img class="icon" src="<?php echo FDA_BASE_URL . '/images/wishlist.svg' ?>" alt="wishlist">
          </div>
        </a>
        <?php else: ?>
        <a href="<?php echo FDA_BASE_URL . '/login/' ?>">
            <div class="wishlist icon-container">
            <img class="icon" src="<?php echo FDA_BASE_URL . '/images/wishlist.svg' ?>" alt="wishlist">
          </div>
        </a>
        <?php endif; ?>
        <div class="user-profile icon-container">
          <div class="dropdown">
            <?php if (isset($_SESSION['id'])): ?>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/' . $_SESSION['id'] . '/' ?>">
              <img class="icon" src="<?php echo FDA_BASE_URL . '/images/user-logged-in.svg' ?>" alt="profile">
            </a>
            <?php else: ?>
            <img class="icon" src="<?php echo FDA_BASE_URL . '/images/user.svg' ?>" alt="profile">
            <div class="dropdown-content">
              <a href="<?php echo FDA_BASE_URL . '/login/' ?>">
                <button class="btn black-btn">Log In</button>
              </a>
              <button class="btn black-btn">Sign Up</button>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="navigation-filters">
        <span class="categories">
            Categories
        </span>
    <span class="brands">
            Brands
        </span>
    <span class="deals">
            Deals
        </span>
  </div>
  <div class="menu">
    <img class="icon close" src="<?php echo BASE_URL . '/projects/flydreamair/images/close.svg' ?>" alt="exit">
    <div class="list">
      <div class="search">
        <input type="text" placeholder="search">
      </div>
      <div class="currency"></div>
      <div class="navigation">
        <div class="category">
          <span>Categories</span>
        </div>
        <div class="category">
          <span>Brands</span>
        </div>
        <div class="category">
          <span>Deals</span>
        </div>
      </div>

    </div>
  </div>
</header>