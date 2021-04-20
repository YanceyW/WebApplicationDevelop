<?php
session_start();
//include the library file
require 'includes/library.php';
// create the database connection
$pdo = connectDB();

$get_recipe = "SELECT * FROM `cois3420_project_recipe`  where ID=?";
$get_stmt = $pdo->prepare($get_recipe);
$get_stmt->execute([$_SESSION['recipe_id']]);
$row = $get_stmt->fetch();

$errors = array(); //declare empty array to add errors
$username = null;
$rating = null;

$_SESSION['rating'] = $row['rating'];
$_SESSION['num_rating'] = $row['num_rating'];
if (!isset($_POST['save'])) {
    //collect data from database
    $title = $row['title'];
    $username = $row['username'];
    $user_id = $row['user_id'];
    $private = $row['private'];
    $tags = $row['tags'];
    $rating = $row['rating'];
    $image_filename = $row['image'];
    $serving = $row['serving'];
    $difficulty = $row['difficulty'];
    $prep_hour = $row['prep_hour'];
    $cook_hour = $row['cook_hour'];
    $prep_min = $row['prep_min'];
    $cook_min = $row['cook_min'];
    $recipe_ingredients = $row['recipe_ingredients'];
    $recipe_directions = $row['recipe_directions'];
}

// function used to get data from user
function collect_data()
{
    global $errors, $title, $private, $tags, $serving, $difficulty,
        $prep_hour, $cook_hour, $prep_min, $cook_min, $recipe_ingredients,
        $recipe_directions, $image_filename;

    $title = $_POST['title'];
    $private = $_POST['private'] ?? null;
    $tags = $_POST['tags'];
    $serving = $_POST['serving'];
    $difficulty = $_POST['difficulty'];
    $prep_hour = $_POST['prep_hour'];
    $cook_hour = $_POST['cook_hour'];
    $prep_min = $_POST['prep_min'];
    $cook_min = $_POST['cook_min'];
    $recipe_ingredients = $_POST['recipe_ingredients'];
    $recipe_directions = $_POST['recipe_directions'];

    $image_filename = $_FILES['image']['name'];
    $target_dir = "/home/claireli/public_html/www_data/recipe_images/";
    $target_file = $target_dir . basename($image_filename);
    $tmp_name = $_FILES['image']['tmp_name'];
    $file_error = $_FILES['image']['error'];
    if ($file_error == UPLOAD_ERR_OK && is_uploaded_file($tmp_name)) {
        move_uploaded_file($tmp_name, $target_file);
    } else {
        echo "File cannot be uploaded.";
    }
    //checking for empty title
    if (!isset($title) || strlen($title) === 0) {
        $errors['title'] = true;
    }
    //checking if private or not
    if (!isset($private) || strlen($private) == 0) {
        $private = "N";
    }
    //checking for empty serving number
    if (!isset($serving) || strlen($serving) == 0) {
        $errors['serving'] = true;
    }
    //checking for empty difficulty level
    if (!isset($difficulty) || strlen($difficulty) == 0) {
        $errors['difficulty'] = true;
    }
    //checking for empty prepare time
    if ((!isset($prep_hour) && !isset($prep_min)) || (strlen($prep_hour) == 0 && strlen($prep_min) == 0)) {
        $errors['prep_time'] = true;
    }
    //checking for empty cook time
    if ((!isset($cook_hour) && !isset($cook_min)) || (strlen($cook_hour) == 0 && strlen($cook_min) == 0)) {
        $errors['cook_time'] = true;
    }
    if ($prep_hour == null) {
        $prep_hour = 0;
    }
    if ($cook_hour == null) {
        $cook_hour = 0;
    }
    if ($cook_hour == null) {
        $cook_hour = 0;
    }
    if ($prep_min == null) {
        $prep_min = 0;
    }
    if ($cook_min == null) {
        $cook_min = 0;
    }

    if (!isset($recipe_ingredients) || strlen($recipe_ingredients) == 0) {
        $errors['ingredients'] = true;
    }
    if (!isset($recipe_directions) || strlen($recipe_directions) == 0) {
        $errors['directions'] = true;
    }

    return count($errors);
}

// save changes
$count_error;
if (isset($_POST['save'])) {
    $count_error = collect_data();

    if ($count_error === 0) {

        // $_SESSION['num_error'] = 0;
        $update_data = "UPDATE `cois3420_project_recipe` 
                        SET title = '" . $title . "', 
                            private = '$private',
                            tags = '$tags', 
                            image = '$image_filename',
                            serving = $serving,
                            difficulty = '$difficulty',
                            prep_hour = $prep_hour,
                            prep_min = $prep_min, 
                            cook_hour = $cook_hour,
                            cook_min = $cook_min,
                            recipe_ingredients = '$recipe_ingredients',  
                            recipe_directions = '$recipe_directions'
                        where ID=?";

        $update_stmt = $pdo->prepare($update_data);
        $update_stmt->execute([$_SESSION['recipe_id']]);
        header("Location:MainPage.php");
    }
}

