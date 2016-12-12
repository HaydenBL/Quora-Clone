<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic' rel='stylesheet' type='text/css'>
  </head>
  <body>
  	<header>
  	<a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
  	</header>

  	<h1 id="form-title" class="center">Login</h1>
      <?php 
      session_start();
      if(isset($_SESSION["loggedin"])) {
      ?>
      <div class="center post-display">You're already logged in!</div>

      <?php } //end if 
      else { 
        ?>
        
      <div class="center" id="login-section">
      <form class="center" name="loginForm" id="login-form" onsubmit="return validateLogin()" action="login.php" method="post" enctype="multipart/form-data">
        <label id="error_msg" class="err_msg"></label>

        <label class="small_err" id="email_err"></label>
        <input type="text" id="email" name="email" placeholder="Email"> <br />

        <label class="small_err" id="pass_err"></label>
        <input type="password" id="password" name="password" placeholder="Password"><br />

        <input type="submit" name="loginbutton" id="login-button" value="Login" /><br />
        <label id="login-signup-link">Don't have an account?
        <a href="./form-signup.php">Sign up!</a> </label>
      </form>
      </div>

        <?php } ?>
  	
  <script type="text/javascript" src="script.js"> </script>
  <script type="text/javascript" src="script-login.js"> </script>

  </body>
</html>