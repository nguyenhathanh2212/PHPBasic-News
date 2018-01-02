<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/defines.php" ?>
<?php
    $idUser = $_SESSION['arUser']['id'];
    $queryPage = "SELECT COUNT(id) AS sotin FROM comments";
    $resultPage = $mySQLI->query($queryPage);
    $arSoTin = mysqli_fetch_assoc($resultPage);
    $rowCount = ROW_COUNT_CMT;
    $pageCount = ceil($arSoTin['sotin']/$rowCount);
    $currentPage = 1;
    if(!empty($_GET['idpage'])) {
        $currentPage=$_GET['idpage'];
    }
?>  
    <!--content-->
    <div class="content">
        <?php
            if(!empty($_GET['msg']))    {
                $msg = $_GET['msg'];
                echo $msg;
            }
        ?>
        <table class="tb-admin" width="100%">
          <tr>
            <th width="5%">ID</th>
            <th width="20%">Tên bài viết</th>
            <th width="25%">Nội dung</th>
            <th width="10%">Người đăng</th>
            <th width="10%">Email</th>
            <th width="10%">Ngày đăng</th>
            <th width="10%">ID Cha</th>
            <th width="10%">Chức năng</th>
          </tr>
        <?php 
            $offset = ($currentPage-1) * $rowCount;
                $query = "SELECT comments.*, news.name FROM comments 
                INNER JOIN news ON news.id=comments.news_id
                ORDER BY id DESC LIMIT {$offset},{$rowCount}";
                $result = $mySQLI->query($query);
                while($arCmt = mysqli_fetch_assoc($result)) {
                    $idCmt = $arCmt['id'];
                    $nameNew = $arCmt['name'];
                    $idParent = $arCmt['parent_id'];
                    $username = $arCmt['name_create'];
                    $email = $arCmt['email'];
                    $content = $arCmt['content'];
                    $ngayDang = $arCmt['date_create']
            ?>
          <tr>
            <td><?php echo $idCmt ?></td>
            <td><?php echo $nameNew ?></td>
            <td><?php echo $content ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $ngayDang ?></td>
            <td><?php echo $idParent ?></td>
            <td>
              <a href="del.php?idCmt=<?php echo $idCmt ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tin ?');" ><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
            </td>
          </tr>
        <?php } ?>
        </table>
        <div class="pagination">           
          <div class="numbers">
            <span>Trang:</span> 
            <?php
              for($i = 1; $i <= $pageCount; $i++) {
                $current = "";
                if($i == $currentPage) {
                  $current = 'current';
                }
            ?>
            <a href="index.php?idpage=<?php echo $i?>" class="<?php echo $current?>"><?php echo $i ?></a> 
            <span>|</span> 
            <?php } ?>   
          </div> 
          <div style="clear: both;"></div> 
        </div>
      </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>