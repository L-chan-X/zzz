<?php
  session_start();
  $alert = '';
  if (!empty($_SESSION['alert'])) {
      $alert = $_SESSION['alert'];
      unset($_SESSION['alert']);
  }
  if (!isset($_SESSION['user'])) {
      $_SESSION['alert'] = '請重新登入！';
      header('Location: index.php');
      exit;
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
  <title>後臺管理系統</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/maneger.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/maneger.js"></script>
</head>

<body>
  <nav>
    <div style="margin: 5px 0; cursor:pointer;" onClick="location.href='maneger.php'">
      <h1>後臺管理系統/</h1>
      <span><?=$permission[1]; ?>專區</span>
    </div>
    <button id="logout">登出</button>
    <div id="user-statue">
      <span>使用者名稱：<?=$name;?></span>
      <span>帳號：<?=$account;?></span>
    </div>
    <p style="float:right; font-size:30px; display:inline-block; margin-right: 100px;" id="time-p">
      <button id="time-check-set">設定時長</button>
      倒數計時:<span id="time-span">60</span>
      <button id="time-check-reset">重新計時</button>
    </p>
  </nav>
  <main>
    <aside>
      <button id="add-user-btn">新增使用者</button>
      <button id="recordlog-btn">記錄</button>
    </aside>
    <div id="user-data">
      <div id="srch-box">
        <input type="search" name="srch-txt" id="srch-txt" value="<?=$_GET['srch-txt'] ?? ''; ?>">
        <button id="srch-btn" class="ui-icon ui-icon-search zoom" style="border: none; cursor: pointer;"></button>
      </div>
      <table border="1">
        <thead>
          <?=$permission[0] >= 2 ? '<th>修改</th><th>刪除</th>' : ''; ?>
          <th>編號<span class="ui-icon ui-icon-triangle-2-n-s zoom"></span></th>
          <th>姓名<span class="ui-icon ui-icon-triangle-2-n-s zoom"></span></th>
          <th>帳號<span class="ui-icon ui-icon-triangle-2-n-s zoom"></span></th>
          <th>密碼</th>
          <th>權限</th>
        </thead>
        <tbody>
          <?php
            $db = new mysqli('localhost', 'admin', '1234', 'jnjs');
            $db->query('SET NAMES `UTF8`');
            $sql = 'SELECT * FROM `jnjs`';
            if (!empty($_GET['srch-txt'])) {
                $sql .= "WHERE account LIKE '%".$_GET['srch-txt']."%'";
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
        </tbody>
      </table>
    </div>
  </main>
  <script>
    $(() => {
      if('<?=$alert; ?>' != ''){
        alert('<?=$alert; ?>');
      }
      if('<?=$_GET['srch-txt'] ?? ''; ?>' != ''){
        $('#user-data th:eq(2)').click();
      }      
    })
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

  <div id="time-check-box">
    <p>是否繼續操作?<br />將在<span id="time-check-span">5</span>秒後自動登出</p>
  </div>

</body>

</html>