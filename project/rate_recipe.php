<?php 
// Description: update the rating value for a recipe

//include the library file
require 'includes/library.php';
// create the database connection
$pdo = connectDB();

$recipe_id = $_GET["recipe_id"] ?? null;
$new_rate = $_GET["new_rate"] ?? null;
$rating = $_GET["rating"] ?? null;
$num_rating = $_GET["num_rating"] ?? null;

// get new rating
$new_num_rating = $num_rating +1;
$rate = ($rating*$num_rating + $new_rate)/$new_num_rating;

// update rating
$update_rate = "UPDATE `cois3420_project_recipe` 
                SET rating = $rate, 
                    num_rating = $new_num_rating where ID=$recipe_id";
$update_stmt = $pdo->query($update_rate);

$_SESSION['rating'] = $rate;
$_SESSION['num_rating'] = $new_num_rating;

exit();
?>

