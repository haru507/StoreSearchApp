<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/header.css">
  <title>居酒屋検索ガチャ</title>
  <link rel="shortcut icon" href="./img/beers.png"　type="image/png">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAbqMRZ3Z1rD_Wu-h2jlVAJh-UAkvFqM1c"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 80vh;
      width: 90%;
    }
    .abc,.abc1 {
      display: flex;
    }
    .abc img {
      margin-bottom: 20px;
      /* margin-right: 270px; */
    }
    .abc1 img {
      margin-bottom: 20px;
      position: relative;
      left: 90px;
    }
    /* 吹き出し本体 */
  .balloon{
    position: relative;
    padding: 20px;
    font-size: 11px;
    background-color: #ade0ff;
    border-radius: 30px;
    height: 30px;
    width: 150px;
    left: 60px;
  }
  /* 大きい丸 */
  .balloon::before{
    content: '';
    position: absolute;
    display: block;
    border-radius: 50%;
    background-color: #ade0ff;
    left: -35px;
    bottom: 15px;
    width: 30px;
    height: 30px;
  }
  /* 小さい丸 */
  .balloon::after{
    content: '';
    position: absolute;
    display: block;
    border-radius: 50%;
    background-color: #ade0ff;
    left: -55px;
    bottom: 10px;
    width: 15px;
    height: 15px;
  }
    /* 吹き出し本体 */
  .balloon1{
    position: relative;
    padding: 20px;
    font-size: 11px;
    background-color: #ade0ff;
    border-radius: 30px;
    height: 30px;
    width: 150px;
  }
  /* 大きい丸 */
  .balloon1::before{
    content: '';
    position: absolute;
    display: block;
    border-radius: 50%;
    background-color: #ade0ff;
    left: 195px;
    bottom: 15px;
    width: 30px;
    height: 30px;
  }
  /* 小さい丸 */
  .balloon1::after{
    content: '';
    position: absolute;
    display: block;
    border-radius: 50%;
    background-color: #ade0ff;
    left: 240px;
    bottom: 10px;
    width: 15px;
    height: 15px;
  }
  ul {
    list-style: none;
  }
  /* スライドのCSS */
  #slide ul {
    position: relative;
  }
  #slide li {
    position: absolute;
    width: 100%;
    left: 0;
  }
  #button {
    width: 15px;
    position: relative;
    top: 320px;
    left: 70px;
  }
  #button ul {
    display: flex;
  }
  #button ul li a {
    text-indent: -9999px;
    text-decoration: none;
    display: inline-block;
    width: 14px;
    height: 14px;
    border-radius: 7px;
    background: #A8DCDB;
    margin: 0 10px;
  }
  button {
    margin-top: 360px;
  }
  </style>
</head>
<body>
  <?php
  require_once "load-header-template.php";

  load_header_template("./template/header-template.php");
  ?>

  <div class="main">
    <div class="abc" id="a1">
      <img width="60px" height="100px" src="./img/2.png">
      <div class="balloon">
        友達と居酒屋に行きたい！！
        <br>でも、店が決まらない...
      </div>
    </div>
    <div class="abc1" id="a2">
      <div class="balloon1">
        ジャンルは決まっても
        <br>いいサイトがない。
      </div>
      <img width="60px" height="100px" src="./img/3.png">
    </div>
    <div class="abc" id="a3">
      <img width="70px" height="100px" src="./img/1.png">
      <div class="balloon">
        そんな時は
        <br>居酒屋検索ガチャ！！
      </div>
    </div>

    <div id="slide">
      <ul>
        <li><img width="340px" height="300px" src="./img/main.png"></li>
        <li><img width="340px" height="300px" src="./img/result.png"></li>
        <li><img width="340px" height="300px" src="./img/signup.png"></li>
        <li><img width="340px" height="300px" src="./img/history.png"></li>
      </ul>
    </div>
    <div id="button">
      <ul>
        <li><a href="#" class="target">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
      </ul>
    </div>

    <button id="gacha">ガチャ画面へ</button>
  </div>

  <script src="./js/toggle.js" async defer></script>
  <script>
    const gacha = document.getElementById("gacha")
    gacha.addEventListener("click", function(){
      window.location.href = '../components/main.php';
    }, false)

    $("#a1").hide();
    $("#a2").hide();
    $("#a3").hide();
    $("#slide").hide();
    $("#button").hide();
    $("button").hide();
    setTimeout(() => {
      $("#a1").fadeIn(1000);
    }, 1000);
    setTimeout(() => {
      $("#a2").fadeIn(1000);
    }, 3000);
    setTimeout(() => {
      $("#a3").fadeIn(1500);
    }, 7000);
    setTimeout(() => {
      $("#a1").hide();
      $("#a2").hide();
      $("#a3").hide();
    }, 11000);
    setTimeout(() => {
      $("#slide").fadeIn();
      $("#button").fadeIn();
      $("button").fadeIn(1000);
      $( function() {
      console.log("a")
      var count = $("#slide li").length;
      var current = 1;
      var next = 2;
      var interval = 7000;
      var duration = 500;
      var timer;

      $("#slide li:not(:first-child)").hide();
      timer = setInterval(slideTimer, interval);
      function slideTimer() {
        $("#slide li:nth-child(" + current + ")").fadeOut(duration);
        $("#slide li:nth-child(" + next + ")").fadeIn(duration);
        current = next;
        next = ++next;
        if(next > count){
          next = 1;
        }
        $("#button li a").removeClass("target");
        $("#button li:nth-child(" + current + ") a").addClass("target");
      }
      $("#button li a").click(function() {
        next = $(this).html();
        clearInterval(timer);
        timer = setInterval(slideTimer, interval);
        slideTimer();
        return false;
      });
    });
    }, 12000);
    
    
  </script>
</body>
</html>