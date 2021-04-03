<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/signs.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../img/beers.png"　type="image/png">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <title>SignIn</title>
  <style>
  #red {
    color: red;
    margin-top: 10px;
  }
  #layer {
    display: none;  /* 初期表示は非表示 */
    position: absolute; 
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: 0.20;
  }
  #popup {
    display: none;  /* 初期表示は非表示 */
    position: absolute; 
    left: 50%;
    top: 50%;
    width: 300px;
    height: 50px;
    margin-left: -150px;
    margin-top: -100px;
    border-radius: 5px;
    text-align: center;
    background-color: white;
    color: black;
  }
  </style>
</head>
<body>
  
  <?php
  require_once "../load-header-template.php";
  load_header_template("../template/header-template.php");
  ?>

  <div class="form-wrapper">
    <h1>サインイン画面</h1>
    <?php
      if($_SESSION['MESSAGE']){
        echo "<p id='red'>".$_SESSION['MESSAGE']."</p>";
      }
    ?>
    <form action="./signInProcess.php" method="POST">
      <div class="form-item">
        <label for="email"></label>
        <input type="email" name="email" required="required" placeholder="Email Address"></input>
      </div>
      <div class="form-item">
        <label for="password"></label>
        <input type="password" name="password" required="required" placeholder="Password"></input>
      </div>
      <div class="button-panel">
        <button class="button">サインイン</button>
      </div>
    </form>
    <div class="form-footer">
      <p><a href="./signUp.php">新規会員登録をする</a></p>
      <!-- <p><a href="#">Forgot password?</a></p> -->
    </div>
  </div>

  <?php if($_SESSION['OK']) : ?>
  <!-- レイヤー -->
  <div id="layer"></div>
  <!-- ポップアップ -->
  <div id="popup">
    <div><?php echo $_SESSION['OK'] ?></div>
  </div>
  <?php endif; ?>
  
  <?php if($_SESSION['MESSAGE']){
  echo <<<EOM
  <script type="text/javascript">
    setTimeout(function(){
      const red = document.getElementById('red');
      red.style.display = 'none';
    }, 3*1000);
  </script>
  EOM;
  }
  ?>

<?php if($_SESSION['OK']){
  echo <<<EOM
  <script type="text/javascript">
  $(function() {
    $('#popup, #layer').show();
    setTimeout(function(){
      $('#popup, #layer').hide();
    }, 3*1000);
  });
  </script>
  EOM;
  $_SESSION['OK'] = null;
  }
  ?>

  <script src="../js/toggle.js" async defer></script>
</body>
</html>