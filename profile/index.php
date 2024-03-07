<?php
include("../path.php");
include(ROOT_PATH . "/app/database/config.php");
include(ROOT_PATH . "/app/controllers/users.php");

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Details</title>
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/header.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/footer.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/main.css' ?>">
    <link rel="stylesheet" href="<?php echo FDA_BASE_URL . '/style/profile.css' ?>">
</head>
<body>
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
<div class="container">
    <div class="content">
        <div class="right-side">
            <div class="filter-bar">
          <ul>
            <div class="welcome">
              <h3>Welcome, <?php echo $firstname ?></h3>
            </div>
            <a href="<?php echo BASE_URL . '/projects/flydreamair/profile/' . $_SESSION['id'] . '/' ?>">
              <li class="active">
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
                <div class="show-details">
                    <h1 class="heading">My Details</h1>
                    <p>Edit your information and login details here.</p>
                    <div class="details">
                        <div class="detail">
                            <p id="firstname">First name:</p>
                            <p><?php echo $firstname ?></p>
                        </div>
                        <div class="detail">
                            <p id="lastname">Last name:</p>
                            <p><?php echo $lastname ?></p>
                        </div>
                        <div class="detail">
                            <p id="email">Email:</p>
                            <p><?php echo $email ?></p>
                        </div>
                        <div class="detail">
                            <p id="dob">DOB:</p>
                            <p><?php echo $dob ?></p>
                        </div>
                        <div class="detail">
                            <p id="phone-number">Phone Number:</p>
                            <p><?php echo $phoneNumber ?></p>
                        </div>

                    </div>
                    <button class="edit primary-btn">Edit</button>
                </div>
                <form id="profile-form">
                    <h1 class="heading">My Details</h1>
                    <p>Edit your information and login details here.</p>
                    <div class="form-control">
                        <small>Error message</small>
                        <br>
                        <p class="label">
                            First Name*
                        </p>
                        <input class="stretch input" id="edit-firstname" type="text">
                    </div>

                    <div class="form-control">
                        <small>Error message</small>
                        <br>
                        <p class="label">
                            Last Name*
                        </p>
                        <input class="stretch input" id="edit-lastname" type="text">
                    </div>

                    <div class="form-control">
                        <small>Error message</small>
                        <br>
                        <p class="label">
                            Email*
                        </p>
                        <input class="stretch input" id="edit-email" type="text">
                    </div>

                    <div class="form-control">
                        <small>Error message</small>
                        <br>
                        <p class="label">
                            DOB*
                        </p>
                        <input class="stretch input" id="edit-dob" type="date">
                    </div>

                    <div class="form-control">
                        <small>Error message</small>
                        <br>
                        <p class="label">
                            Phone Number*
                        </p>
                        <input class="stretch input" id="edit-phone" type="text">
                    </div>
                    <div class="form-control">
                        <button type="submit" class="stretch primary-btn save">Save</button>
                        <div class="cancel">
                               <span>
                                   <u>Cancel</u>
                               </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include(ROOT_PATH . "/app/includes/projects/footer.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo FDA_BASE_URL . '/js/js.js' ?>"></script>
<script src="<?php echo FDA_BASE_URL . '/js/profile-validation.js' ?>"></script>
</body>
</html>