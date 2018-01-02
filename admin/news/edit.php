<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
    <div class="content">
        <h2 class="tit"><i class="fa fa-shopping-cart"></i>  Sửa tin</h2>
        <?php
            if(!empty($_GET['idTin'])) {
                $idTin = $_GET['idTin'];
            } else {
                header("location:index.php");
            }
            $queryTin = "SELECT * FROM news WHERE id='{$idTin}'";
            $resultTin = $mySQLI->query($queryTin);
            $arTin = mysqli_fetch_assoc($resultTin);
            $tenTin = $arTin['name'];
            $idDanhMuc = $arTin['cat_id'];
            $hinhAnh = $arTin['picture'];
            $urlHinhAnh = '/files/'.$hinhAnh;
            $detail = $arTin['detail'];
            $preview = $arTin['preview'];
            $createBy = $arTin['created_by'];
            if($_SESSION['arUser']['username'] != 'admin' && $_SESSION['arUser']['id'] != $createBy) {
                header("location:index.php?msg=Bạn không có quyền sửa");
                die();
            }
        ?>
        <?php
            if(isset($_POST['edit'])) {
                $tenTinEdit = $_POST['ten'];
                $idDanhMucEdit = $_POST['danhmuc'];
                $hinhAnhEdit = $_FILES['picture']['name'];
                $detailEdit = $_POST['detail'];
                $previewEdit = $_POST['preview'];
                $xoaAnhCu = "";
                if(isset($_POST['xoaanh'])) {
                    $xoaAnhCu = $_POST['xoaanh'];
                }
                $query = "";
                if($hinhAnhEdit != '') {
                    unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$hinhAnh);
                    $arPic = explode(".", $hinhAnhEdit);
                    $endPic = end($arPic);
                    $newPicName = 'TDK-'.time().'.'.$endPic;
                    $path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$newPicName;
                    $tmp_name = $_FILES['picture']['tmp_name'];
                    move_uploaded_file($tmp_name,$path_upload);
                    $query = "UPDATE news SET name = '{$tenTinEdit}',cat_id = '{$idDanhMucEdit}',picture = '{$newPicName}',detail = '{$detailEdit}',preview = '{$previewEdit}' WHERE id = {$idTin}";
                } else {
                    if($hinhAnh != '' && $xoaAnhCu == "xoaanh") {
                        unlink($_SERVER['DOCUMENT_ROOT'].'/files/'.$hinhAnh);
                        $query = "UPDATE news SET name = '{$tenTinEdit}',cat_id = '{$idDanhMucEdit}',picture = '',detail = '{$detailEdit}',preview = '{$previewEdit}' WHERE id = {$idTin}";
                    } else {
                        $query = "UPDATE news SET name = '{$tenTinEdit}',cat_id = '{$idDanhMucEdit}',detail = '{$detailEdit}',preview = '{$previewEdit}' WHERE id = {$idTin}";
                    }
                }
                if($mySQLI->query($query)) {
                    header("location:index.php?msg=Sửa thành công");
                } else {
                    header("location:index.php?msg=Sửa thất bại");
                }
            }
        ?>
        <form method="post" action="" class="form-addtin" enctype="multipart/form-data">
                <label class="left-login">Tên : (*)</label>
                <div class="right-login">
                    <input class="input-right" type="text" name="ten" value="<?php echo $tenTin?>">
                    <br/ ><label for="ten" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Danh mục: (*)</label>
                <div class="right-login">
                    <select name="danhmuc" id="danhmuc" class="input-right">
                        <option value="" >--Chọn danh mục--</option>
                        <?php
                            $queryDM = "SELECT * FROM cat_list";
                            $resuitDM = $mySQLI->query($queryDM);
                            while($arDM = mysqli_fetch_assoc($resuitDM)) {
                                $idDM = $arDM['id'];
                                $tenDM = $arDM['name'];
                                $select = "";
                                if($idDanhMuc == $idDM) {
                                    $select = "selected";
                                }
                        ?>
                            <option <?php echo $select ?> value="<?php echo $idDM ?>"><?php echo $tenDM ?></option>
                        <?php }?>
                    </select>
                    <br/ ><label for="danhmuc" class="error"></label>
                </div>
                <div class="clr"></div>
                <?php if($hinhAnh != '') { ?>
                <label class="left-login">Old picture:</label>
                <div class="right-login">
                    <img src="<?php echo $urlHinhAnh ?>" style="height: 50px;">
                    <p><input type="checkbox" name="xoaanh" value="xoaanh"> Xóa ảnh củ</p>
                </div>
                <?php } ?>
                <div class="clr"></div>
                <label class="left-login">New picture:</label>
                <div class="right-login">
                    <input class="input-right" type="file" name="picture" >
                </div>
                <div class="clr"></div>
                <label class="left-login">Preview: (*)</label>
                <div class="right-login">
                    <textarea cols="80" type="text" name="preview"><?php echo $preview ?></textarea>
                    <br/ ><label for="preview" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login">Detail: (*)</label>
                <div class="right-login">
                    <textarea class="detail ckeditor" name="detail"><?php echo $detail ?></textarea>
                    <br/ ><label for="detail" class="error"></label>
                </div>
                <div class="clr"></div>
                <label class="left-login"></label>
                <div class="right-login">
                    <input type="submit" class="button" name="edit" value="Edit">
                </div>
                <div class="clr"></div>
        </form>
    </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>