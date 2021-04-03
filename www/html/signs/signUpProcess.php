<?php
require_once('./config.php');

session_start();

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

// POSTのValidate。
// EMAIL
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
// USERNAME
$username = $_POST['username'];
// パスワードの正規表現
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//登録処理
try {
  $stmt = $pdo->prepare("insert into users(email, username, password) value(?, ?, ?)");
  $stmt->execute([$email, $username, $password]);
  $_SESSION['OK'] = '登録が完了しました。';
  header("Location: signIn.php");
} catch (\Exception $e) {
  $_SESSION['ERROR'] = '登録済みのメールアドレスです。';
  header('Location signUp.php');
}