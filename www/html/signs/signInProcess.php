<?php

require_once('./config.php');

session_start();

//DB内でPOSTされたメールアドレスを検索
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('select * from users where email = ?');
  $stmt->execute([$_POST['email']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
//emailがDB内に存在しているか確認
if (!isset($row['email'])) {
  $_SESSION['MESSAGE'] = 'メールアドレス又はパスワードが間違っています。';
  header('Location: signIn.php');
  return false;
}
//パスワード確認後sessionにメールアドレスを渡す
if (password_verify($_POST['password'], $row['password'])) {
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['EMAIL'] = $row['email'];
  $_SESSION['ID'] = $row['id'];
  $_SESSION['MESSAGE'] = 'ログインしました';
  header('Location: ../components/main.php');
} else {
  $_SESSION['MESSAGE'] = 'メールアドレス又はパスワードが間違っています。';
  return false;
}
