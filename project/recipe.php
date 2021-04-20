<?php
// Description: get recipe information from database for     
//              displaying it on a modal window  

session_start();
//include the library file
require 'includes/library.php';
// create the database connection
$pdo = connectDB();

$recipe_id = $_GET["recipe_id"] ?? null;
$recipe_id = (int) $recipe_id;
$_SESSION['recipe_id'] = $recipe_id;

// get data from database
$get_recipe = "SELECT * FROM `cois3420_project_recipe`  where ID=?";
$get_stmt = $pdo->prepare($get_recipe);
$get_stmt->execute([$recipe_id]);
$row = $get_stmt->fetch();

$errors = array(); //declare empty array to add errors
//collect data from user
$array = [];

$array["title"] = $row['title'];
$array["username"] = $row['username'];
$array["author_id"] = $row['user_id'];
$array["current_user_id"] = $_SESSION['userid'];
$array["private"] = $row['private'];
$array["tags"] = $row['tags'];
$array["rating"] = $row['rating'];
$array["num_rating"] = $row['num_rating'];
$array["image_filename"] = $row['image'];
$array["serving"] = $row['serving'];
$array["difficulty"] = $row['difficulty'];
$array["prep_hour"] = $row['prep_hour'];
$array["cook_hour"] = $row['cook_hour'];
$array["prep_min"] = $row['prep_min'];
$array["cook_min"] = $row['cook_min'];
$array["recipe_ingredients"] = $row['recipe_ingredients'];
$array["recipe_directions"] = $row['recipe_directions'];

$_SESSION['author_name'] = $row['username'];
$_SESSION['author_id'] = $row['user_id'];
$_SESSION['rating'] = $row['rating'];
$_SESSION['num_rating'] = $row['num_rating'];


echo json_encode($array);

exit();
?>




