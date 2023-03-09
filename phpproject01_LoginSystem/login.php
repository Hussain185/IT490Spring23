<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h2>Log In</h2>
  <div class="signup-form-form">
      <form action="includes/login.inc.php" method="post" id="loginForm">
      <input type="text" name="uid" placeholder="Username/Email...">
      <input type="password" name="pwd" placeholder="Password...">
      <button type="submit" name="submit">Sign up</button>
    </form>
  </div>
  <?php
  /*
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
      else if ($_GET["error"] == "wronglogin") {
        echo "<p>Wrong login!</p>";
      }
    }
    */
  ?>
</section>

<?php
  include_once 'footer.php';
?>
<script>
  const formElement = document.querySelector("form");
  const request = new XMLHttpRequest();
  request.open("POST", "includes/login.inc.php", true);
  request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  request.send(new FormData(formElement));
</script>
</html>

