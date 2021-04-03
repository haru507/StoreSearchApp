<?php
  session_start();
  require_once('../signs/config.php');
  
  // DB接続をして値を持ってくる
  try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $user_id = $_SESSION["ID"];
    $sql = "select * from histories where user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo $e->getMessage();
    die();
  }

  //接続を閉じる
  $pdo = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/history.css">
  <link rel="shortcut icon" href="../img/beers.png"　type="image/png">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <style>
    .btn-square-slant {
      display: inline-block;
      position: relative;
      padding: 0.5em 1.4em;
      text-decoration: none;
      background: #668ad8;/*ボタン色*/
      color: #FFF;
      border-bottom: solid 5px #36528c;/*ボタン色より暗めに*/
      border-right: solid 5px #5375bd;/*ボタン色より暗めに*/
    }

    .btn-square-slant:before {  
      content: " ";
      position: absolute;
      bottom: -5px;
      left: -1px;
      width: 0;
      height: 0;
      border-width: 0 6px 6px 0px;
      border-style: solid;
      border-color: transparent;
      border-bottom-color: #FFF;
    }

    .btn-square-slant:after {  
      content: " ";
      position: absolute;
      top: -1px;
      right: -5px;
      width: 0;
      height: 0;
      border-width: 0px 6px 6px 0px;
      border-style: solid;
      border-color: #FFF;
      border-bottom-color: transparent;
    }

    .btn-square-slant:active {
      /*ボタンを押したとき*/
      border:none;
      -webkit-transform: translate(6px,6px);
      transform: translate(6px,6px);
    }

    .btn-square-slant:active:after, .btn-square-slant:active:before {
      content: none;/*ボタンを押すと線が消える*/
    }
    
  </style>
  <title>居酒屋検索 履歴画面</title>
</head>
<body>
  <?php
    require_once "../load-header-template.php";
    load_header_template("../template/header-template.php");
  ?>
  <div class="center1">
    <div class="center2">
      <h3>履歴画面</h3>
    </div>

    <?php if(!$array) : ?>
      <p>履歴はありません。</p>
    <?php else : ?>
      <!-- 店舗の「画像」、「店名」、「ジャンル」 -->
      <?php foreach($array as $item) : ?>
      <div class="l-wrapper_02 card-radius_02">
        <article class="card_02">
          <div class="card__header_02">
            <p class="card__title_02"><?php echo $item["store_name"] ?></p>
            <figure class="card__thumbnail_02">
              <img src=<?php echo $item["store_image"]; ?>  alt="サムネイル" class="card__image_02">
            </figure>
          </div>
          <div class="card__body_02">
            <p class="card__text2_02">ジャンル：<span><?php echo $item["store_genre"] ?></span></p>
            <p class="card__text2_02">予算：<span><?php echo $item["store_budget"] ?></span></p>
            <p class="card__text2_02">定休日：<span><?php echo $item["store_holiday"] ?></span></p>
            <?php if($item["store_coupon"]) : ?>
              <a class="card__text2_02" href=<?php echo $item["store_coupon"] ?> target=_blank>クーポンを見る：<?php echo $item["store_name"] ?></a>
            <?php endif; ?>
          </div>    
        </article>
      </div>
      <div class="center2">
        <a href="https://maps.google.com/maps?q=<?php echo $item["store_name"] ?>" target=_blank class="btn-square-slant"><?php echo $item["store_name"] ?></a>
      </div>
      <?php endforeach; ?>
    <?php endif ?>
  </div>

  <script src="../js/toggle.js" async defer></script>
</body>
</html>