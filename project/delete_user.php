<?php 
// Usage: help to delete user information in the personal information page of users 


require 'includes/library.php';
session_start();

$pdo = connectDB();

// delete the recipes that belong to this user
$delete_recipe = "DELETE FROM `cois3420_project_recipe`  where user_id=?";
$get_stmt = $pdo->prepare($delete_recipe);
$get_stmt->execute([$_SESSION['userid']]);

// delete the account that belong to this user
$query = "DELETE from `finalProjectUser` WHERE ID =?";
$stmt3 = $pdo->prepare($query);
$stmt3->execute([$_SESSION['userid']]);

//end the section 
session_destroy();
//end the login statues 
$_SESSION['loginStatus'] = false;

exit(); 


?>