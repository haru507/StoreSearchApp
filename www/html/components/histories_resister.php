<?php
session_start();

require_once('../signs/config.php');

$array = array();

$array[] = (int)$_POST['user_id'];
$array[] = $_POST['store_name'];
$array[] = $_POST['store_image'];
$array[] = $_POST['store_genre'];
$array[] = $_POST['store_budget'];
$array[] = $_POST['store_holiday'];
$array[] = $_POST['store_coupon'];

try{
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $sql = 'insert into histories (user_id, store_name, store_image, store_genre, store_budget, store_holiday, store_coupon) values (?, ?, ?, ?, ?, ?, ?)';
  $stmt = $pdo->prepare($sql);
  $result = $stmt->execute($array);

  if($result){
    echo json_encode($result);
  }else {
    echo json_encode($result);
  }
}catch(PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}

var_dump($array);
echo json_encode($array);
?>