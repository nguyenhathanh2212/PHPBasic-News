<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
    if(!empty($_GET['idCat']) && $_SESSION['arUser']['active'] == 1) {
        $idCat = $_GET['idCat'];
        $query = "DELETE FROM cat_list WHERE id={$idCat}";
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