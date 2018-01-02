<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<!--content-->
  <div class="content">
      <h2 style="padding-left: 150px;font-size: 20px;">Form đăng nhập</h2>
  <?php
    if(isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $password = md5($password);
        $query = "select * from users where username='{$username}' and password = '{$password}' limit 1";
        $result = $mySQLI->query($query);
        $arUser = mysqli_fetch_assoc($result);
        if(count($arUser)>0) {
            $_SESSION['arUser'] = $arUser;
            header("location:/admin/");
        } else {
            echo "<span style='padding-left: 150px;'>Sai tài khoản hoặc mật khẩu</span>";
        }
    }
  ?>
      <form action="" method="post" class="form-login" style="padding: 100px;">
        <label class="left-login">Username : (*)</label>
          <div class="right-login">
            <input class="input-right" type="text" name="username">
            <br/ ><label for="username" class="error"></label>
          </div>
        <div class="clr"></div>
        <label class="left-login">Password : (*)</label>
          <div class="right-login">
            <input class="input-right" type="password" name="password">
            <br/ ><label for="password" class="error"></label>
          </div>
        <div class="clr"></div>
        <label class="left-login"></label>
          <div class="right-login">
            <input type="submit" class="button" name="login" value="Login">
          </div>
          <div class="clr"></div>
      </form>
  </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>