// copy and create new recipe
if (isset($_POST['copy_create'])) {
    $count_error = collect_data();
    if ($count_error === 0) {
        $recipe_data = "INSERT INTO `cois3420_project_recipe` 
        (user_id, title, username, private, tags, rating, num_rating, image, serving, difficulty, 
        prep_hour, prep_min, cook_hour, cook_min, recipe_ingredients, recipe_directions) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($recipe_data);
        $stmt->execute([
            $_SESSION['userid'], $title, $_SESSION['author_name'], $private, $tags,
            $_SESSION['rating'], $_SESSION['num_rating'], $image_filename, $serving,
            $difficulty, $prep_hour, $prep_min, $cook_hour, $cook_min,
            $recipe_ingredients, $recipe_directions
        ]);
        header("Location:MainPage.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $PAGE_TITLE = "Edit Recipe";
    include 'includes/metadata.php';
    ?>

</head>

<body>
    <!-- ========================================================================= -->
    <!-- file name: edit_recipe.php                                                -->
    <!-- page for edit a recipe. Previous information is pre-populated for editing -->
    <!-- ========================================================================= -->

    <!-- HEADER -->
    <?php
    include "includes/header.php";
    ?>
    <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" novalidate>
        <!-- =========================
            Recipe Title 
        ============================== -->
        <div class="recipe_title">
            <h1>Edit recipe</h1>
            <div>
                <label for="title">Recipe Title: </label>
                <input type="text" name="title" id="title" value="<?php echo $title; ?>">
                <span id="titleError" class="error <?= !isset($errors['title']) ? 'hidden' : ""; ?>">*Please enter a title</span>
            </div>
            <div>
                <label>Author name: </label>
                <?php echo '<br>' . $username; ?>
            </div>

            <div class="recipe_info">
                <div class="private_check">
                    <input type="checkbox" name="private" id="private" value="Y" <?php if ($private == "Y") echo 'checked="checked"'; ?>>
                    <label for="private">private</label>
                </div>
                <div class="recipe_tags">
                    <label for="tags">tags: </label>
                    <input type="text" name="tags" id="tags" value="<?php echo $tags; ?>">
                </div>
                <p>rating: <?= $rating == null ? '--' : $rating; ?></p>
            </div>
            <div>
                <label for="image">You can place an image of your dish here. It's optional.</label>
                <input type="file" name="image" id="image">
            </div>
        </div>
        <!-- =========================
            Recipe introduction 
        ============================== -->
        <div class="intro">
            <div>
                <span>Servings</span>
                <input type="number" name="serving" id="serving" value="<?php echo $serving; ?>">
            </div>
            <div>
                <span>Difficulty</span>
                <input type="text" name="difficulty" list="difficulty" value="<?php echo $difficulty; ?>" />
                <datalist id="difficulty">
                    <option>easy</option>
                    <option>medium</option>
                    <option>hard</option>
                </datalist>
            </div>
            <div class="time">
                <span>Prep time</span>
                <div class="prep_time">
                    <input type="number" name="prep_hour" id="prep_hour" value="<?php echo $prep_hour; ?>">
                    <label for="prep_hour">h</label>
                </div>
                <div class="prep_time">
                    <input type="number" name="prep_min" id="prep_min" value="<?php echo $prep_min; ?>">
                    <label for="prep_min">min</label>
                </div>
            </div>
            <div class="time">
                <span>Cook time</span>
                <div class="cook_time">
                    <input type="number" name="cook_hour" id="cook_hour" value="<?php echo $cook_hour; ?>">
                    <label for="cook_hour">h</label>
                </div>
                <div class="cook_time">
                    <input type="number" name="cook_min" id="cook_min" value="<?php echo $cook_min; ?>">
                    <label for="cook_min">min</label>
                </div>
            </div>
        </div>

        <div class="intro_error">
            <span id="servingError" class="error <?= !isset($errors['serving']) ? 'hidden' : ""; ?>">*Please give a serving number</span>
            <span id="difficultyError" class="error <?= !isset($errors['difficulty']) ? 'hidden' : ""; ?>">*Please select a difficulty level</span>
            <span id="prep_timeError" class="error <?= !isset($errors['prep_time']) ? 'hidden' : ""; ?>">*Please enter prepare time</span>
            <span id="cook_timeError" class="error <?= !isset($errors['cook_time']) ? 'hidden' : ""; ?>">*Please enter cook time</span>
        </div>

        <!-- =========================
            Recipe ingredients
        ============================== -->
        <div class="ingredient">
            <h2>Ingredients</h2>
            <textarea name="recipe_ingredients" id="recipe_ingredients" cols="30" rows="10" placeholder="enter ingredients here"><?php echo $recipe_ingredients; ?></textarea>
            <span id="ingredientError" class="error <?= !isset($errors['ingredients']) ? 'hidden' : ""; ?>">*Please enter ingredients</span>
        </div>

        <!-- =========================
            Recipe directions 
        ============================== -->
        <div class="directions">
            <h2>Directions</h2>
            <textarea name="recipe_directions" id="recipe_directions" cols="30" rows="10" placeholder="enter directions here"><?php echo $recipe_directions; ?></textarea>
            <span id="directionsError" class="error <?= !isset($errors['directions']) ? 'hidden' : ""; ?>">*Please enter directions</span>
        </div>

        <!-- =========================
            Button 
        ============================== -->
        <div class="create_new">
            <button type="submit" name="save" id="save" class="<?= $row['user_id'] !== $_SESSION['userid'] ? 'hidden' : ""; ?>">save</button>
            <button type="submit" name="copy_create" id="copy_create">create new</button>
        </div>
    </form>
    <!-- =========================
        Footer 
    ============================== -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>