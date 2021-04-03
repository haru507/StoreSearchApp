<?php
session_start();

if(isset($_SESSION["EMAIL"])){
  $errorMessage = "ログアウトしました。";
}else {
  $errorMessage = "セッションがタイムアウトしました。";
}

// セッション変数のクリア
$_SESSION = array();
//セッションクリア
@session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../img/beers.png"　type="image/png">
  <title>ログアウト画面</title>
</head>
<body>
  <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
  <p>※3病後にメインページ（ガチャ画面）に遷移します。</p>

  <script>
    setTimeout(() => {
      window.location.href = '../components/main.php';
    }, 3000);
  </script>
</body>
</html>