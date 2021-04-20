<?php
// Usage: login to the page 

session_start();
require "includes/library.php";

$errors = array();
// GET LOGIN INFORMATION FROM $_POST
$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$_SESSION['loginStatus'] = false;



// ENSURE THAT THERE IS INFORMATION IN $_POST
if (isset($_POST['submit'])) {


    if (!isset($username) || strlen($username) === 0) {
        $errors['no_name'] = true;
    }
    if (!isset($password) || strlen($password) === 0) {
        $errors['pass_error'] = true;
    }

    // CONNECT TO THE DATABASE
    $pdo = connectDB();

    // CHECK THE DATABASE FOR THE USER
    $query = "SELECT *  FROM `finalProjectUser` WHERE username = ?";
    //$statement = $pdo->query($query);
    $statement = $pdo->prepare($query);
    $statement->execute([$username]);
    $results = $statement->fetch();

    // IF USER DOES NOT EXIST
    if ($results === false) {
        $errors['user'] = true;
    }


    //check the if password is correct of not
    else if (password_verify($password, $results['password'])) {

        $_SESSION['user'] = $username;
        $_SESSION['pass'] = $password;
        $_SESSION['email'] = $results['email'];
        //$_SESSION['username'] = $username;
        $_SESSION['userid'] = $results['id'];
        $_SESSION['loginStatus'] = true;
 

        //if the remmber me checkbox is clicke, then store the username and password 
        if (!empty($_POST["agree"]) && isset($_POST["agree"])) {
            setcookie("username", $username, time() + 60 * 60 * 24 * 30 * 12);
            setcookie("password", $password, time() + 60 * 60 * 24 * 30 * 12);
        }

        header("Location: MainPage.php");
        exit(); //}   

    }

    // IF PASSWORD IS INCORRECT
    else {
        $errors['password'] = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $PAGE_TITLE = "Login";
    include "includes/metadata.php";
    ?>
    <script src="script/check_login_form.js"></script>
</head>



<body>
    <!-- HEADER -->
    <?php
    include "includes/header.php";
    ?>

    <section id="partD">
        <!-- MAIN -->
        <main>
            <h1>Login</h1>

            <!-- LOGIN FORM -->
            <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="off">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="Username.." value="<?= $username; ?>">
                </div>
                <div>
                    <span id="userError" class="<?= !isset($errors['user']) ? 'hidden' : ""; ?>">*Please check your account name</span>
                </div>
                <div>
                    <span id="userError3" class="error <?= !isset($errors['no_name']) ? 'hidden' : ""; ?>">*please enter a name.</span>
                </div>

                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password.." value="<?= $password; ?>">
                </div>
                <div>
                    <span class="<?= !isset($errors['password']) ? 'hidden' : ""; ?>">*invalid password</span>
                </div>
                <div>
                    <span id="passError" class="error <?=!isset($errors['pass_error']) ? 'hidden' : "";?>">*Enter a password.</span>
                </div>

                <div class="input-check">
                    <div class="checkbox">
                        <input type="checkbox" name="agree" id="check" />
                        <label for="check">Remember Me</label>
                    </div>

                    <div class="forgot"> <a href="forgot.php">Forgot Password?</a></div>
                </div>

                <button id="submit" name="submit">Log In</button>
            </form>

        </main>

    </section>

    <section id="footer">
        <?php include 'includes/footer.php'; ?>
    </section>

</body>

</html>