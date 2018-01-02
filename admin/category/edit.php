<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
    <!--content-->
    <div class="content">
    <h2 class="tit"><i class="fa fa-shopping-cart"></i>  Sửa danh mục</h2>
    <?php 
        if(!empty($_GET['idCat']) && $_SESSION['arUser']['active'] == 1) {
            $idCat = $_GET['idCat'];
        } else {
            header("location:index.php");
            die();
        }
        $queryCat1 = "SELECT * FROM cat_list WHERE id='{$idCat}'";
        $resultCat1 = $mySQLI->query($queryCat1);
        $arCat1 = mysqli_fetch_assoc($resultCat1);
        $idDanhMuc = $arCat1['id'];
        $tenDanhMuc = $arCat1['name'];
        $idParent = $arCat1['parent_id'];

        if(isset($_POST['edit'])) {
            $tenCat = $_POST['ten'];
            $queryCat = "SELECT * FROM cat_list";
            $resultCat = $mySQLI->query($queryCat);
            $checkExist = 0;
            while($arCat=mysqli_fetch_array($resultCat)) {
                $nameCat = $arCat['name'];
                if($tenCat == $nameCat && $arCat['id'] != $idCat) {
                    $checkExist=1;
                    break;
                }
            }
            if($checkExist == 1) {
                echo "<span style='padding-left:50px;color:red;'>Tên danh mục đã tồn tại !</span>";
            }else {
                $idDanhMucCha = $_POST['danhmuc'];
                $query = "UPDATE cat_list SET name='{$tenCat}',parent_id={$idDanhMucCha}
                WHERE id={$idCat}";
                if($mySQLI->query($query)) {
                    header("location:index.php?msg=Sửa thành công");
                } else {
                    header("location:index.php?msg=Sửa thât bại");
                }
            }
        }
    ?>
    <form method="post" action="" class="form-addcat">
        <label class="left-login">Tên danh mục : (*)</label>
        <div class="right-login">
            <input class="input-right" type="text" name="ten" value="<?php echo $tenDanhMuc?>">
            <br/ ><label for="ten" class="error"></label>
        </div>
        <div class="clr"></div>
        <label class="left-login">Danh mục cha: </label>
        <div class="right-login">
            <select name="danhmuc" id="danhmuc" class="input-right">
                <option value="0" >Không có danh mục cha</option>
                <?php
                    $queryDM = "SELECT * FROM cat_list";
                    $resuitDM = $mySQLI->query($queryDM);
                    while($arDM = mysqli_fetch_assoc($resuitDM)) {
                        $idDM = $arDM['id'];
                        $tenDM = $arDM['name'];
                        $select = "";
                        if($idParent == $idDM){
                            $select = "selected";
                        }
                ?>
                        <option <?php echo $select;?> value="<?php echo $idDM?>"><?php echo $tenDM?></option>
                <?php } ?>
                </select>
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