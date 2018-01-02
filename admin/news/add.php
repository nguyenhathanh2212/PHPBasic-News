<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
    <div class="content">
            <h2 class="tit"><i class="fa fa-shopping-cart"></i>  Thêm tin</h2>
            <?php 
                if(isset($_POST['add'])) {
                    $tenTin = $_POST['ten'];
                    $idDanhMuc = $_POST['danhmuc'];
                    $preview = $_POST['preview'];
                    $picture = $_FILES['picture']['name'];
                    $moTa = $_POST['detail'];
                    $idUser = $_SESSION['arUser']['id'];
                    //xu lý ảnh
                    if($picture == "") {
                        $newPicName = '';
                    } else {
                        $arPic = explode(".", $picture);
                        $endPic = end($arPic);
                        $newPicName = 'TDK-'.time().'.'.$endPic;
                        $path_upload = $_SERVER['DOCUMENT_ROOT'].'/files/'.$newPicName;
                        $tmp_name = $_FILES['picture']['tmp_name'];
                        move_uploaded_file($tmp_name,$path_upload);
                    }
                    //xử lý lấy ngày tháng hiện tại
                    $date = date("Y").'-'.date("m").'-'.date("d").' '.date("H").':'.date("m").':'.date("s");
                    $query = "INSERT INTO news(name,preview,detail,date_create,created_by,picture,cat_id,is_slide)
                    VALUES ('{$tenTin}','{$preview}','{$moTa}','{$date}',{$idUser},'{$newPicName}','{$idDanhMuc}',0)";
                    if($mySQLI->query($query)) {
                        header("location:index.php?msg=Thêm thành công");
                    } else {
                        header("location:index.php?msg=Thêm thât bại");
                    }
                }
            ?>
            <form method="post" action="" class="form-addtin" enctype="multipart/form-data">
                    <label class="left-login">Tên : (*)</label>
                    <div class="right-login">
                        <input class="input-right" type="text" name="ten">
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
                            ?>
                                <option value="<?php echo $idDM?>"><?php echo $tenDM ?></option>
                            <?php } ?>
                        </select>
                        <br/ ><label for="danhmuc" class="error"></label>
                    </div>
                    <div class="clr"></div>
                    <label class="left-login">Picture: </label>
                    <div class="right-login">
                        <input class="input-right" type="file" name="picture">
                    </div>
                    <div class="clr"></div>
                    <label class="left-login">Preview: (*)</label>
                    <div class="right-login">
                        <textarea cols="80" type="text" name="preview"></textarea>
                        <br/ ><label for="preview" class="error"></label>
                    </div>
                    <div class="clr"></div>
                    <label class="left-login">Detail: (*)</label>
                    <div class="right-login">
                        <textarea class="detail ckeditor" name="detail"></textarea>
                        <br/ ><label for="detail" class="error"></label>
                    </div>
                    <div class="clr"></div>
                    <label class="left-login"></label>
                    <div class="right-login">
                        <input type="submit" class="button" name="add" value="Add">
                    </div>
                    <div class="clr"></div>
            </form>
    </div>
<!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php" ?>