<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="shortcut icon" href="../img/beers.png"　type="image/png">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>居酒屋検索ガチャ</title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDXEqS90EJEkG0qexfsQ2BD2BLYDuUNNe0"></script>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <?php
  require_once "../load-header-template.php";

  load_header_template("../template/header-template.php");
  ?>

  <div class="main">
    
    <form name="selected" onsubmit="return false">
      <p>現在地: <span id="address" class="border1"></span></p>

      <div class="module-spacer--extra-extra-small"></div>
      <div id="tooltip">
        <span class="material-icons">
          info
          <div class="sample1-tooltips">
            現在地を基に居酒屋を検索します。<br><br>
            初期状態からでも「検索」できます。
          </div>
        </span>

      </div>

      <div class="card">
        <p>
          半 径　 :
          <select name="range" class="same-width-list">
            <?php
              $range = [
                "1" => "300m",
                "2" => "500m",
                "3" => "1km",
                "4" => "2km",
                "5" => "3km",
              ];

              foreach($range as $key => $value){
                echo "<option value=".$key.">".$value."</option>";
              }
            ?>
          </select>
        </p>

        <p>
          ジャンル:
          <select name="genre" class="same-width-list">
            <?php
              $genre = [
                "" => "特になし",
                "G001" => "居酒屋",
                "G002" => "ダイニングバー・バル",
                "G003" => "創作料理",
                "G004" => "和風",
                "G005" => "洋食",
                "G006" => "イタリアン・フレンチ",
                "G007" => "中華",
                "G008" => "焼肉・ホルモン",
                "G012" => "韓国料理",
                "G016" => "お好み焼き・もんじゃ",
              ];

              foreach($genre as $key => $value){
                echo "<option value=".$key.">".$value."</option>";
              }
            ?>
          </select>
        </p>

        <p>
          <!-- Budget -->
          相 場　 :
          <select name="marketPrice" class="same-width-list">
            <?php
              $marketPrice = [
                "" => "特になし",
                "B002" => "~3000円",
                "B008" => "~5000円",
                "B004" => "~7000円",
                "B005" => "~10000円"
              ];

              foreach($marketPrice as $key => $value){
                echo "<option value=".$key.">".$value."</option>";
              }
            ?>
          </select>
        </p>

        <p>
          <!-- Coupon -->
          クーポン:
          <select name="coupon" class="same-width-list">
            <?php
              $coupon = [
                "" => "どちらでも良い",
                1 => "クーポンを使用する",
                0 => "クーポンは使用しない",
              ];

              foreach($coupon as $key => $value){
                echo "<option value=".$key.">".$value."</option>";
              }
            ?>
          </select>
        </p>

        <div class="module-spacer--small"></div>

        <?php
          if( !isset($_SESSION['EMAIL']) ){
            echo "<a href='../signs/signUp.php'>新規会員登録をする</a>";
          }
        ?>
        
        <div class="module-spacer--medium"></div>
        <input class="btn2" type="submit" value="検索する" onclick="hotpapperAPI()">
      </div>
    </form>
  </div>

  <?php if($_SESSION['MESSAGE']) : ?>
    <!-- レイヤー -->
    <div id="layer"></div>
    <!-- ポップアップ -->
    <div id="popup">
      <div><?php echo $_SESSION['MESSAGE'] ?></div>
    </div>
  <?php endif ?>

  <div class="popup" id="js-popup">
    <div class="popup-inner">
      <div class="close-btn" id="js-close-btn"><i class="fas fa-times"></i></div>
      <a href="#"><img src="../img/corona.jpeg" alt="ポップアップ画像"></a>
      <p>※検温等のご協力もお願いします。</p>
    </div>
    <div class="black-background" id="js-black-bg"></div>
  </div>

  <?php
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
  $_SESSION['MESSAGE'] = null;
  ?>
  <!-- 位置情報取得 -->
  <script async defer src="../js/geolocation.js" async defer></script>
  <script src="../js/toggle.js" async defer></script>
  <script src="../js/hotpapper.js" async defer></script>
  <script>
    window.onload = function() {
      var popup = document.getElementById('js-popup');
      if(!popup) return;
      popup.classList.add('is-show');

      var blackBg = document.getElementById('js-black-bg');
      var closeBtn = document.getElementById('js-close-btn');

      closePopUp(blackBg);
      closePopUp(closeBtn);

      function closePopUp(elem) {
        if(!elem) return;
        elem.addEventListener('click', function() {
          popup.classList.remove('is-show');
        })
      }
    }
  </script>
</body>
</html>