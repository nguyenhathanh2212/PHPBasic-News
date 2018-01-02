<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
    <div class="content">
        <?php if($_SESSION['arUser']['active'] == 1) { ?>
            <a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
        <?php }
            if(!empty($_GET['msg'])) {
                $msg=$_GET['msg'];
                echo $msg;
            }
        ?>
        <table class="tb-admin" width="100%">
          <tr>
            <th width="5%">ID</th>
            <th width="20%">Username</th>
            <th width="30%">Fullname</th>
            <th width="20%">Email</th>
            <?php if($_SESSION['arUser']['id'] == 1) { ?>
            <th width="5%">QTV</th>
            <?php } ?>
            <th width="20%">Chức năng</th>
          </tr>
            <?php
                $queryUser = "SELECT * FROM users ";
                $resultUser = $mySQLI->query($queryUser);
                while($arUser = mysqli_fetch_assoc($resultUser)) {
                    $idUser = $arUser['id'];
                    $username = $arUser['username'];
                    $fullname = $arUser['fullname'];
                    $email = $arUser['email'];
                    $active = $arUser['active'];
            ?>
          <tr <?php if($_SESSION['arUser']['id'] == $idUser) { ?> style="background: #d40909;"<?php } ?>>
            <td><?php echo $idUser ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $fullname ?></td>
            <td><?php echo $email ?></td>
            <?php if($_SESSION['arUser']['id'] == 1) { ?>
            <td>
                <?php 
                    $check = "";
                    if($active == 1) {
                        $check = "checked";
                    }
                    if($idUser == 1) {
                        echo "<img src='/templates/public/images/tick.png'>";
                    } else {
                        echo "<input type='checkbox'{$check} name='active' class='active' value='{$idUser}'/>";
                    }
                ?>
            </td>
            <?php } ?>
            <td>
              <?php if($_SESSION['arUser']['active'] == 1 || $_SESSION['arUser']['id'] == 1) { ?>
                <a href="edit.php?idUser=<?php echo $idUser?>" class="fa fa-pencil">Sửa</a>
                    <?php if($idUser != 1) { ?>
                    |<a href="del.php?idUser=<?php echo $idUser?>" onclick="return confirm('Bạn có chắc chắn muốn xóa user ?');" class="fa fa-trash">Xóa</a>
                    <?php } ?>
                <?php } else {
                    if($_SESSION['arUser']['id'] == $idUser) {
                      echo "<a href='edit.php?idUser=<?php echo $idUser?>' class='fa fa-pencil'>Sửa</a>";
                    } else {
                      echo "<img style='height:20px;' src='/templates/admin/images/none.png'>";
                    }
                ?>
              <?php } ?>
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>