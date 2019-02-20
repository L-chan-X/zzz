<?php
session_start();
$alert="";
if(!empty($_SESSION['alert'])){
	$alert=$_SESSION['alert'];
	unset($_SESSION['alert']);
}
$id = $_SESSION['user']['id'];
$name = $_SESSION['user']['name'];
$account = $_SESSION['user']['account'];
$password = $_SESSION['user']['password'];
$permission = $_SESSION['user']['permission'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
<div style="text-align: center;font-size: 36px">後台管理系統</div>
<div style="text-align: center">專區</div>
<p style="text-align: center">
<input style="text-align: center" type="button" name="logout" id="logout" value="登出">
</p>
<div style="text-align: center">使用者名稱: <?php echo "$name" ?></div>
<div style="text-align: center">帳號: <?php echo "$account" ?></div>
<p id="time" style="text-align: center">
<input type="button" name="timeset" id="timeset" value="設定計時">
<p style="text-align: center">
倒數計時:60</p>
<p style="text-align: center">
<input style="text-align: center" type="button" name="timereset" id="timereset" value="重置計時">
</p>
<p style="text-align: center">
<input type="button" name="adduser" id="adduser" value="新增使用者">
</p>
<p style="text-align: center">
<input type="button" name="record" id="record" value="紀錄">
</p>
<p style="text-align: center">
<input type="search" name="search" id="search" value="
<?php
if($_GET['search'] != "" ){
	echo "$_GET['search']";
}else{
	echo "";
}
?>">
<input type="button" name="searchB" id="searchB" value="確定">
</p>
<?php 
if($permission[0]= 2) {
	echo'<th>修改</th><th>刪除</th>';
}else{
	echo'';
}
?>
<p>
<table>
<th>編號</th>
<th>名稱</th>
<th>帳號</th>
<th>密碼</th>
<th>權限</th>
<?php 
$db=new mysqli('localhost','admin','1234','mysql')
$db->query('SET NAMES `UTF8`');
$sql='SELECT * FROM `mysql`';
if(!empty($_GET['sesrch'])){
	$sql .= "WHERE account LIKE '%".$_GET['sesrch']."%'";
}
$result = $db->query($sql);
while ($row = $result->fetch_array()) {
	echo '<tr pid="'.$row['id'].'">';
	if ($permission[0] >= 2) {
        if ($row['permission'] == 3) {
            echo '<td></td><td></td>';
        } else {
            echo '<td class="edit-user-btn">
            <span class="ui-icon ui-icon-pencil zoom"></span>
            </td>
            <td class="del-user-btn">
            <span class="ui-icon ui-icon-circle-minus zoom"></span>
            </td>';
        }
	}
	echo '<td>'.$row['id'].'</td>
	<td>'.$row['name'].'</td>
	<td>'.$row['account'].'</td>
	<td>'.$row['password'].'</td>
	<td>'.$row['permission'].'</td>
  </tr>';
}	
?>
</table>
</p>
<script>
    $(() => {
      if('<?=$alert; ?>' != ''){
        alert('<?=$alert; ?>');
      }
      if('<?=$_GET['search'] ?? ''; ?>' != ''){
        $('#').click();
      }      
    })
  </script>
<script src="bks.js"></script>
<script>
	if ('<?php echo($alert) ?>' != "")
			alert("<?php echo($alert);?>");
</script>	
<form action="add-user.php" method="post" id="add-user">
    <div class="inp-box">
      <label for="inp-name">使用者名稱：</label>
      <input type="text" name="inp-name" id="inp-name">
    </div>
    <div class="inp-box">
      <label for="inp-account">使用者帳號：</label>
      <input type="text" name="inp-account" id="inp-account">
    </div>
    <div class="inp-box">
      <label for="inp-password">使用者密碼：</label>
      <input type="password" name="inp-password" id="inp-password">
    </div>
    <div class="inp-box">
      <input type="radio" name="inp-radio" id="inp-admin" value="2" checked>
      <label for="inp-admin">一般管理員</label>
      <input type="radio" name="inp-radio" id="inp-user" value="1">
      <label for="inp-user">一般使用者</label>
    </div>
  </form>
  <form action="edit-user.php" method="post" id="edit-user">
    <div class="inp-box">
      <label for="edit-id">使用者編號：</label>
      <input type="text" name="edit-id" id="edit-id" readonly disabled>
    </div>
    <div class="inp-box">
      <label for="edit-name">使用者名稱：</label>
      <input type="text" name="edit-name" id="edit-name">
    </div>
    <div class="inp-box">
      <label for="edit-account">使用者帳號：</label>
      <input type="text" name="edit-account" id="edit-account">
    </div>
    <div class="inp-box">
      <label for="edit-password">使用者密碼：</label>
      <input type="password" name="edit-password" id="edit-password">
    </div>
    <div class="inp-box">
      <input type="radio" name="edit-radio" id="edit-admin" value="2" checked>
      <label for="edit-admin">一般管理員</label>
      <input type="radio" name="edit-radio" id="edit-userx" value="1">
      <label for="edit-userx">一般使用者</label>
    </div>
  </form>
  <div id="recordlog-box">
    <p></p>
  </div>

</body>
</html>