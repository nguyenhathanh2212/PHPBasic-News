<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/checkuser.php" ?>
    <!--content-->
    <div class="content">
        <h2 class="tit"><i class="fa fa-shopping-cart"></i>  Thêm danh mục</h2>
        <?php 
            if($_SESSION['arUser']['active'] != 1) {
                header("location:index.php");
            }
            if(isset($_POST['add'])){
                $tenCat = $_POST['ten'];
                $queryCat = "SELECT * FROM cat_list";
                $resultCat = $mySQLI->query($queryCat);
                $checkExist = 0;
                while($arCat = mysqli_fetch_array($resultCat)) {
                   $nameCat = $arCat['name'];
                   if($tenCat == $nameCat){
                    $checkExist = 1;
                    break;
                    }
                }
                if($checkExist == 1) {
                    echo "<span style='padding-left:50px;color:red;'>Tên danh mục đã tồn tại !</span>";
                } else {
                    $idDanhMucCha = $_POST['danhmuc'];
                    $query = "INSERT INTO cat_list(name,parent_id)
                    VALUES ('{$tenCat}',{$idDanhMucCha})";
                    if($mySQLI->query($query)) {
                        header("location:index.php?msg=Thêm thành công");
                    } else {
                        header("location:index.php?msg=Thêm thât bại");
                    }
                }
            }
        ?>
    <form method="post" action="" class="form-addcat">
        <label class="left-login">Tên danh mục : (*)</label>
        <div class="right-login">
            <input class="input-right" type="text" name="ten">
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
                        while ($arDM = mysqli_fetch_assoc($resuitDM)) {
                            $idDM = $arDM['id'];
                            $tenDM = $arDM['name'];
                    ?>
                            <option value="<?php echo $idDM?>"><?php echo $tenDM?></option>
                    <?php } ?>
                </select>
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
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/templates/admin/inc/footer.php" ?>