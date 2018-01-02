<div class="lefter-bar col-sm-3">
    <div class="leftbar-boxnews">
        <h2>Bài viết mới</h3>
        <ul class="ul-new-news">
            <?php
                $queryHot = "SELECT * FROM news ORDER BY id DESC LIMIT 3";
                $resultHot = $mySQLI->query($queryHot);
                while($arHot = mysqli_fetch_assoc($resultHot)) {
                    $id = $arHot['id'];
                    $nameHot = $arHot['name'];
                    $picture = $arHot['picture'];
                    $urlPicture = "";
                    if($picture != '') {
                        $urlPicture = "/files/".$picture;
                    } else {
                        $urlPicture = "/files/news_default.jpg";
                    }
                    $urlNews = "/fullpost/".convertUtf8ToLatin($nameHot)."-".$id.".html";
            ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    var select = '';
                    var select2 = '';
                    $('.li-new-news').mouseover(function() {
                        select = $(this).children('.a-new-news').children('.leftbar-news-img').attr('class','leftbar-news-img w animated zoomIn');
                        select2 = $(this).children('.litle-new-news').children('.h4-news').attr('class','h4-news animated zoomIn');
                    });
                    $('.li-new-news').mouseleave(function() {
                        select.attr('class','leftbar-news-img');
                        select2.attr('class','h4-news');
                    });
                });
            </script>
            <li class="li-new-news">
                <a class="a-new-news" href="<?php echo $urlNews?>"><img class="leftbar-news-img" src="<?php echo $urlPicture; ?>"></a>
                <div class="litle-new-news">
                    <h4 class="h4-news"><a href="<?php echo $urlNews ?>"><?php echo $nameHot ?></a></h4>
                </div>
                <div class="cleaner"></div>
            </li>
            <?php } ?>
        </ul>
    </div>

    <div class="leftbar-boxnews">
        <h2>Danh mục</h3>
        <ul class="ul-cat-leftbar">
        <?php
            $queryDM = "SELECT * FROM cat_list WHERE parent_id = 0 ";
            $resultDM = $mySQLI->query($queryDM);
            while($arDM=mysqli_fetch_assoc($resultDM)) {
                $idDM = $arDM['id'];
                $nameDM = $arDM['name'];
                $idDMC = $arDM['parent_id'];
                $queryDM2 = "SELECT * FROM cat_list WHERE parent_id={$idDM}";
                $resultDM2 = $mySQLI->query($queryDM2);
                $arDM2 = mysqli_fetch_assoc($resultDM2);
                if(count($arDM2) == 0) {
                    $urlDM = "/category/".convertUtf8ToLatin($nameDM)."-".$idDM; 
        ?>
                <li class="li-cat-leftbar"><a class="a-li-cat" href="<?php echo $urlDM?>"><?php echo "$nameDM" ?></a></li>
        <?php } else { ?>
                <li class="li-cat-leftbar"><a class="a-li-cat" href="<?php echo $urlDM?>"><?php echo "$nameDM" ?></a>
                    <ul class="ul2-cat-leftbar">
                    <?php 
                        $resultDM2 = $mySQLI->query($queryDM2);
                        while($arDM2 = mysqli_fetch_assoc($resultDM2)) {
                            $idDM2 = $arDM2['id'];
                            $nameDM2 = $arDM2['name'];
                            $urlDM2 = "/category/".convertUtf8ToLatin($nameDM2)."-".$idDM2;
                    ?>  
                        <li class="li2-cat-leftbar"><a class="a-li-cat" href="<?php echo $urlDM2?>"><?php echo "$nameDM2";?></a></li>
                    <?php } ?>
                    </ul>
                </li>
        <?php   } 
            } ?>
        </ul>
    </div>
</div>