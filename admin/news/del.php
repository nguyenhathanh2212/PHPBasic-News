<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
    if(!empty($_GET['idTin'])) {
        $idTin = $_GET['idTin'];
        $queryTin = "SELECT * FROM news WHERE id={$idTin}";
        $resultTin = $mySQLI->query($queryTin);
        $arTin = mysqli_fetch_assoc($resultTin);
        $createBy = $arTin['created_by'];
        if($_SESSION['arUser']['username'] != 'admin' && $_SESSION['arUser']['id'] != $createBy) {
            header('location:index.php?msg=Bạn không có quyền xóa');
            die();
        }
        $picture = $arTin['picture'];
        unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$picture);
        $query = "DELETE FROM news WHERE id={$idTin}";
        if($result = $mySQLI->query($query)) {
            $queryCmt = "DELETE FROM comments WHERE news_id={$idTin}";
            $mySQLI->query($queryCmt);
            header('location:index.php?msg=Xóa thành công');
        } else {
            header('location:index.php?msg=Xóa thất bại');
            die();
        }
    } else {
        header("location:index.php");
    }
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>