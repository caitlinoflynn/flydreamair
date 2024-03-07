<?php
include("../../path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/projects/flydreamair/categories.php");
include(ROOT_PATH . "/app/controllers/projects/flydreamair/subcategories.php");
include(ROOT_PATH . "/app/controllers/projects/flydreamair/products.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
	<title>Colour Analysis: Add Celebrity</title>
	<link rel="icon" href="<?php echo BASE_URL . '/images/home/tab-icon.svg'?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@300;400;500&family=Source+Sans+Pro:wght@200;300;400;600&family=Source+Serif+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
<body>

<div class="wrap">
    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
    <div class="container">
			<form action="create" method="post" enctype="multipart/form-data">
                    <div>
                        <h3>Name</h3>
                        <label>
                            <input type="text" name="name" value="<?php echo $name ?>" class="text-input">
                        </label>
                    </div>
                    <hr>
                    <div>
                        <h3>Description</h3>
                        <label>
                            <input type="text" name="description" value="<?php echo $description ?>" class="text-input">
                        </label>
                    </div>
                    <hr>
                    <div>
                        <h3>Price</h3>
                        <label>
                            <input type="text" name="price" value="<?php echo $price ?>" class="text-input">
                        </label>
                    </div>
                    <hr>
                    <div>
                        <h3>Points</h3>
                        <label>
                            <input type="text" name="points" value="<?php echo $points ?>" class="text-input">
                        </label>
                    </div>
                    <hr>
                      <div>
                          <h3>Category</h3>
                            <select name="category_id" class="text-input" id="type">
                                <option value="">Select a season</option>
                                <?php foreach ($categories as $key => $category): ?>
                                    <?php if (!empty($categoryId) && $categoryId == $category['id'] ): ?>
                                        <option selected value="<?php echo $category['id'] ?>"><?php echo ucwords($category['name']) ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $category['id'] ?>"><?php echo ucwords($category['name']) ?></option>
                                    <?php endif; ?>

                                <?php endforeach;  ?>
                            </select>
                </div>
                <hr>
                      <div>
                          <h3>Sub Category</h3>
                            <select name="subcategory_id" class="text-input" id="type">
                                <option value="">Select a season</option>
                                <?php foreach ($subcategories as $key => $subcategory): ?>
                                    <?php if (!empty($subcategoryId) && $subcategoryId == $subcategory['id'] ): ?>
                                        <option selected value="<?php echo $subcategory['id'] ?>"><?php echo ucwords($subcategory['name']) ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $subcategory['id'] ?>"><?php echo ucwords($subcategory['name']) ?></option>
                                    <?php endif; ?>

                                <?php endforeach;  ?>
                            </select>
                </div>
                
                    <hr>
                    <div class="">
                        <h3>Img</h3>
                      <div class="example-img">
                        <div class="image-upload">
                            <label for="file-input-best">
                                <div class="upload-btn primary-btn">
                                    <ion-icon class="icon" name="create-outline"></ion-icon>
                                </div>
                             </label>
                             <p><input type="file"  accept="image/*" name="image" id="file-input-best"  onchange="loadBestColor(event)" style="display: none;"></p>
                             <p><img id="best-color" class="celeb-img"/></p>
                        </div>
                      </div>
                    </div>
                <hr>
                
                <div>
                    <button type="submit" name="add" class="big-btn primary-btn">Add</button>
                </div>
            </form>
		</div>
	</div>
	<script>
var loadBestColor = function(event) {
	var image = document.getElementById('best-color');
	image.src = URL.createObjectURL(event.target.files[0]);
	
};

var loadSisterColor = function(event) {
	var image = document.getElementById('sister-color');
	image.src = URL.createObjectURL(event.target.files[0]);
	
};

var loadWorstColor = function(event) {
	var image = document.getElementById('worst-color');
	image.src = URL.createObjectURL(event.target.files[0]);
	
};
</script>
</body>
</html>