<?php
include("../path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/categories.php");

$category_id = $_GET['id'];
$products = getProductsByCategory();
$subcategories = getSubCategoriesByCategory();

if (isset($_GET['id'])) {
    $category = selectOne('flydreamair_categories', ['id' => $_GET['id']]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Details</title>
  <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/header.css'?> ">
  <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/footer.css' ?>">
  <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/product-list.css' ?>">
</head>
<body>
<?php include(ROOT_PATH . "/app/includes/projects/header/flydreamair.php"); ?>
<div class="wrap">
  <div class="links">
    <a href="<?php echo FDA_BASE_URL . '/' ?>"><span>Home</span><span> / </span></a><span class="disabled"><?php echo $category['name'] ?>
  </div>
  <div class="container">
    <h1 class="heading"><?php echo $category['name'] ?></h1>
    <div class="results-bar desktop">
      <div class="option">
        <span>Delivery Method</span>
      </div>
      <div class="option">
        <span>Brands</span>
      </div>
      <div class="option">
        <span><?php echo countProductsInCategory($conn) ?> items found</span>
      </div>
      <div class="option option-dropdown">
        <span>Sort by: popularity</span>
        <div class="option-content">
          <div>
            <span>Popularity</span>
          </div>
          <div>
            <span>Newest</span>
          </div>
          <div>
            <span>Price</span>
          </div>
        </div>
      </div>
    </div>
    <div class="results-bar mobile">
      <div class="mobile-option" id="categories">
        <img class="icon" src="../images/category.svg"  alt="categories">
        <span>Categories</span>
      </div>
      <div class="mobile-option" id="filter">
        <img class="icon" src="../images/setting.svg"  alt="sort">
        <span>Filter & Sort</span>
      </div>
    </div>
      <div class="filter-bar">
        <ul>
          <h3><?php echo $category['name'] ?></h3>
          <?php foreach($subcategories as $key => $subcategory): ?>
          <a href="<?php echo FDA_BASE_URL . '/subcategory/' . $subcategory['id'] . '/' . $subcategory['handle'] ?>">
              <li>
            <?php echo $subcategory['name'] ?>
          </li>
          </a>
          <?php endforeach; ?>
        </ul>
      </div>
    <div class="products-container">
      <div class="products">
          <?php foreach($products as $key => $product): ?>
          <a href="<?php echo FDA_BASE_URL . '/product/' . $product['id'] . '/' . $product['brand'] ?>">
          <div class="product">
            <div class="content">
              <div class="image">
                <img src="<?php echo FDA_BASE_URL . '/images/products/' . $product['image'] ?>" alt="<?php echo $product['brand'] ?>">
              </div>
              <div class="name"><?php echo $product['brand'] ?></div>
              <div class="description"><?php echo $product['description'] ?></div>
              <div class="price">
                <div class="real">
                  <span>$<?php echo $product['price'] ?></span>
                </div>
                <div class="loyalty-points">
                  <span>or <?php echo number_format($product['points']) ?> points</span>
                </div>
              </div>
            </div>

          </div>
        </a>
          <?php endforeach; ?>
      </div>
    </div>



    <div class="content">
      <div class="right-side">


        <div class="pagination-container" style="visibilty: hidden">
          <div class="items-found text">
            <span>160 items found</span>
          </div>
          <div class="buttons">
            <button class="primary-btn">Previous</button>
            <button class="primary-btn">Next</button>
          </div>
          <div class="desktop pagination text">
            <span class="active">1</span>
            <span>2</span>
            <span>3</span>
            <span>...</span>
            <span>10</span>
          </div>
        </div>
        <div class="pagination-container mobile" style="visibilty: hidden">
          <div class="pagination text">
            <span class="active">1</span>
            <span>2</span>
            <span>3</span>
            <span>...</span>
            <span>10</span>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>
<?php include(ROOT_PATH . "/app/includes/projects/footer/flydreamair.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/js.js"></script>
</body>
</html>