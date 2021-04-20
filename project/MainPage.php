<!-- file name: MainPage.php
    purpose: the main page for final project connect to 
    signup/login page display recipe from database    
-->

<?php session_start();   //start session 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $PAGE_TITLE = "Final Project";
    include 'includes/metadata.php';
    ?>
</head>

<body>
    <!-- nav bar -->
    <section id="nav">
        <?php include 'includes/nav.php'; ?>
    </section>

    <!-- viewing a specific recipe on modal window -->
    <section id="recipe_modal">
        <div class="modal-header">
            <span class="close-button">&times;</span>
        </div>

        <div class="modal-content"></div>
        
        <div class="recipe-button">
                <button type="submit" name="edit" id="edit">Edit</button>
                <button type="submit" name="delete" id="delete">Delete</button>
                <button type="submit" name="copy" id="copy">Copy</button>

        </div>
    </section>

    <!-- footer -->
    <section id="footer">
        <?php include 'includes/footer.php'; ?>
    </section>
</body>

</html>