<?php

// This is the page where user write their email in the box    
// And people get back their password by sending this email 



session_start();
require "includes/library.php";

$errors =array();


require_once "Mail.php";  //this includes the pear SMTP mail library
$from = "Password System Reset <noreply@loki.trentu.ca>";
$to = $_POST['email'] ?? null;;  //put user's email here
$subject = "Change Password";
// the message user will get in there email 
$body = "Hello user, welcome back to use our restaruant systme. 
    Please complete your personal information by click the following link 
    https://loki.trentu.ca/~claireli/3420/project/reset.php";





// ENSURE THAT THERE IS INFORMATION IN $_POST
if (isset($_POST['submit'])) {
    
   
    
    
    
    // CONNECT TO THE DATABASE
    $pdo = connectDB();
   
    // CHECK THE DATABASE FOR THE USER
    $query = "SELECT *  FROM `finalProjectUser` WHERE email = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$to]);
    $results = $statement->fetch();
   
    // IF USER DOES NOT EXIST
    if ($results === false) {
        
        $errors['email'] = true;
        
    }  
    
        
        //sent message to the user email 
       else {
        $_SESSION['email'] = $results['email'];
       
        $_SESSION['changeStatus']= true;


        // sent email for validation
        $host = "smtp.trentu.ca";
        $headers = array ('From' => $from,
          'To' => $to,
          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
          array ('host' => $host));
          
        $mail = $smtp->send($to, $headers, $body);
        if (PEAR::isError($mail)) {
          echo("<p>" . $mail->getMessage() . "</p>");
         } else {
         
          header("Location:waiting.php"); // if message successfully send, the page will go to waiting page
        exit();
         }
       
      

  }

    
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
$PAGE_TITLE = "Change Passwor";
include "includes/metadata.php";
?>
</head>



<body>
    <!-- HEADER -->
    <?php
include "includes/header.php";
?>
<section id="partD">
    <!-- MAIN -->
    <main>
        <h1>Change Password</h1>

        <!-- LOGIN FORM -->
        <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="POST" autocomplete="off">
        
            <div>
          <label for="email">Email:</label>
          <input
            id="email"
            name="email"
            type="email"
            placeholder="xxx@xxxx.com"
            value="<?=$to;?>"
            required
          />

        </div>
        <div>
           <span id = "emailError" class="error <?=!isset($errors['email']) ? 'hidden' : "";?>">*Enter a valid email address.</span>
        </div>
            

        <button id="submit" name="submit">Confirm</button>
        </form>

   
        
    </main>

    <section id="partD">
    <?php include 'includes/footer.php'; ?>
</body>

</html>