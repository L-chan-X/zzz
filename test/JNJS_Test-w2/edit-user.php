<?php
  session_start();  
  include_once("func.php");
  if(!isset($_SESSION["user"]) || $_SESSION["user"]["permission"][0] < 2){
    gourl("請重新登入!", "index.php");
  }
  $db = new mysqli("localhost", "admin", "1234", "jnjs");
  $db->query("SET NAMES 'utf8'");
  $eper = $db->query("SELECT permission FROM jnjs WHERE id = '".$_POST["edit-id"]."'")->fetch_array()[0];
  if($eper > $_SESSION["user"]["permission"][0])
    gourl("權限不足!", "maneger.php");
  $sql = "UPDATE `jnjs`
          SET `name` = '".$_POST["edit-name"]."',
            `account` = '".$_POST["edit-account"]."',
            `password` = '".$_POST["edit-password"]."',
            `permission` = '".$_POST["edit-radio"]."'
          WHERE `jnjs`.`id` = ".$_POST["edit-id"];
  if($db->query($sql)) {
    gourl("修改成功!", "maneger.php");
  } else {    
    gourl("修改發生錯誤!", "maneger.php");
  }
?>