<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/defines.php" ?>
<?php
    $idUser =$_SESSION['arUser']['id'];
    $active = $_SESSION['arUser']['active'];
    if($active == 1) {
        $queryPage = "SELECT COUNT(id) AS sotin FROM news";
    } else {
        $queryPage = "SELECT COUNT(id) AS sotin FROM news WHERE created_by={$idUser}";
    }
    
    $resultPage = $mySQLI->query($queryPage);
    $arSoTin = mysqli_fetch_assoc($resultPage);
    $rowCount = ROW_COUNT_ADMIN;
    $pageCount = ceil($arSoTin['sotin']/$rowCount);
    $currentPage = 1;
    if(!empty($_GET['idpage'])) {
        $currentPage = $_GET['idpage'];
    }
?>  
    <!--content-->
    <div class="content ">
                <a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
                <?php
                    if(!empty($_GET['msg'])) {
                        echo $_GET['msg'];
                    }
                ?>
                <table width="100%"  class="tb-admin">
                    <tr>
                        <th width="3%">ID</th>
                        <th width="40%">Tên bài viết</th>
                        <th width="15%">Danh mục</th>
                        <th width="10%">Ngày tạo</th>
                        <th width="10%">Hình ảnh</th>
                        <?php if($_SESSION['arUser']['active'] == 1){ ?>
                        <th width="10%">Slide</th>
                        <?php } ?>
                        <th width="12%">Chức năng</th>
                    </tr>
                    <?php
                        $offset = ($currentPage-1)*$rowCount;
                        if($active==1) {
                            $queryTin = "SELECT news.*, cat_list.name AS name_cat FROM news INNER JOIN cat_list ON news.cat_id=cat_list.id ORDER BY news.id DESC LIMIT {$offset}, {$rowCount}";
                        } else {
                            $queryTin = "SELECT news.*,cat_list.name AS name_cat FROM news INNER JOIN cat_list ON news.cat_id = cat_list.id WHERE created_by = {$idUser} ORDER BY news.id DESC LIMIT {$offset}, {$rowCount}";
                        }
                        $resultTin = $mySQLI->query($queryTin);
                        while($arTin = mysqli_fetch_assoc($resultTin)) {
                            $idTin = $arTin['id'];
                            $tenTin = $arTin['name'];
                            $tenDanhmuc = $arTin['name_cat'];
                            $ngayDang = $arTin['date_create'];
                            $picture = $arTin['picture'];
                            $isSlide = $arTin['is_slide'];
                            $checkBox = "";
                            if($isSlide == 1) {
                                $checkBox = "checked";
                            }
                    ?>
                        <tr>
                            <td><?php echo $idTin;?></td>
                            <td><?php echo $tenTin;?></td>
                            <td><?php echo $tenDanhmuc;?></td>
                            <td><?php echo $ngayDang;?></td>
                            <td>
                                <?php 
                                    if($picture == '') { ?>
                                        <img style="height: 50px;" src="/files/news_default.jpg" class="hoa" />
                                <?php } else { ?>
                                        <img style="height: 50px;"  src="/files/<?php echo $picture?>" class="hoa" />
                                <?php } ?>
                            </td>
                            <?php if($_SESSION['arUser']['active'] == 1) { ?>
                            <td><?php echo "<input type='checkbox' {$checkBox} name='slide' class='slide' value='{$idTin}'/>";?></td>
                            <?php } ?>
                            <td >
                                <a href="edit.php?idTin=<?php echo $idTin?>" class="fa fa-pencil">Sửa</a> |
                                <a href="del.php?idTin=<?php echo $idTin?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tin ?');" class="fa fa-trash">Xóa</a>
                            </td>
                        </tr>   
                    <?php   } ?>
                </table>
                <?php if($pageCount > 1) { ?>
                <div class="pagination">           
                    <div class="numbers">
                        <span>Trang:</span> 
                        <?php
                            for($i = 1; $i <= $pageCount; $i++) {
                                $current="";
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
                <?php } ?>
    </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>