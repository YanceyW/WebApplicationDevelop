<?php
session_start();
//include the library file
require 'includes/library.php';
// create the database connection
$pdo = connectDB();


$errors = array(); //declare empty array to add errors
//collect data from user
// $user_id = 12345;
$title = $_POST['title'] ?? null;
// $username = $_POST['username'] ?? null;
$private = $_POST['private'] ?? null;
$tags = $_POST['tags'] ?? null;
$serving = $_POST['serving'] ?? null;
$difficulty = $_POST['difficulty'] ?? null;
$prep_hour = $_POST['prep_hour'] ?? null;
$cook_hour = $_POST['cook_hour'] ?? null;
$prep_min = $_POST['prep_min'] ?? null;
$cook_min = $_POST['cook_min'] ?? null;
$recipe_ingredients = $_POST['recipe_ingredients'] ?? null;
$recipe_directions = $_POST['recipe_directions'] ?? null;



if (isset($_POST['submit'])) {

    $image_filename = $_FILES['image']['name'] ?? null;
    $target_dir = "/home/claireli/public_html/www_data/recipe_images/";
    $target_file = $target_dir . basename($image_filename);
    $tmp_name = $_FILES['image']['tmp_name'] ?? null;
    $file_error = $_FILES['image']['error'];
    if ($file_error == UPLOAD_ERR_OK && is_uploaded_file($tmp_name)){
        move_uploaded_file($tmp_name, $target_file);
    }else {
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

    if (count($errors) === 0) {
        $recipe_data = "INSERT INTO `cois3420_project_recipe` 
                    (user_id, title, username, private, tags, image, serving, difficulty, 
                    prep_hour, prep_min, cook_hour, cook_min, recipe_ingredients, recipe_directions, create_date) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($recipe_data);
        $stmt->execute([$_SESSION['userid'], $title, $_SESSION['user'], $private, $tags, $image_filename, $serving,
                        $difficulty, $prep_hour, $prep_min, $cook_hour, $cook_min,
                        $recipe_ingredients, $recipe_directions]);
        header("Location:MainPage.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $PAGE_TITLE = "Create Recipe";
    include 'includes/metadata.php';
    ?>
</head>

<body>
    <!-- ========================================================================= -->
    <!-- file name: create_recipe.php                                              -->
    <!-- page for create a new recipe                                              -->
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
            <h1>Create your recipe!</h1>
            <div>
                <label for="title">Recipe Title: </label>
                <input type="text" name="title" id="title">
                <span id = "titleError" class="error <?= !isset($errors['title']) ? 'hidden' : ""; ?>">*Please enter a title</span>
            </div>
            <div>
                <label>Your name: </label>
                <?php echo '<br>' . $_SESSION['user']; ?>
            </div>

            <div class="recipe_info">
                <div class="private_check">
                    <input type="checkbox" name="private" id="public" value="Y">
                    <label for="public">private</label>
                </div>
                <div class="recipe_tags">
                    <label for="tags">tags: </label>
                    <input type="text" name="tags" id="tags">
                </div>
                <p>rating: --</p>
            </div>
            <div>
                <label for="image">You can pace an image of your dish here. It's optional.</label>
                <input type="file" name="image" id="image">
            </div>
        </div>
        <!-- =========================
            Recipe introduction 
        ============================== -->
        <div class="intro">
            <div>
                <span>Servings</span>
                <input type="number" name="serving" id="serving">
            </div>
            <div>
                <span>Difficulty</span>
                <input type="text" name="difficulty" list="difficulty" />
                <datalist id="difficulty">
                    <option>easy</option>
                    <option>medium</option>
                    <option>hard</option>
                </datalist>
            </div>
            <div class="time">
                <span>Prep time</span>
                <div class="prep_time">
                    <input type="number" name="prep_hour" id="prep_hour">
                    <label for="prep_hour">h</label>
                </div>
                <div class="prep_time">
                    <input type="number" name="prep_min" id="prep_min">
                    <label for="prep_min">min</label>
                </div>
            </div>
            <div class="time">
                <span>Cook time</span>
                <div class="cook_time">
                    <input type="number" name="cook_hour" id="cook_hour">
                    <label for="cook_hour">h</label>
                </div>
                <div class="cook_time">
                    <input type="number" name="cook_min" id="cook_min">
                    <label for="cook_min">min</label>
                </div>
            </div>
        </div>

        <div class="intro_error">
            <span id="servingError" class="error <?= !isset($errors['serving']) ? 'hidden' : ""; ?>">*Please give a serving number</span>
            <span id="difficultyError" class="error <?= !isset($errors['difficulty']) ? 'hidden' : ""; ?>">*Please select a difficulity level</span>
            <span id="prep_timeError" class="error <?= !isset($errors['prep_time']) ? 'hidden' : ""; ?>">*Please ennter prepare time</span>
            <span id="cook_timeError" class="error <?= !isset($errors['cook_time']) ? 'hidden' : ""; ?>">*Please enter cook time</span>
        </div>

         <!-- =========================
            Recipe ingredients
        ============================== -->
        <div class="ingredient">
            <h2>Ingredients</h2>
            <textarea name="recipe_ingredients" id="recipe_ingredients" cols="30" rows="10" placeholder="enter ingredients here"></textarea>
            <span id="ingredientError" class="error <?= !isset($errors['ingredients']) ? 'hidden' : ""; ?>">*Please enter ingredients</span>
        </div>

        <!-- =========================
            Recipe directions 
        ============================== -->
        <div class="directions">
            <h2>Directions</h2>
            <textarea name="recipe_directions" id="recipe_directions" cols="30" rows="10" placeholder="enter directions here"></textarea>
            <span id="directionsError" class="error <?= !isset($errors['directions']) ? 'hidden' : ""; ?>">*Please enter directions</span>
        </div>

        <!-- =========================
            Button 
        ============================== -->
        <div class="create_new">
            <button type="submit" name="submit" id="submit">create new</button>
        </div>
    </form>
    <!-- =========================
        Footer 
    ============================== -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>