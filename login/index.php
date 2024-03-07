<?php
include("../path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/users.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/header.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/footer.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/main.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/login.css' ?>">
    
</head>
<body>
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
<div class="wrap">
    <div class="container">
        <div class="content">
            <h1 class="poppins">Log In</h1>
	    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
	    <form action="index" method="post" id="login-form">
	        <div class="form-control">
	        <input name="email" type="text" class="input" placeholder="Email" id="email">
	    </div>
	    <div class="form-control">
	        <input name="password" type="password" class="input" placeholder="Password" id="password">
	    </div>
	    <div class="form-control">
	        <input type="submit" class="submit-btn" name="login" value="Login">
	    </div> 
	    </form>
                <div class="links">
                    <p>Not a FlyDreamAir Member? <a class="link"><u>Join now</u></a></p>
                    <p>Forgot your <a class="link"><u>FlyDreamAir membership number</u></a>?</p>
                </div>
            </form>
        </div>
    </div>
</div>
    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
</body>
</html>