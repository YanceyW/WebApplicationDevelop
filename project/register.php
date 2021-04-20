<?php
// Usage: let user register the account for the restaurant   

session_start();
require "includes/library.php";

$errors = array();
$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$email = $_POST['email'] ?? null;
// hash the password 
$hash_password = password_hash($password, PASSWORD_DEFAULT);

//session login status
if (!isset($_SESSION['loginStatus'])) {
    $_SESSION['loginStatus'] = false;
}

// ENSURE THAT THERE IS INFORMATION IN $_POST
if (isset($_POST['submit'])) {
    // GET LOGIN INFORMATION FROM $_POST

    if (!isset($username) || strlen($username) === 0) {
        $errors['no_name'] = true;
    }
    if (!isset($password) || strlen($password) === 0) {
        $errors['pass_error'] = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = true;
    }
    // CONNECT TO THE DATABASE
    $pdo = connectDB();

    //get unique username(test username if it exists in database)
    $query = "SELECT * FROM `finalProjectUser` WHERE username = ?";
    $stmt2 = $pdo->prepare($query);
    $stmt2->execute([$username]);

    if ($stmt2->fetch()) {
        $errors['exit_name'] = true;
    } else {

        if (count($errors) === 0) {

            $query = "INSERT INTO `finalProjectUser` (username, password ,email) VALUES (?,?,?)";
            $stmt = $pdo->prepare($query); //
            $stmt->execute([$username, $hash_password, $email]);
            $_SESSION['user'] = $username;
            $_SESSION['pass'] = $hash_password;
            $_SESSION['email'] = $email;

            //this is where go to the main page 
            header("Location: login.php");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $PAGE_TITLE = "register";
    include "includes/metadata.php";
    ?>
    <script defer src="script/register.js"></script>
</head>



<body>
    <!-- HEADER -->
    <?php
    include "includes/header.php";
    ?>
    <section id="partD">
        <!-- MAIN -->
        <main>
            <h1>Register</h1>

            <!-- LOGIN FORM -->
            <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="off">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="Username.." value="<?= $username; ?>">
                </div>
                <div>
                    <span id="userError2" class="error <?= !isset($errors['exit_name']) ? 'hidden' : ""; ?>">*name already exists.</span>
                </div>
                <div>
                    <span id="userError3" class="error <?= !isset($errors['no_name']) ? 'hidden' : ""; ?>">*please enter a name.</span>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password..">
                </div>
                <div>
                    <span id="passError" class="error <?=!isset($errors['pass_error']) ? 'hidden' : "";?>">*Enter a password.</span>
                </div>

                <div class="rating"></div>


                <div>
                    <label for="email">Email:</label>
                    <input id="email" name="email" type="email" placeholder="xxx@xxxx.com" value="<?php echo $email ?>" required />

                </div>
                <div>
                    <span id="emailError" class="error <?=!isset($errors['email']) ? 'hidden' : "";?>">*Enter a valid email address.</span>
                </div>

                <button id="submit" name="submit">Confirm</button>
            </form>

        </main>

    </section>

    <section id="footer">
        <?php include 'includes/footer.php'; ?>
    </section>

</body>

</html>