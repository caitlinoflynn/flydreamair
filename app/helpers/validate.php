<?php

function validateUser($user) {
   $errors = array();

   if (empty($user['username'])) {
       array_push($errors, 'Username is required');
   }

   if (empty($user['email'])) {
       array_push($errors, 'Email is required');
   }

        $existingUser = selectOne('users', ['email' => $user['email']]);
        if ($existingUser) {
            if (isset($user['update-user']) && $existingUser['id'] != $user['id']) {
                array_push($errors, 'Email already exists');
            }

            if(isset($user['create-admin'])) {
                array_push($errors, 'Email already exists');
            }
            if(isset($user['sign-up'])) {
                array_push($errors, 'Email already exists');
            }
        }

  return $errors;
}

function validateLogin($user) {
   $errors = array();

   if (empty($user['email'])) {
       array_push($errors, 'Email is required');
   }

   if (empty($user['password'])) {
       array_push($errors, 'Password is required');
   }

  return $errors;
}

function validateLoginViaEmail($user) {
   $errors = array();

   if (empty($user['email'])) {
       array_push($errors, 'Email is required');
   }

   if (empty($user['password'])) {
       array_push($errors, 'Password is required');
   }

  return $errors;
}


 function validateSeason($season) {
    $errors = array();

    if (empty($season['name'])) {
        array_push($errors, 'Name is required');
    }

    $existingSeason = selectOne('seasons', ['name' => $season['name']]);
    if ($existingSeason) {
        if (isset($season['update']) && $existingSeason['id'] != $season['id']) {
            array_push($errors, 'Season already exists');
        }

        if(isset($season['add'])) {
            array_push($errors, 'Season already exists');
        }
    }

    return $errors;
}



function validateSeasonColor($seasonColor) {
    $errors = array();

    if (empty($seasonColor['color_name'])) {
        array_push($errors, 'Name is required');
    }

/*
    $existingSeasonColor = selectOne('season_colors', ['color_name' => $seasonColor['color_name']]);
    if ($existingSeasonColor) {
        if (isset($seasonColor['update']) && $existingSeasonColor['id'] != $seasonColor['id']) {
            array_push($errors, 'Name already exists');
        }

        if(isset($seasonColor['add'])) {
            array_push($errors, 'Name already exists');
        }
    }
    */

    return $errors;
}

function validateSeasonCeleb($seasonCeleb) {
    $errors = array();

    if (empty($seasonCeleb['celeb_name'])) {
        array_push($errors, 'Name is required');
    }

    $existingSeasonCeleb = selectOne('season_celebrities', ['celeb_name' => $seasonCeleb['celeb_name']]);
    if ($existingSeasonCeleb) {
        if (isset($seasonCeleb['update']) && $existingSeasonCeleb['id'] != $seasonCeleb['id']) {
            array_push($errors, 'Celebrity already exists');
        }

        if(isset($seasonCeleb['add'])) {
            array_push($errors, 'Celebrity already exists');
        }
    }

    return $errors;
}

 function validateFaceShape($faceShape) {
    $errors = array();

    if (empty($faceShape['name'])) {
        array_push($errors, 'Name is required');
    }

    $existingFaceShape = selectOne('face_shapes', ['name' => $faceShape['name']]);
    if ($existingFaceShape) {
        if (isset($faceShape['update']) && $existingFaceShape['id'] != $faceShape['id']) {
            array_push($errors, 'Face shape already exists');
        }

        if(isset($faceShape['add'])) {
            array_push($errors, 'Face shape already exists');
        }
    }

    return $errors;
}

function validateMakeupProduct($makeUp) {
    $errors = array();

    if (empty($makeUp['product_name'])) {
        array_push($errors, 'Name is required');
    }

    $existingMakeupProduct = selectOne('makeup', ['product_name' => $makeUp['product_name']]);
    if ($existingMakeupProduct) {
        if (isset($makeUp['update']) && $existingMakeupProduct['id'] != $makeUp['id']) {
            array_push($errors, 'Celebrity already exists');
        }

        if(isset($makeUp['add'])) {
            array_push($errors, 'Makeup product already exists');
        }
    }

    return $errors;
}









function validateFDALogin($user) {
   $errors = array();

   if (empty($user['email'])) {
       array_push($errors, 'Username is required');
   }

   if (empty($user['password'])) {
       array_push($errors, 'Password is required');
   }

  return $errors;
}

function validateCategory($category) {
    $errors = array();

    if (empty($category['name'])) {
        array_push($errors, 'Name is required');
    }

    $existingCategory = selectOne('flydreamair_categories', ['name' => $category['name']]);
    if ($existingCategory) {
        if (isset($category['update']) && $existingCategory['id'] != $category['id']) {
            array_push($errors, 'Celebrity already exists');
        }

        if(isset($category['add'])) {
            array_push($errors, 'Makeup product already exists');
        }
    }

    return $errors;
}

function validateProduct($product) {
    $errors = array();

    if (empty($product['name'])) {
        array_push($errors, 'Name is required');
    }

    $existingProduct = selectOne('flydreamair_products', ['name' => $product['name']]);
    if ($existingProduct) {
        if (isset($product['update']) && $existingProduct['id'] != $product['id']) {
            array_push($errors, 'Celebrity already exists');
        }

        if(isset($product['add'])) {
            array_push($errors, 'Makeup product already exists');
        }
    }

    return $errors;
}

 function validateWishlist($wishlist) {
    $errors = array();

    if (empty($wishlist['quantity'])) {
        array_push($errors, 'Quantity is required');
    }

    $existingWishlist = selectOne('flydreamair_wishlist', ['quantity' => $wishlist['quantity']]);
    if ($existingWishlist) {
        if (isset($season['update']) && $existingWishlist['id'] != $wishlist['id']) {
            array_push($errors, 'You already have this item in your wishlist');
        }

        if(isset($season['add-wishlist'])) {
            array_push($errors, 'You already have this item in your wishlist');
        }
    }

    return $errors;
}