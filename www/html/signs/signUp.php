<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/signs.css">
  <link rel="shortcut icon" href="../img/beers.png"　type="image/png">
  <title>SignUp</title>
  <style>
    .red {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  
  <?php
  require_once "../load-header-template.php";
  load_header_template("../template/header-template.php");
  ?>

  <div class="form-wrapper">
    <h1>サインアップ画面</h1>
    <?php
      if($_SESSION["ERROR"]){
        echo "<p class='red'>".$_SESSION["ERROR"]."</p>";
      }
    ?>
    <form action="./signUpProcess.php" method="POST">
      <div class="form-item">
        <label for="email"></label>
        <input type="email" name="email" required="required" placeholder="Email Address"></input>
      </div>
      <div class="form-item">
        <label for="username"></label>
        <input type="text" name="username" required="required" placeholder="User Name"></input>
      </div>
      <div class="form-item">
        <label for="password"></label>
        <input type="password" name="password" required="required" placeholder="Password"></input>
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="Sign In" value="サインアップ"></input>
      </div>
    </form>
    <div class="form-footer">
      <p><a href="./signIn.php">サインインへ</a></p>
      <p><a href="../components/main.php">メインへ戻る</a></p>
      <!-- <p><a href="#">Forgot password?</a></p> -->
    </div>
  </div>

  <?php if($_SESSION["ERROR"]): ?>
  <script>
    $(".red").hide(3000);
  </script>
  <?php endif ?>

  <script src="../js/toggle.js" async defer></script>

</body>
</html>