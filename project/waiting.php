<?php
// A waiting page, for email to be sent 

session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
$PAGE_TITLE = "Waiting for validation";

include "includes/metadata.php";
?>


</head>
<body>


<section id="partD">
  <main>
    <h1>We have sent you the validation email for changing your password</h1> 
                         <p> Please wait the email .. ...</p>
                         <div class="loader"></div>
  </main>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>