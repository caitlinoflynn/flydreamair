<?php
include("path.php");
include(ROOT_PATH . "/app/database/config.php");

$categories = getHomeCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome To The FlyDreamAir Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?php echo BASE_URL . '/style/header.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/style/footer.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/style/main.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . '/style/home.css' ?>">
</head>
<body>
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
<div class="wrap">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
    <div class="carousel-inner">
      <div class="item active">
        <div class="fragrance-info">
          <h1 class="fragrance-header">Find your signature fragrance</h1>
          <a href="<?php echo BASE_URL . '/subcategory/4/fragrances' ?>">
            <button class="primary-btn">Shop now</button>
          </a>
        </div>
        <img src="<?php echo BASE_URL . '/images/perfume.png'?>" alt="perfume" style="width:100%;">
      </div>
      <div class="item">
        <div class="technology-info">
          <p class="technology-header" id="part1">Everywhere, anywhere,</p>
          <p class="technology-header" id="part2">stay connected</p>
          <p class="technology-description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod...
          </p>
          <a href="categories/index.html">
            <button class="primary-btn" id="technology-btn">Shop now</button>
          </a>
        </div>

        <img src="<?php echo BASE_URL . '/images/technology.png" alt="technology' ?>" style="width:100%; height: 100vh">
      </div>
      <div class="item">
        <div class="wines-info">
          <h1 class="wines-header">Great wine comes from the heart</h1>
          <p class="wines-description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod...
          </p>
          <a href="categories/index.html">
            <button class="primary-btn" id="wines-btn">Shop now</button>
          </a>
        </div>
        <img src="<?php echo BASE_URL . '/images/grapes.jpg '?>" alt="wines" style="width:100%; height: 100vh">

    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
  <div class="section">
    <h1>Shop By</h1>
    <div class="categories">
        <?php foreach($categories as $key => $category): ?>
         <a href="<?php echo BASE_URL . '/' . $category['id'] . '/' . $category['handle'] . '/' ?>">
        <div class="shop-category">
        <div class="image">
          <img class="category-img" src="<?php echo BASE_URL . '/images/' . $category['image'] ?>" alt="<?php echo $category['name'] ?>">
        </div>
        <div class="description"><?php echo $category['name'] ?></div>
      </div>
        </a>
            <?php endforeach; ?>
    </div>
  </div>
  <div class="section">
    <h1>Have a look at</h1>
    <div class="categories">
      <div class="shop-category">
        <div class="image">
          <img class="category-img" src="<?php echo BASE_URL . '/images/watch.jpg' ?>" alt="watch">
        </div>
        <div class="description">Cartier</div>
      </div>
      <div class="shop-category">
        <div class="image">
          <img class="category-img" src="<?php echo BASE_URL . '/images/phone.jpg' ?>" alt="iphone">
        </div>
        <div class="description">Apple</div>
      </div>
      <div class="shop-category">
        <div class="image">
          <img class="category-img" src="<?php echo BASE_URL . '/images/smeg.jpeg' ?>" alt="smeg">
        </div>
        <div class="description">Smeg</div>
      </div>
      <div class="shop-category">
        <div class="image">
          <img class="category-img" src="<?php echo BASE_URL . '/images/bag.jpg' ?>" alt="bag">
        </div>
        <div class="description">Saint Laurant</div>
      </div>
      <div class="shop-category">
        <div class="image">
          <img class="category-img" src="<?php echo BASE_URL . '/images/wine.jpg' ?>" alt="wine">
        </div>
        <div class="description">Jacob's Creek</div>
      </div>
    </div>
  </div>
  </div>
<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/js.js"></script>
</body>
</html>
