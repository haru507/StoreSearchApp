<?php session_start() ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../img/beers.png"　type="image/png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>結果画面</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      width: 97%;
    }

    .box {
      width: 100%;
      margin-top: 60px;
      text-align: center
    }
    .box2 {
      width: 100%;
      margin-top: 10px;
      margin-bottom: 20px;
      text-align: center
    }
    #none {
      display: none;
    }
    #tooltip {
      text-align: center;
    }
    #tooltip span {
      position:relative;
    }
    #tooltip span:hover {
      background: white;
    }
    .sample1-tooltips {
      display: none;
      position: absolute;
      bottom: -5em;
      left: -150px;
      z-index: 9999;
      padding: 0.3em 0.5em;
      color: #000;
      background: lightgray;
      border-radius: 0.5em;
      font-size: .5em;
    }
    .sample1-tooltips:after {
      width: 100%;
      content: "";
      display: block;
      position: absolute;
      left: 13.5em;
      top: -8px;
      border-top:8px solid transparent;
      border-left:8px solid lightgray;
    }
    #tooltip span:hover .sample1-tooltips {
      display: block;
    }
  </style>
</head>
<body>
  <?php
  require_once "../load-header-template.php";
  load_header_template("../template/header-template.php");
  ?>

  <main>
    <div class="box">
      <h3 id="store-name"></h3>

      <img src="" id="myimage">
    </div>

    <p id="none"><?php echo $_SESSION["ID"]; ?></p>

    <div>
      <h6 id="genre" class="design"></h6>
      <h6 id="budget" class="design"></h6>
      <h6 id="close" class="design"></h6>
    </div>

    <div class="box2">
      <a id="coupon" href="" target=_blank></a>
      <p id="coupon1"></p>
    </div>

    <div id="tooltip">
      <span class="material-icons">
        info
        <div class="sample1-tooltips">
          「ここに行く」を押すと履歴画面にその店が表示されます。<br><br>
          その後に、GOOGLE MAPSのアプリが表示されます。
        </div>
      </span>
    </div>

    <div class="button1">
      <button id="top" >メインに戻る</button>
      <button id="maps" target="_blank">ここへ行く</button>
    </div>
  </main>

  <script src="../js/toggle.js" async defer></script>
  <script src="../js/hotpapper.js" async defer></script>
  <script>
    const name = localStorage.getItem('name');
    const image = localStorage.getItem('image');
    const genre = localStorage.getItem('genre');
    const budget = localStorage.getItem('budget');
    const close = localStorage.getItem('close');

    document.getElementById("store-name").innerHTML = name;
    // 画像を埋め込む
    var img = document.getElementById('myimage');
    img.setAttribute('src', image);

    document.getElementById('genre').innerHTML = genre
    document.getElementById('budget').innerHTML = budget
    document.getElementById('close').innerHTML = close

    const button1 = document.getElementById('maps');

    const coupon = document.getElementById('coupon');
    if(localStorage.getItem('coupon') === ""){
      const coupon1 = document.getElementById('coupon1');
      coupon1.innerHTML = "携帯クーポンはありません。";
    }else {
      coupon.href = localStorage.getItem('coupon');
      coupon.innerHTML = "携帯クーポンを取得する。";
    }
    

    const button2 = document.getElementById('top');
    button2.addEventListener('click', function() {
      window.location.href = '../components/main.php';
    }, false)

    const pushButton = document.getElementById('maps')
    pushButton.addEventListener('click', function() {
      // データベースに追加する処理
      let id = document.getElementById('none');
      if(id){
        let fd = new FormData();
        fd.append('user_id', id.textContent)
        fd.append('store_name', localStorage.getItem('name'));
        fd.append('store_image', localStorage.getItem('image'));
        fd.append('store_genre', localStorage.getItem('genre'));
        fd.append('store_budget', localStorage.getItem('budget'));
        fd.append('store_holiday', localStorage.getItem('close'));
        fd.append('store_coupon', localStorage.getItem('coupon'));

        var xhr = new XMLHttpRequest();  //Ajax通信のためのオブジェクトの生成
        xhr.open("POST","./histories_resister.php", true); //POSTメソッドで「sendReturn.php」のURLエンコードデータを渡す。
        xhr.responseType = 'json';
        xhr.addEventListener('load', function(event) {
          // Google Mapsを開く
          const lat = localStorage.getItem('lat2')
          const lng = localStorage.getItem('lng2')
          window.open(`https://www.google.com/maps/search/?api=1&query=${lat},${lng}`)
        })
        xhr.send(fd);  //URLエンコードデータの送信
      }else {
        // Google Mapsを開く
        const lat = localStorage.getItem('lat2')
        const lng = localStorage.getItem('lng2')
        window.open(`https://www.google.com/maps/search/?api=1&query=${lat},${lng}`)
      }
      
    })
  </script>
</body>
</html>