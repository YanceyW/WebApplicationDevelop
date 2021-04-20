<?php
// Show the page of user's account information includes: change password, change email 



/****************************************
show the page of user info
 ******************************************/



require "includes/library.php";
$pdo = connectDB();
// CONNECT TO DATABASE
session_start();



$errors = array();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = '';
}
if (!isset($_SESSION['pass'])) {
    $_SESSION['pass'] = '';
}
if (!isset($_SESSION['email'])) {
    $_SESSION['email'] = '';
}


if ($_SESSION['loginStatus'] = true) {
    // check the database
    $query = "SELECT username, password, email FROM `finalProjectUser` WHERE username = '?'";
    $stmt = $pdo->query($query);
    $results = $stmt->fetch();

    $username = $_SESSION['user'];
    $password = $_SESSION['pass'];
    $email = $_SESSION['email'];

    $newPass = $_POST['password'] ?? null;
    $hash_password = password_hash($newPass, PASSWORD_DEFAULT);
    $newEmail = $_POST['email'] ?? null;

    
    if (isset($_POST['submit'])) {



        if ((isset($newEmail) && $newEmail != '') && (isset($newPass) && $newPass != '')) {

            if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = true;
            }
            if (count($errors) === 0) {
                // $errors['email_pass'] = null;
                $query = "UPDATE `finalProjectUser` SET password='$hash_password', email='$newEmail'  WHERE ID = ?";
                $stmt2 = $pdo->prepare($query);
                $stmt2->execute([$_SESSION['userid']]);
                $_SESSION['pass'] = $newPass;
                $_SESSION['email'] = $newEmail;
            }
        } elseif ((isset($newEmail) && $newEmail != '') && (!isset($newPass) || $newPass == '')) {

            if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = true;
            }
            if (count($errors) === 0) {
                // $errors['email_pass'] = true;
                $query = "UPDATE `finalProjectUser` SET email='$newEmail' WHERE ID = ?";
                $stmt2 = $pdo->prepare($query);
                $stmt2->execute([$_SESSION['userid']]);
                $_SESSION['email'] = $newEmail;
            }
        } elseif ((!isset($newEmail) || $newEmail == '') && (isset($newPass) && $newPass != '')) {
            // $errors['email_pass'] = true;
            $query = "UPDATE `finalProjectUser` SET password='$hash_password' WHERE ID = ?";
            $stmt2 = $pdo->prepare($query);
            $stmt2->execute([$_SESSION['userid']]);
            $_SESSION['pass'] = $newPass;
        }
            
    } 
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $PAGE_TITLE = "Personal information";
    include "includes/metadata.php";
    ?>
    <script src="script/delete_user.js"></script>
    <script src="script/personal_info_form_validation.js"></script>
</head>

<body>
    <?php include "includes/header.php" ?>
    <section id="partD">
        <main>
            <h1>Personal info</h1>
            <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="off">

                <?php echo "Hello, ".$_SESSION['user']; ?>

                <?php echo $_SESSION['pass'] . "<br>"; ?>

                <div>
                    <label for="password"> New password: </label>
                    <input type="password" name="password" id="password" placeholder="Password.." value="<?= $_SESSION['pass']; ?>">
                </div>

                <?php echo "$email " . "<br>"; ?>

                <div>
                    <label for="email">New email: </label>
                    <input type="email" name="email" id="email" placeholder="Email.." value="<?= $_SESSION['email']; ?>">
                </div>

                <div>
                    <span id="emailError" class="error <?= !isset($errors['email']) ? 'hidden' : ""; ?>">*Enter a valid email address.</span>
                </div>


                <button id="submit" name="submit">Submit</button>

                <button id="delete" name="delete">Delete</button>

    
            </form>
        </main>
    </section>

    <section id="footer">
        <?php include 'includes/footer.php'; ?>
    </section>
</body>

</html>