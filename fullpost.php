<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php' ?>   
    <div id="tooplate_main">
        <div class="content row">
            <div class="col-sm-9">
            <div class="post">
            <?php 
                if(!empty($_GET['idNews'])) {
                    $idNews = $_GET['idNews'];
                } else {
                    header("location:/");
                }
                $query = "SELECT news.*,cat_list.id AS id_Cat,cat_list.name AS name_cat,users.fullname AS fullname FROM news 
                INNER JOIN cat_list ON news.cat_id=cat_list.id 
                INNER JOIN users ON users.id=news.created_by
                WHERE news.id={$idNews}";
                $result = $mySQLI->query($query);
                $arNews = mysqli_fetch_assoc($result);
                $id = $arNews['id'];
                $name = $arNews['name'];
                $preview = $arNews['preview'];
                $picture = $arNews['picture'];
                $urlPicture = "/files/news_default.jpg";
                if($picture != "") {
                    $urlPicture = "/files/".$picture;
                }
                $detail = $arNews['detail'];
                $dateCreate = $arNews['date_create'];
                $dateCreate = date("d/m/Y ",strtotime($dateCreate));
                $user = $arNews['fullname'];
                $danhMuc = $arNews['name_cat'];
                $idDanhMuc = $arNews['id_Cat'];
                $luotxem = $arNews['luotxem'];
            ?>
            <h2 style="color: blue;"><?php echo $name ?></h2>
                    
            <div class="meta">
                <span class="admin"><?php echo $user ?></span>
                <span class="date"><?php echo $dateCreate ?></span>
                <span class="tag"><a href="#"><?php echo $danhMuc ?></a></span>
                <span style="font-size: 12px;"><i class="fa fa-eye" aria-hidden="true"></i>  <?php echo $luotxem ?></span> <span><!-- ADDTHIS BUTTON BEGIN -->
                    <script type="text/javascript">
                        var addthis_config = {
                             pubid: "YOUR-PROFILE-ID"
                        }
                    </script>
                     
                    <a href="http://www.addthis.com/bookmark.php?v=250" 
                        class="addthis_button"><img style="margin-bottom: 0px !important" 
                        src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" 
                        width="125" height="16" border="0" alt="Share" /></a>
                     
                    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
                    <!-- ADDTHIS BUTTON END --></span>
                <?php
                    $luotxem += 1;
                    $queryLX = "UPDATE news SET luotxem={$luotxem} WHERE id={$idNews}";
                    $mySQLI->query($queryLX);
                ?>
                <div class="cleaner"></div>
            </div> 
            <p style="font-weight: bold;color: #c51919;"><?php echo $preview ?></p>
            <img style="width: 800px;" src="<?php echo $urlPicture ?>" alt="" />   
            
            <p><?php echo $detail ?></p>
