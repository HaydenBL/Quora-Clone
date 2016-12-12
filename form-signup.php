<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<header>
  	<a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
  	</header>

  	<h1 id="form-title" class="center">Sign up</h1>
<?php 
  session_start();
  if(isset($_SESSION["loggedin"])) {
  ?>
      <div class="center post-display">You're already logged in!</div>
  	

<?php } //end if 
  else { 
    ?>
      
      <div class="center" id="signup-section">
      <form class="center" id="signup-form" name="signupForm" onsubmit="return validateSignup()" action="signup.php" method="post" enctype="multipart/form-data">

        <label id="error_msg" class="err_msg"><br /></label>

        <label class="small_err" id="username_err"></label>
        <input type="text" id="username" name="username" placeholder="Username"><br />

        <label class="small_err" id="pass_err"></label>
        <input type="password" id="password" name="password" placeholder="Password"><br />

        <label class="small_err" id="pswdconfirm_err"></label>
        <input type="password" id="pswdconfirm" name="pswdconfirm" placeholder="Confirm password"><br />

        <label class="small_err" id="email_err"></label>
        <input type="email" id="email" name="email" placeholder="Email"><br />

        <label class="small_err" id="bday_err"></label>
        <input type="text" id="birthday" name="bday" placeholder="Date of birth - yyyy-mm-dd" onfocus="(this.type='date')" onblur="(this.type='text')" />
        <br />

        Profile image:
        <input type="file" name="upload" id ="upload" />
        <br />

        <input type="submit" name="signup" id="signup-button" value="Sign up!" class="center" />
        <br />
      </form>
      <hr>
      <p id="signup-prompt"> Already have an account? <a href="./form-login.php">Login!</a></p>
      
    </div>  

<?php } ?>

    <script type="text/javascript" src="script.js"> </script>
    <script type="text/javascript" src="script-signup.js"> </script>

  </body>
</html>