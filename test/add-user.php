<?php
  session_start();
  include_once("func.php");
  if(!isset($_SESSION['user'])){
    $_SESSION['alert'] = "請重新登入！";
    header("Location: index.php");
    exit;
  }
  $name = $_POST['inp-name'];
  $account = $_POST['inp-account'];
  $password = $_POST['inp-password'];
  $cpermission = $_POST['inp-radio'];
  $spermission = $_SESSION['user']['permission'];  
  if($spermission[0] >= 2){
    $db = new mysqli("localhost", "admin", "1234", "jnjs");
    $db->query("SET NAMES `UTF8`");
    $sql = "INSERT INTO `jnjs` (`id`, `name`, `account`, `password`, `permission`) VALUES (NULL, '".$name."', '".$account."', '".$password."', '".$cpermission."');";
    $db->query($sql);
    gourl("新增使用者成功", "maneger.php");
  } else
    gourl("權限不足！", "maneger.php");
?>