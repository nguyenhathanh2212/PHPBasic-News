<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
    if(!empty($_GET['idCmt'])) {
        $idCmt = $_GET['idCmt'];
        $query = "DELETE FROM comments WHERE id={$idCmt}";
        if($result = $mySQLI->query($query)) {
            header('location:index.php?msg=Xóa thành công');
        } else {
            echo "Có lổi : ";
            die();
        }
    } else {
        header("location:index.php");
    }
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>