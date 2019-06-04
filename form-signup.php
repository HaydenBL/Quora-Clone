<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" type="text/css" href="custom.css"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<?php  require_once("header.php"); ?>

  	<h1 id="form-title" class="center">Sign up</h1>
<?php
  // session_start();
  if(isset($_SESSION["loggedin"])) {
  ?>
      <div class="center post-display">You're already logged in!</div>


<?php } //end if
  else {
    ?>

      <div class="center" id="signup-section">
      <form class="center" id="signup-form" name="signupForm" onsubmit="return validateSignup()" action="signup.php" method="post" enctype="multipart/form-data">

        <label id="error_msg" class="err_msg"></label>

        <label class="small_err" id="username_err"></label>
        <input type="text" id="username" name="username" placeholder="Username">

        <label class="small_err" id="pass_err"></label>
        <input type="password" id="password" name="password" placeholder="Password">

        <label class="small_err" id="pswdconfirm_err"></label>
        <input type="password" id="pswdconfirm" name="pswdconfirm" placeholder="Confirm password">

        <label class="small_err" id="email_err"></label>
        <input type="email" id="email" name="email" placeholder="Email">

        <label class="small_err" id="bday_err"></label>
        <input type="text" id="birthday" name="bday" placeholder="Date of birth - yyyy-mm-dd" onfocus="(this.type='date')" onblur="(this.type='text')" />


        Profile image:
        <input type="file" name="upload" id ="upload" />


        <input type="submit" name="signup" id="signup-button" value="Sign up!" class="center" />

        <p id="signup-prompt"> Already have an account? <a href="./form-login.php">Login!</a></p>
      </form>
      


    </div>

<?php } ?>

    <script type="text/javascript" src="script.js"> </script>
    <script type="text/javascript" src="script-signup.js"> </script>

  </body>
</html>
