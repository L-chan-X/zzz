<?php
  session_start();
  define("dic", "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ");
  header("content-type:png");
  if($_GET['index'] >= 0 && $_GET['index'] < 4){
    $img = imagecreate(40, 40);
    imagecolorallocate($img, 255, 255, 255);  
    imagestring($img, 10, 10, 10, $_SESSION['captcha'][$_GET['index']] = dic[mt_rand(0, 55)], imagecolorallocate($img, 0, 0, 0));
    imagepng($img);
    imagedestroy($img);
  }
?>