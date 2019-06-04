
<!-- red header of the page -->
<header id="fixed-header">
  <!-- header image QUORA -->
  <div class="column-2">
      <a href="./index.php"> <img id="logo" src="logo.png" alt="Quora"/> </a>
  </div>
  <!-- <a href="./index.php"> fsfgsf</a>
  <p>sfosijfsjf</p> -->
  <div class="column-8">
    <?php require_once('category-div.php'); ?>
  </div>

  <div class="column-2 login-out">
    <!-- logout/ login toggle: session check -->
    <?php
         session_start();
         $loggedin = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
         if($loggedin) :
    ?>

         <a href="./logout.php" id="header-login">Logout<?php //echo $_SESSION['user']; ?></a>

    <?php else : ?>
         <a href="./form-login.php" id="header-login">Login</a>
    <?php endif; ?>
  </div>
</header>

<link rel="stylesheet" type="text/css" href="headerfile.css"/>
<div style="height: 90px;"></div>
