<?php 
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