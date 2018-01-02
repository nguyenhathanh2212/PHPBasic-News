<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
    if(!empty($_GET['idUser'])) {
        $idUser = $_GET['idUser'];
        $queryUser = "SELECT * FROM users WHERE id={$idUser}";
        $resultUser = $mySQLI->query($queryUser);
        $arUser = mysqli_fetch_assoc($resultUser);
        $active = $arUser['active'];
        $username = $arUser['username'];
        if($active == 1 && $_SESSION['arUser']['id'] != 1) {
            header("location:index.php?msg=Không thể xóa user này nếu không phải là admin");
            die();
        }
        if($username != 'admin') {
            $query = "DELETE FROM users WHERE id={$idUser}";
            if($result = $mySQLI->query($query)) {
                $queryNews = "SELECT * FROM news WHERE created_by={$idUser}";
                $resultNews = $mySQLI->query($queryNews);
                while($arNews = mysqli_fetch_assoc($resultNews)) {
                    $idNews = $arNews['id'];
                    $queryCmt = "DELETE FROM comments WHERE news_id={$idNews}";
                    $mySQLI->query($queryCmt);
                }
                $queryNews = "DELETE FROM news WHERE created_by={$idUser}";
                $mySQLI->query($queryNews);
                header('location:index.php?msg=Xóa thành công');
            } else {
                echo "Có lổi : ";
                die();
            }
        } else {
            header('location:index.php?msg=bạn không thể xóa admin');
        }
    } else {
        header("location:index.php");
    }
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>