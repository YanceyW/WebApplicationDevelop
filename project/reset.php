<?php
// Usage: reset the password, based on their emails      


session_start();

//use of connect to the database
require "includes/library.php";
// CONNECT TO THE DATABASE

$pdo = connectDB();
$errors = array();

$password = $_POST['password'] ?? null;
$Npassword = $_POST['Npassword'] ?? null;
// hash the password 
$hash_password = password_hash($password, PASSWORD_DEFAULT);



if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = '';
}


if ($_SESSION['changeStatus'] = true) {

    $email = $_SESSION['email'];

    //get unique email(test email if it exists in database)
    $query = "SELECT *  FROM `finalProjectUser` WHERE email = ?";
    //$statement = $pdo->query($query);
    $statement = $pdo->prepare($query);
    $statement->execute([$email]);
    $results = $statement->fetch();


    // ENSURE THAT THERE IS INFORMATION IN $_POST
    if (isset($_POST['submit'])) {


        // IF email  EXIST and connected 
        //  if ($results === true) {

        //check the input the empty or not 
        if (!empty($password) && !empty($Npassword)) {
            //check if the two password are same or not 
            if ($Npassword === $password) {
                $query = "UPDATE `finalProjectUser` SET password='$hash_password' WHERE email = ?";
                $stmt2 = $pdo->prepare($query);
                $stmt2->execute([$_SESSION['email']]);
                header("Location: login.php");


                session_destroy();
                $_SESSION['changeStatus'] = false;
                exit();
            } else {

                $errors['Npassword'] = true;
            }
        } else {
            $errors['password'] = true;
        }

        //  }
    }
} else {

    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $PAGE_TITLE = "Reset";
    include "includes/metadata.php";
    ?>
</head>



<body>
    <section id="partD">
        <!-- MAIN -->
        <main>
            <h1>Reset</h1>

            <!-- LOGIN FORM -->
            <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="off">

                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password..">
                </div>
                <div>
                    <label for="Npassword">Please enter again:</label>
                    <input type="password" name="Npassword" id="Npassword" placeholder="Password..">
                </div>
                <div>
                    <span class="<?= !empty($errors['password']) ? 'hidden' : ""; ?>">*Must enter words</span>
                </div>
                <div>
                    <span class="<?= !isset($errors['Npassword']) ? 'hidden' : ""; ?>">*password must be same with each times</span>
                </div>

                <button id="submit" name="submit">Submit</button>
            </form>

        </main>

    </section>
    <?php include 'includes/footer.php'; ?>
</body>

</html>