</div>
<div>
    <div class="newscol">
                    <div class="slide-noibat">
                      <div id="wrapper-noibat" style="box-shadow:none;">
                        <div id="carousel">
                          <?php
                            $queryHot = "SELECT * FROM news WHERE cat_id={$idDanhMuc} AND id != {$id} ORDER BY id DESC LIMIT 5";
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
                                $urlNewsHot = "/fullpost/".convertUtf8ToLatin($nameHot)."-".$id.".html";
                        ?>
                          <div class="item-carousel">
                            <a class="link-carousel" href="<?php echo $urlNewsHot?>">
                              <img class="img-carousel" src="<?php echo $urlPicture?>" alt="dakar"/>
                            </a>
                            <h4 class="title-carousel"><a href="<?php echo $urlNewsHot?>"><?php echo $nameHot ?></a></h4>
                          </div>
                        <?php } ?>
                        </div>
                      <a id="prev-noibat" href="#"></a>
                      <a id="next-noibat" href="#"></a>
                      </div>
                    </div>
                    <script type="text/javascript">
                      $(function() {
 
                        $('#carousel').carouFredSel({
                          width: '100%',
                          auto: {
                            items: 1
                          },
                          prev: '#prev-noibat',
                          next: '#next-noibat'
                        });
                       
                      });
                    </script>
                    
                    
                </div>
                </div>
        
           <div class="cleaner h40"></div>
        <div class="comments-tdk">
            <h2 class="title-cmt">Viết bình luận</h2>
            <form id="<?php echo $idNews?>" action="" method="POST" class="form-cmt" >
                <div class="row infor-cmt">
                    <div class="col-sm-6">
                        <input type="text" name="hoten" id="hoten-sub" class="infor" placeholder="Nhập họ tên">
                    </div>
                    <div class="col-sm-6">
                        <input type="email" name="email" id="email-sub" class="infor" placeholder="Nhập email">
                    </div>
                </div>
                <textarea class="content-cmt" name="content" placeholder="Viết nội dung bình luận"></textarea>
                <input type="submit" name="submit" class="submit-cmt sub" value="Gửi" />
            </form>
        </div>
        <!-- //list bình luận -->
        <div class="list-cmt">
            <ul class="ul-list-cmt">
                <?php
                    $queryCmt = "SELECT * FROM comments WHERE news_id={$idNews} and parent_id=0 ORDER BY date_create DESC ";
                    $resultCmt = $mySQLI->query($queryCmt);
                    while($arCmt = mysqli_fetch_assoc($resultCmt)) {
                        $idCmt = $arCmt['id'];
                        $contentCmt = $arCmt['content'];
                        $dateCreateCmt = $arCmt['date_create'];
                        $dayCreateCmt = date("d/m/Y",strtotime($dateCreateCmt));
                        $hourCreateCmt = date("H:i:s",strtotime($dateCreateCmt));
                        $nameCreate = $arCmt['name_create'];
                        $email =$arCmt['email'];
                    ?>
                <li class="li-list-cmt">
                    <h4><?php echo $nameCreate?></h4>
                    <div class="detail-cmt">
                        <span><?php echo $hourCreateCmt?></span> | <span><?php echo $dayCreateCmt?></span> | <span><?php echo $email?></span>
                    </div>
                    <p><?php echo $contentCmt ?></p>
                    <a href="#" class="btn-reply-cmt">Reply</a>
                    <div class="comments-tdk comments-tdk-c2" >
                        <form class="<?php echo $idNews?> form-cmt" id="<?php echo $idCmt?>">
                            <div class="row infor-cmt2" >
                                <div class="col-sm-6">
                                    <input type="text" name="hoten" class="infor hoten2" placeholder="Nhập họ tên">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="infor email2" placeholder="Nhập email">
                                </div>
                            </div>
                            <textarea class="content-cmt content-cmt-c2" name="content" placeholder="Viết nội dung bình luận"></textarea>
                            <input type="submit" name="submit" class="submit-cmt sub2" value="Reply" />
                        </form>
                        <ul class="ul-list-cmt ul-list-cmt-c2">
                            <?php
                                $queryCmt2 = "SELECT * FROM comments WHERE parent_id = {$idCmt} ORDER BY date_create DESC";
                                $resultCmt2 = $mySQLI->query($queryCmt2);
                                $arCmt2 = mysqli_fetch_assoc($resultCmt2);
                                if(count($arCmt2) != 0) {
                                $resultCmt2 = $mySQLI->query($queryCmt2);
                                while($arCmt2 = mysqli_fetch_assoc($resultCmt2)) {
                                    $idCmt2 = $arCmt2['id'];
                                    $contentCmt2 = $arCmt2['content'];
                                    $dateCreateCmt2 = $arCmt2['date_create'];
                                    $dayCreateCmt2 = date("d/m/Y",strtotime($dateCreateCmt2));
                                    $hourCreateCmt2 = date("H:i:s",strtotime($dateCreateCmt2));
                                    $nameCreate2 = $arCmt2['name_create'];
                                    $email2 = $arCmt2['email'];
                                ?>
                            <li class="li-list-cmt li-list-cmt-c2">
                                <h4><?php echo $nameCreate2?></h4>
                                <div class="detail-cmt">
                                    <span><?php echo $hourCreateCmt2?></span> | <span><?php echo $dayCreateCmt2?></span> | <span><?php echo $email2?></span>
                                </div>
                                <p><?php echo $contentCmt2 ?></p>
                            </li>
                            <?php } } ?>
                        </ul>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>

        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right-bar.php' ?>            
        
       
        <div class="cleaner"></div>
    </div> <!-- END of tooplate_main -->   
    
</div> <!-- END of tooplate_wrapper -->

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php' ?>