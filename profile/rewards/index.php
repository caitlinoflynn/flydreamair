<?php
include("../..path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/users.php");

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
}

$levels = getTierLevel();

if(isset($_POST['add-points'])) {
    $sql = "UPDATE users SET lifetime_points = lifetime_points + " . $_POST['points'] . ", points = points + " . $_POST['points'] . " WHERE id = " . $_SESSION['id'];
    if(mysqli_query($conn, $sql)) {
        if($liftimePoints < 5000) {
            $sql3 = "UPDATE flydreamair_user_levels SET level_id = 1 WHERE user_id = " . $_SESSION['id'];
            if(mysqli_query($conn, $sql3)) {
                header('location: ' . FDA_BASE_URL . '/profile/rewards/' . $_SESSION['id'] . '/');
            }
        }
        if($liftimePoints < 15000) {
            $sql4 = "UPDATE flydreamair_user_levels SET level_id = 2 WHERE user_id = " . $_SESSION['id'];
            if(mysqli_query($conn, $sql4)) {
                header('location: ' . FDA_BASE_URL . '/profile/rewards/' . $_SESSION['id'] . '/');
            }
        }
        if($liftimePoints < 250000) {
            $sql5 = "UPDATE flydreamair_user_levels SET level_id = 3 WHERE user_id = " . $_SESSION['id'];
            if(mysqli_query($conn, $sql5)) {
                header('location: ' . FDA_BASE_URL . '/profile/rewards/' . $_SESSION['id'] . '/');
            }
        }
         if($liftimePoints = 250000 || $liftimePoints > 250000) {
            $sql5 = "UPDATE flydreamair_user_levels SET level_id = 4 WHERE user_id = " . $_SESSION['id'];
            if(mysqli_query($conn, $sql5)) {
                header('location: ' . FDA_BASE_URL . '/profile/rewards/' . $_SESSION['id'] . '/');
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Rewards</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/header.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/footer.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/main.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/profile.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/rewards.css' ?>">
</head>
<body>
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
<div class="rewards-container">
        <div class="content">
            <div class="right-side">
                <div class="filter-bar">
          <ul>
            <div class="welcome">
               <h3>Welcome, <?php echo $firstname ?></h3>
            </div>
            <a href="<?php echo FDA_BASE_URL . '/profile/' . $_SESSION['id'] . '/' ?>">
              <li>
                My Details
              </li>
            </a>
            <a href="<?php echo FDA_BASE_URL . '/profile/rewards/' . $_SESSION['id'] . '/' ?>">
              <li class="active">
                My Rewards
              </li>
            </a>
            <a href="<?php echo FDA_BASE_URL . '/profile/wishlist/' . $_SESSION['id'] . '/' ?>">
              <li>
                My Wishlist
              </li>
            </a>
            <a href="<?php echo FDA_BASE_URL . '/profile/order-history/' . $_SESSION['id'] . '/' ?>">
              <li>
                Order History
              </li>
            </a>
            <a href="<?php echo FDA_BASE_URL . '/profile/address-book/' . $_SESSION['id'] . '/' ?>">
              <li>
                Address Book
              </li>
            </a>
            <a href="<?php echo FDA_BASE_URL . '/profile/saved-cards/' . $_SESSION['id'] . '/' ?>">
              <li>
                Saved Cards
              </li>
            </a>
            <a href="<?php echo FDA_BASE_URL . '/profile/track-order/' . $_SESSION['id'] . '/' ?>">
              <li>
                Track Order
              </li>
            </a>
            <a href="<?php echo FDA_BASE_URL . '/profile/sign-out/' ?>">
              <li>
                Sign Out
              </li>
            </a>
          </ul>
        </div>
                <div class="products">
                    <h1 class="heading">My Rewards</h1>
                    <p class="info">Check your progress with your rewards points.</p>
                    <div class="details">
                        <div class="detail">
                            <p id="points">Current Points:</p>
                            <p><?php echo number_format($points) ?> points</p>
                        </div>
                        <div class="detail">
                            <p id="level">Tier Level:</p>
                            <?php foreach ($levels as $key => $level): ?>
                            <p><?php echo $level['name']?></p>
                            <?php endforeach ?>
                            <form action="index" method="post">
                                <input type="number" name="points" class="input" placeholder="add points">
                                <button name="add-points" type="submit" class="primary-btn">Add points</button>
                            </form>
                        </div>
                        <div class="detail">
                            <p>Lifetime Points:</p>
                            <p id="points"><?php echo $lifetimePoints ?></p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo FDA_BASE_URL . '/js/js.js' ?>"></script>
</body>
</html>