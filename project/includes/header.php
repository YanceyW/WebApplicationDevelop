
<?php
// Description: nav bar on account page


//log out 
if (isset($_POST['out'])) {

    session_destroy();
    header('location:login.php');
    exit();
}

?>

<section id="nav">
    <nav>
        <ul>
            <li class="<?= !$_SESSION['loginStatus'] ? 'hidden' : ""; ?>"><a href="user.php">Personal info</a></li>
            <li><a href="MainPage.php">Menus</a></li>
            <li class="<?= !$_SESSION['loginStatus'] ? '' : "hidden"; ?>"><a href="login.php">Login</a></li>
            <li class="<?= !$_SESSION['loginStatus'] ? '' : "hidden"; ?>"><a href="register">Register</a></li>
        </ul>
        <form class="header_form <?= !$_SESSION['loginStatus'] ? 'hidden' : ""; ?>" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="off">
            <div>
                <button id="out" name="out">Log out</button>
            </div>
        </form>

    </nav>
</section>