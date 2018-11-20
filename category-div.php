
  <div id="category-div">
    <!-- category tab -->
    <ul class="category_style">
      <?php
        require_once("mysqli-connect.php");
        $sql = "Select name from Categories;";
        $reply = $conn->query($sql);

        if($reply)
        {
          $temp = mysqli_num_rows($reply);
          while($temp--)
          {
              $row = mysqli_fetch_assoc($reply);
      ?>

        <li><a href="<?php echo './index.php?cat=' . $row['name'] ?>"><?php echo $row['name']; ?></a></li>
      <?php

          }
        }
       ?>
    </ul>
  </div>

  <link rel="stylesheet" type="text/css" href="category-div.css"/>
