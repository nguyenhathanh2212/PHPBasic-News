<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
    <div class="content">
        <h2 class="tit"><i class="fa fa-user"></i>  Sửa user</h2>
        <?php
            if(!empty($_GET['idUser'])) {
                $idUser = $_GET['idUser'];
                if($_SESSION['arUser']['id'] != $idUser && $_SESSION['arUser']['id'] !=1 ) {
                    header("location:index.php?msg=Bạn không có quyền sửa");
                    die();
                }
            } else {
                header("location:index.php");
            }
            $queryUser = "SELECT * FROM users WHERE id='{$idUser}'";
            $resultUser = $mySQLI->query($queryUser);
            $arUser = mysqli_fetch_assoc($resultUser);
            $usernameUser = $arUser['username'];
            $emailUser = $arUser['email'];
            $passwordUser = $arUser['password'];
            $fullnameUser = $arUser['fullname'];
            $activeUser = $arUser['active'];
            $checkbox = "";
            if($activeUser == 1) {
                $checkbox = "checked";
            }
        ?>
        <?php
            if(isset($_POST['edit'])) {
                $username = trim($_POST['username']);
                $password = trim($_POST['editpassword']);
                $email = trim($_POST['email']);
                $fullname = trim($_POST['fullname']);
                $active = 0;
                if($_POST['active'] == "active") {
                    $active = 1;
                }
                if($password == '') {
                    $query = "UPDATE users SET email='{$email}',fullname='{$fullname}',active={$active} WHERE id='{$idUser}'";
                } else {
                    $password = md5($password);
                    $query = "UPDATE users SET password='{$password}',email='{$email}',fullname='{$fullname}',active={$active} WHERE id='{$idUser}'";
                }
                if($mySQLI->query($query)) {
                    header("location:index.php?msg=Sửa thành công");
                } else {
                    header("location:index.php?msg=Sửa thất bại");
                }
            }
        ?>
        <form method="post" action="" class="form-edituser">
                <label class="left-login">Username : (*)</label>
                <div class="right-login">
                    <input class="input-right" type="text" name="username" value="<?php echo $usernameUser?>" readonly="readonly">
                    <br/ ><label for="username" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Edit password: </label>
                <div class="right-login">
                    <input class="input-right" type="password" name="editpassword">
                    <br/ ><label for="editpassword" ></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Edit fullname : (*)</label>
                <div class="right-login">
                    <input class="input-right" type="text" name="fullname" value="<?php echo $fullnameUser?>" >
                    <br/ ><label for="fullname" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Edit email: (*)</label>
                <div class="right-login">
                    <input class="input-right" type="text" name="email" value="<?php echo $emailUser?>">
                    <br/ ><label for="email" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Active:</label>
                <div class="right-login">
                    <input type="checkbox" <?php echo $checkbox; ?> name="active" value="active">
                    <br/ ><label for="active" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login"></label>
                <div class="right-login">
                    <input type="submit" class="button " name="edit" value="Edit">
                </div>
                <div class="clr"></div>

        </form>
    </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>