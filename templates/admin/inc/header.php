<?php require_once $_SERVER['DOCUMENT_ROOT'].'/functions/dbconnect.php';
    ob_start();
    session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/libraries/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/libraries/bootstrap-3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/libraries/reset.css">
    <link rel="stylesheet" type="text/css" href="/templates/admin/css/style.css"><!-- 
    <link rel="shortcut icon" href="/templates/admin/images/icon.ico" type="image/x-icon"> -->
    <script type="text/javascript" src="/libraries/ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="/libraries/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/libraries/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/libraries/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/templates/admin/js/script.js"></script>
</head>
<body>
    <div class="row">
        <?php if(isset($_SESSION['arUser'])){ ?>
        <div class="left col-sm-2">
            <?php 
                if(isset($_SESSION['arUser'])) {
                    $fullName = $_SESSION['arUser']['fullname'];
                }else {
                    $fullName = "Xin chào";
                }
                $idUser = $_SESSION['arUser']['id'];
                $query = "SELECT * FROM users WHERE id={$idUser}";
                $result = $mySQLI->query($query);
                $arUSers = mysqli_fetch_assoc($result);
                $active = $arUSers['active'];
            ?>
            <h4 class="username"><?php echo $fullName ?></h4>
            <ul class="ul-list-manage">
                <li class="li-list-manage" ><a href="/admin/category/?id=1"><i class="icon-cat fa fa-list-ul" aria-hidden="true"></i>Danh mục<span class="visited"></span></a></li>
                <li class="li-list-manage"><a href="/admin/news/?id=2"><i class="icon-cat fa fa-map" aria-hidden="true"></i>Bài viết<span class="visited"></span></a></li>
                <li class="li-list-manage"><a href="/admin/comments/?id=3"><i class="icon-cat fa fa-comment" aria-hidden="true"></i>Bình luận<span class="visited"></span></a></li>
                <li class="li-list-manage"><a href="/admin/users/?id=4"><i class="icon-cat fa fa-user" aria-hidden="true"></i>Quản trị viên<span class="visited"></span></a></li>
            </ul>
        <?php } ?>
    </div>
    <?php 
        if(isset($_SESSION['arUser'])) {
            $class = "right col-sm-10";
        } else {
            $class = "right col-sm-12";
        }
    ?>
    <div class="<?php echo $class?>">
      <div class="header row">
        <?php
          $trang = '';
            if(!empty($_GET['id'])) {
                $id = $_GET['id'];
                switch($id) {
                  case 1:
                    $trang = "Danh mục";
                    break;
                  case 2:
                    $trang = "Bài viết";
                    break;
                  case 3:
                    $trang = "Bình luận";
                    break;
                  case 4:
                    $trang = "Quản trị viên";
                    break;
                  
                  default:
                    $trang = '';
                    break;
                }
            }
        ?>
        <h4 class="col-sm-3 title-manage"><a href="#"><?php echo $trang ?></a></h4>
        <div class="user-log col-sm-3 col-sm-offset-6">
          <ul class="ul-user-log">
            <?php 
                if(isset($_SESSION['arUser']['id'])) {
                    $idUser = $_SESSION['arUser']['id'];
                    $query = "SELECT * FROM users WHERE id={$idUser}";
                    $result = $mySQLI->query($query);
                    $arUSers = mysqli_fetch_assoc($result);
                    $fullname = $arUSers['fullname'];
                ?>
                <li class="li-user-log"><a href="/admin/logout.php">Log out</a></li>
                <?php } else { ?>
                <li class="li-user-log">Xin chào!</li>
            <?php } ?>
          </ul>
        </div>
      </div>
    <!--end header-->