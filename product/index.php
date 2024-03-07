<?php
include("../path.php");
include(ROOT_PATH . "/app/database/config.php");

if (isset($_GET['id'])) {
    $product = selectOne('flydreamair_products', ['id' => $_GET['id']]);
    $brand = selectOne('flydreamair_brands', ['id' => $product['brand_id']]);
    $category = selectOne('flydreamair_categories', ['id' => $product['category_id']]);
    $subcategory = selectOne('flydreamair_subcategories', ['id' => $product['subcategory_id']]);
}

if (isset($_POST['add-wishlist'])) {
    
     $sql = "SELECT product_id FROM flydreamair_wishlist WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $product['id'];
    
                
    if ($result = mysqli_query($conn, $sql)) {
            
            if (mysqli_fetch_row($result)) {
                echo 'You already have this item';
                
                $sql2 = "UPDATE flydreamair_wishlist
                        SET quantity = quantity + " . $_POST['quantity'] . "
                        WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $product['id'];
                        
                        if(mysqli_query($conn, $sql2)) {
                           header('location: ' . FDA_BASE_URL . '/profile/wishlist/' . $_SESSION['id'] . '/');
                
               }
            } else {
                
            $sql3 = "INSERT INTO flydreamair_wishlist (user_id, product_id, quantity) VALUES (" . $_POST['user_id'] . ", " . $_POST['product_id'] . ", " . $_POST['quantity'] . ")";
                            
                        
    
                           if(mysqli_query($conn, $sql3)) {
                               header('location: ' . FDA_BASE_URL . '/profile/wishlist/' . $_SESSION['id'] . '/');
                            } else 'none';
                          }
    }
    
}

if (isset($_POST['add-cart'])) {
    
        if($_POST['quantity'] <=0) { ?>
        <script>
        document.getElementById("add").addEventListener("click", function(event){
        event.preventDefault();
        });
            </script>
    <?php } else {
    
     $sql = "SELECT product_id FROM flydreamair_cart WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $product['id'];
    
                
    if ($result = mysqli_query($conn, $sql)) {
            
            if (mysqli_fetch_row($result)) {
                echo 'You already have this item';
                
                $sql2 = "UPDATE flydreamair_cart
                        SET quantity = quantity + " . $_POST['quantity'] . ", price = price + " . $_POST['price'] * $_POST['quantity']. ", points = points + " . $_POST['points'] * $_POST['quantity']. "
                        WHERE user_id = " . $_SESSION['id'] . " AND product_id = " . $product['id'];
                        
                        if(mysqli_query($conn, $sql2)) {
                           header('location: ' . FDA_BASE_URL . '/product/' . $product['id'] . '/' . $brand['name']);
                
               }
            } else {
                
            $sql3 = "INSERT INTO flydreamair_cart (user_id, product_id, quantity, price, points) VALUES (" . $_POST['user_id'] . ", " . $_POST['product_id'] . ", " . $_POST['quantity'] . ", " . $_POST['price'] * $_POST['quantity'] . ", " . $_POST['points'] * $_POST['quantity']. ")";
     
                           if(mysqli_query($conn, $sql3)) {
                               header('location: ' . FDA_BASE_URL . '/product/' . $product['id'] . '/' . $brand['name']);
                            } else 'none';
                          }
    }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Details</title>
    <link rel="stylesheet" href="<?php echo BASE_URL . '/style/header.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/style/footer.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/style/main.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/style/product.css' ?>">
    <style>

small {
    color: #e74c3c;
    visibility: visible;
    float: left;
    margin: 5px 0;
    display: none;
}
    </style>
</head>
<body>
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
		<div class="container">
			<div class="content">
				<div class="links">
					<a href="<?php echo BASE_URL . '/' ?>"><span>Home</span><span> / </span></a>
					<a href="<?php echo BASE_URL . '/' . $category['id'] . '/' . $category['handle'] ?>"><span><?php echo $category['name'] ?></span><span> / </span></a>
					<a href="<?php echo BASE_URL . '/' . $subcategory['id'] . '/' . $subcategory['handle'] ?>"><span><?php echo $subcategory['name'] ?></span></a>
				</div>
			<div class="item">
				<div class="itemInfo">
					<div class="left-side">
						<div class="image">
							<img class="product" src="<?php echo BASE_URL . '/images/products/' . $product['image'] ?>" alt="product">
						</div>
					</div>

					<div class="right-side">
						<h2 class="name"><?php echo $brand['name'] ?></h2>
						<p class="description">
							<?php echo $product['description'] ?>
						</p>
						<div class="price">
							<div class="real-currency">
                        <span>
                            $<?php echo $product['price'] ?>
                        </span>
							</div>
							<div class="loyalty-points">
                         <span>
                            or
                        </span>
								<span>
                            <?php echo number_format($product['points']) ?>
                        </span>
								<span>
                            points
                        </span>
							</div>
						</div>
						<form action="index" method="post" id="add">
                    <div class="quantity">
                        <div class="form-control">
                            <small>Error</small>
                            <br><br>
                            <input type="number" class="input" min="0" name="quantity" placeholder="Quantity" id="quantity">
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $product['price'] ?>" name="price">
                    <input type="hidden" value="<?php echo $product['points'] ?>" name="points">
                    <input type="hidden" value="<?php echo $product['id'] ?>" name="product_id">
                        <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="user_id">
                    <div class="add">
                        <button type="submit" class="primary-btn add-to-bag" name="add-cart" id="add-cart">Add to cart</button>
                          <button class="wishlist-btn" type="submit" name="add-wishlist">
                        <img class="icon" src="<?php echo BASE_URL . '/images/wishlist.svg' ?>" alt="add to wishlist">
                        </button>
                    </div>
                      
                  

                </form>
                    </div>
					</div>

				</div>
			</div>

			</div>
	<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
	
var submit = function prevent(){
  $("form").submit(function(e){
        e.preventDefault();
  });
}

function error() {
    $('#quantity').css("border", "2px solid #e74c3c");
        $('small').css("display", "block");
        $('small').text("Please select a quantity");
 /*
  $("form").submit(function(e){
        e.preventDefault();
  });
  */

}

	  $('.add-to-bag').click(function(){
	      
	    if($('#quantity').val() == 0) {
	       
        error();
        
	    }
	  });

	</script>
</body>
</html>