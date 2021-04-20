<?php
// Usage: Help to check unique user name  for register page


require "includes/library.php";

$pdo = connectDB();

// get the username 
$username = $_GET['username'] ?? null;


//get unique username(test username if it exists in database)
$query = "SELECT *  FROM `finalProjectUser` WHERE username = ?";

 $statement = $pdo->prepare($query);
 $statement->execute([$username]);
 $results = $statement->fetch();

 //  if there is not any result match with user name
if($results===false){

 echo "0"; 

}
// on the other hand
else{
    echo "1";
}
exit();
 ?>