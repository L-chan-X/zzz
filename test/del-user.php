<?php
  session_start();  
  include_once("func.php");
  if(!isset($_SESSION["user"]) || $_SESSION["user"]["permission"][0] < 2){
    gourl("請重新登入!", "index.php");
  }
  $db = new mysqli("localhost", "admin", "1234", "jnjs");
  $db->query("SET NAMES 'utf8'");
  $eper = $db->query("SELECT permission FROM jnjs WHERE id = '".$_POST["del-id"]."'")->fetch_array()[0];
  if($eper > $_SESSION["user"]["permission"][0])
    gourl("權限不足!", "maneger.php");
  $sql = "DELETE FROM jnjs WHERE jnjs.id = ".$_POST["del-id"];
  if($db->query($sql)) {
    gourl("刪除成功!", "maneger.php");
  } else {    
    gourl("刪除發生錯誤!", "maneger.php");
  }
?>