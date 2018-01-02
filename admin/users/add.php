<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
    <?php 
        if($_SESSION['arUser']['active'] != 1) {
            header("location:index.php?msg=Bạn không có quyền thêm user");
            die();
        }
    ?>
    <div class="content">
            
        <h2 class="tit"><i class="fa fa-user-plus"></i>  Thêm user</h2>
        <?php
            if(isset($_POST['add'])) {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $password = md5($password);
                $fullname = trim($_POST['fullname']);
                $email = trim($_POST['email']);
                $active = 0;
                if($_POST['active'] == 'active') {
                    $active = 1;
                }
                $queryUser = "SELECT username FROM users";
                $resultUser = $mySQLI->query($queryUser);
                while($arUser = mysqli_fetch_assoc($resultUser)) {
                    $name = $arUser['username'];
                    if($name == $username) {
                        header("location:index.php?msg=Username đã tồn tại");
                        die();
                    }
                }
                if($username != 'admin') {
                    $query = "INSERT INTO users(username,password,fullname,email,active) VALUES ('{$username}','{$password}','{$fullname}','{$email}',{$active})";
                    if($mySQLI->query($query)) {
                        header("location:index.php?msg=Thêm thành công");
                    } else {
                        die();
                    }
                } else {
                    header("location:index.php?msg=Không thể thêm admin");
                }
            }
        ?>
        <form method="post" action="" class="form-adduser">
                <label class="left-login">Username : (*)</label>
                <div class="right-login">
                    <input class="input-right" type="text" name="username">
                    <br/ ><label for="username" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Password: (*)</label>
                <div class="right-login">
                    <input class="input-right" id='password' type="password" name="password">
                    <br/ ><label for="password" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Confirm password: (*)</label>
                <div class="right-login">
                    <input class="input-right" type="password" name="repassword">
                    <br/ ><label for="repassword" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Fullname : (*)</label>
                <div class="right-login">
                    <input class="input-right" type="text" name="fullname">
                    <br/ ><label for="fullname" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Email: (*)</label>
                <div class="right-login">
                    <input class="input-right" type="text" name="email">
                    <br/ ><label for="email" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Active:</label>
                <div class="right-login">
                    <input type="checkbox" name="active" value="active">
                    <br/ ><label for="active" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login"></label>
                <div class="right-login">
                    <input type="submit" class="button" name="add" value="Add">
                </div>
                <div class="clr"></div>
            </form>
        </div>
    </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>