<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
    <div class="content">
        <a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
        <?php
          if(!empty($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo $msg;
          }
        ?>
        <table class="tb-admin" width="100%">
            <tr>
                <th width="10%">ID</th>
                <th width="50%">Tên danh mục</th>
                <th width="10%">ID cha</th>
                <?php if($_SESSION['arUser']['active'] == 1) { ?>
                    <th width="30%">Chức năng</th>
                <?php } ?>
            </tr>
            <?php
                $query = "SELECT * FROM cat_list";
                $result = $mySQLI->query($query);
                while($arCat = mysqli_fetch_array($result)) {
                    $idCat = $arCat['id'];
                    $name = $arCat['name'];
                    $idCatParent = $arCat['parent_id'];
            ?>
            <tr>
                <td><?php echo $idCat?></td>
                <td><?php echo $name?></td>
                <td><?php echo $idCatParent?></td>
                <?php if($_SESSION['arUser']['active'] == 1) { ?>
                    <td>
                      <a href="edit.php?idCat=<?php echo $idCat?>"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a> |
                      <a href="del.php?idCat=<?php echo $idCat?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tin ?');" ><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                    </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
      </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>