<?php
//include the library file
require 'includes/library.php';
// create the database connection
$pdo = connectDB();
//session login status
if (!isset($_SESSION['loginStatus'])) {
  $_SESSION['loginStatus'] = false;
}
$loginStatus = $_SESSION['loginStatus'];
//session search status, keeps search status even refresh page
if (!isset($_SESSION['searchStatus'])) {
  $_SESSION['searchStatus'] = false;
} 
?>

<nav>
  <ul>
    <li><i class="fas fa-utensils"></i></li>
    <li><a href="MainPage.php">Home</a></li>
    <li class="<?= !$_SESSION['loginStatus'] ? '' : "hidden"; ?>"><a href="login.php">Login/SignUp</a></li>
    <li class="<?= !$_SESSION['loginStatus'] ? 'hidden' : ""; ?>"><a href="user.php">Personal info</a></li>
    
  </ul>

    <form class="nav_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" novalidate>
      <i class="fas fa-search"></i>
      <input type="text" name="search" placeholder="Find your recipe...">
      <button type="submit" id="searchButtonForAll" name="searchButtonForAll">Search All</button>
      <button type="submit" id="searchButtonForMyself" name="searchButtonForMyself">Search Myself</button>
    
    </form>
  
</nav>


<?php

//do the program if user is logged in
if ($loginStatus === true) {
  $username = $_SESSION['user'];
  $user_id = $_SESSION['userid'];
  //search
  $search = $_POST['search'] ?? null;
  $_SESSION['searchStatus'] = false;
  $link = $_GET['homepage'] ?? null;;
  if(isset($link)){
    $_SESSION['searchStatus'] = false;
  }
  //if user not search or the first time enter main page, print out all of their recipes
  if($_SESSION['searchStatus'] === false){
    if ((!isset($search) || strlen($search) === 0)) {
      $pagelimit = 11;  //limit of each page, default display page have 'create recipe, so pagelimit will be 12 - 1 = 11
      $rowcount = 0;  //total count for all the recipes
      //display recipe
      echo "<div id='recipeDisplayPart'>";
      echo "<button class='create_new_recipe' name='go_to_create_new'>";
      echo "<i class='fas fa-plus'></i><span class='recipeContent'>Create new</span>";
      echo "</button>";
      if (isset($_POST['go_to_create_new'])) {
        header("Location:create_recipe.php");
      }
          //pagination

          //get total row for calcualte page
          $total = $pdo ->query("SELECT COUNT(*) FROM `cois3420_project_recipe` WHERE user_id = '$user_id' ORDER BY title")->fetchColumn();
          //if nothing can be fetch, then tell user no receipes can be print
          if($total === 0 || is_null($total) || empty($total)){
            echo "<div id='recipeDisplayPart'>";
            echo "You don't have any recipes yet!";
            echo "</div>";
          }else{
            //the number of page will be display
            $pagecount = ceil($total/$pagelimit);
            //get page
            $page = min($pagecount, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
              'options' => array(
              'default'   => 1,
              'min_range' => 1,),)));
            //the offset for fetch next page
            $offset = ($page - 1) * $pagelimit;
            //the index of row
            $start = $offset + 1;
            //the count of row displayed
            $end = min(($offset + $pagelimit), $total);
            // The "back" link
            $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
        
            // The "forward" link
            $nextlink = ($page < $pagecount) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pagecount . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
        
        
            // Prepare the paged query
            $queryForPage = "SELECT * FROM `cois3420_project_recipe` WHERE user_id = '$user_id' ORDER BY title LIMIT $pagelimit OFFSET $offset";
            $stmt = $pdo->query($queryForPage);
            $pagination = $stmt->fetchAll();
            //fetch all the recipes
            foreach ($pagination as $row) {
              $rowcount++;
              echo "<button type='submit' name='".$row['ID']."' class='recipe'>";
              echo "<span class='recipeTitle'>" .$row['title'] . "</span>";
              echo "<span class='recipeContent'>" . "Creator: " .$row['username'] . "</span>";
              echo "<span class='recipeContent'>" . "Tag: ".$row['tags']. "</span>";
              echo "<span class='recipeContent'>" ." Rating: " .$row['rating']. "</span>";
        
              echo "</button>";
            }
            echo "</div>";
            // Display the paging information
            echo "<div id='paging'><p>", $prevlink, " Page ", $page, " of ", $pagecount, " pages, displaying user's recipes ", $start, "-", $end, " of ", $total, " results ", $nextlink, " </p></div>";
          }
    }
  
  }
  
  //if search bar have content
  //if button search all clicked
  if (isset($_POST['searchButtonForAll'])) {
    //togle search status to true
    $_SESSION['searchStatus'] = true;
    //check if search bar is empty
    if (!isset($search) || strlen($search) === 0) {
      echo "empty content";
    }
    //do search
    if (strlen($search) !== 0) {
      $pagelimit2 = 12;  //limit of each page
      $rowcount = 0;
      //pagination
      $total2 = $pdo ->query("SELECT COUNT(*) FROM `cois3420_project_recipe` WHERE title LIKE '%$search%' AND (private = 'N' OR user_id = '$user_id') ORDER BY title")->fetchColumn();
      if($total2 === 0 || is_null($total2) || empty($total2)){
        echo "<div id='recipeDisplayPart'>";
        echo "nothing find";
        echo "</div>";
      }else{
        $pagecount2 = ceil($total2/$pagelimit2);
        $page2 = min($pagecount2, filter_input(INPUT_GET, 'Searchpage', FILTER_VALIDATE_INT, array(
          'options' => array(
          'default'   => 1,
          'min_range' => 1,),)));
        $offset2 = ($page2 - 1) * $pagelimit2;
        $start2 = $offset2 + 1;
        $end2 = min(($offset2 + $pagelimit2), $total2);
        // The "back" link
        $prevlink2 = ($page2 > 1) ? '<a href="?Searchpage=1" title="First page">&laquo;</a> <a href="?Searchpage=' . ($page2 - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
    
        // The "forward" link
        $nextlink2 = ($page2 < $pagecount2) ? '<a href="?Searchpage=' . ($page2 + 1) . '" title="Next page">&rsaquo;</a> <a href="?Searchpage=' . $pagecount2 . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
            
        // Prepare the paged query
        $queryForPage2 = "SELECT * FROM `cois3420_project_recipe` WHERE title LIKE '%$search%' AND (private = 'N' OR user_id = '$user_id') ORDER BY title LIMIT $pagelimit2 OFFSET $offset2";
        $stmt2 = $pdo->query($queryForPage2);
        $pagination2 = $stmt2->fetchAll();
        
        //display recipe
        echo "<div id='recipeDisplayPart'>";
        foreach ($pagination2 as $row2) {
          $rowcount++;
          echo "<button type='submit' name='".$row2['ID']."' class='recipe'>";
          echo "<span class='recipeTitle'>" .$row2['title'] . "</span>";
          echo "<span class='recipeContent'>" . "Creator: " .$row2['username'] . "</span>";
          echo "<span class='recipeContent'>" . "Tag: ".$row2['tags']. "</span>";
          echo "<span class='recipeContent'>" ." Rating: " .$row2['rating']. "</span>";
    
          echo "</button>";
        }
        echo "</div>";
        echo "<div id='paging'><p>Search result for: <strong>" . $search ."</strong> include others recipes!</p>";
        // Display the paging information
        echo "<p>", $prevlink2, " Page ", $page2, " of ", $pagecount2, " pages, displaying searched content ", $start2, "-", $end2, " of ", $total2, " results ", $nextlink2, " </p></div>";
        
      }
    }
  }
  //if button search myself clicked
  if(isset($_POST['searchButtonForMyself'])){
    $_SESSION['searchStatus'] = true;
    echo "test";
    if (!isset($search) || strlen($search) === 0) {
      echo "empty content";
    }
    if (strlen($search) !== 0) {
      $pagelimit2 = 12;  //limit of each page
      $rowcount = 0;
      //pagination
      $total2 = $pdo ->query("SELECT COUNT(*) FROM `cois3420_project_recipe` WHERE user_id = '$user_id' AND title LIKE '%$search%' ORDER BY title")->fetchColumn();
      if($total2 === 0 || is_null($total2) || empty($total2)){
        echo "<div id='recipeDisplayPart'>";
        echo "nothing find";
        echo "</div>";
      }else{
        $pagecount2 = ceil($total2/$pagelimit2);
        $page2 = min($pagecount2, filter_input(INPUT_GET, 'Searchpage', FILTER_VALIDATE_INT, array(
          'options' => array(
          'default'   => 1,
          'min_range' => 1,),)));
        $offset2 = ($page2 - 1) * $pagelimit2;
        $start2 = $offset2 + 1;
        $end2 = min(($offset2 + $pagelimit2), $total2);
        // The "back" link
        $prevlink2 = ($page2 > 1) ? '<a href="?Searchpage=1" title="First page">&laquo;</a> <a href="?Searchpage=' . ($page2 - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
    
        // The "forward" link
        $nextlink2 = ($page2 < $pagecount2) ? '<a href="?Searchpage=' . ($page2 + 1) . '" title="Next page">&rsaquo;</a> <a href="?Searchpage=' . $pagecount2 . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
    
    
        // Prepare the paged query
        $queryForPage2 = "SELECT * FROM `cois3420_project_recipe` WHERE user_id = '$user_id' AND title LIKE '%$search%' ORDER BY title LIMIT $pagelimit2 OFFSET $offset2";
        $stmt2 = $pdo->query($queryForPage2);
        $pagination2 = $stmt2->fetchAll();
        
        //display recipe
        echo "<div id='recipeDisplayPart'>";
        foreach ($pagination2 as $row2) {
          $rowcount++;
          echo "<button type='submit' name='".$row2['ID']."' class='recipe'>";
          echo "<span class='recipeTitle'>" .$row2['title'] . "</span>";
          echo "<span class='recipeContent'>" . "Creator: " .$row2['username'] . "</span>";
          echo "<span class='recipeContent'>" . "Tag: ".$row2['tags']. "</span>";
          echo "<span class='recipeContent'>" ." Rating: " .$row2['rating']. "</span>";
    
          echo "</button>";
        }
        echo "</div>";
        // Display the paging information
        echo "<div id='paging'><p>Search result for: <strong>" . $search ."</strong> in my own collection!</p>";
        // Display the paging information
        echo "<p>", $prevlink2, " Page ", $page2, " of ", $pagecount2, " pages, displaying searched content ", $start2, "-", $end2, " of ", $total2, " results ", $nextlink2, " </p></div>";
             }
    }
  }

    //log out 
    if (isset($_POST['out'])) {

      session_destroy();
      header('location:login.php');
  }
} 
//if user not login yet, then redirect to login page
else {
  header("Refresh: 5; URL = login.php");
  echo "<div class='login-message'><p>Login to view all your recipes</p><p>Or signup to create new!</p><p>Now redirect to login page...</p></div>";
}
?>