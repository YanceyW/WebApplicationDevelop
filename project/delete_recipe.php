<?php 
// Description: delete the recipe selected


//include the library file
require 'includes/library.php';
// create the database connection
$pdo = connectDB();

$recipe_id = $_GET["recipe_id"] ?? null;
// $recipe_id = (int) $recipe_id;

$get_recipe = "DELETE FROM `cois3420_project_recipe`  where ID=?";
$get_stmt = $pdo->prepare($get_recipe);
$get_stmt->execute([$recipe_id]);
$row = $get_stmt->fetch();


echo 'delete '.$recipe_id;
exit();
?>
