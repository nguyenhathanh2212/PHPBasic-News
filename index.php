<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php' ?>
    <div class=" content row">
        <div id="tooplate_main" class="col-sm-9">
            <div id="slider-wrapper">
                <ul class="bxslider" class="nivoSlider">
                  
                  <?php 
                    $queryNewsSlide = "SELECT * FROM news WHERE is_slide=1";
                    $resuilNewsSlide = $mySQLI->query($queryNewsSlide);
                    while($arNewsSlide = mysqli_fetch_assoc($resuilNewsSlide)) {
                      $idNewsSlide = $arNewsSlide['id'];
                      $nameNewsSlide = $arNewsSlide['name'];
                      $previewNewsSlide = $arNewsSlide['preview'];
                      $pictureNewsSlide = $arNewsSlide['picture'];
                      $urlPicture = "";
                      if($pictureNewsSlide == '') {
                        $urlPicture = "/files/news_default.jpg";
                      } else {
                        $urlPicture = "/files/".$pictureNewsSlide;
                      }
                      $urlNews = "/fullpost/".convertUtf8ToLatin($nameNewsSlide)."-".$idNewsSlide.".html";
                  ?>
                  <li class="slide-main">
                    <a href="<?php echo $urlNews ?>">
                      <img class="img-slider" src="<?php echo $urlPicture?>" /></a>
                      <div class="slide-title">
                        <h3><a href="<?php echo $urlNews ?>"><?php echo $nameNewsSlide ?></a></h3>
                        <p><?php echo $previewNewsSlide ?></p>
                      </div>
                  </li>
                  <?php } ?>
                </ul>            
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(function(){
                      $('.bxslider').bxSlider({
                          auto: true,
                          autoControls: true,
                          stopAutoOnClick: true,
                          pager: true,
                          slideWidth: 900,
                        });
                    });
                });
            </script>
            <div class="cleaner"></div>
            <div class="noi-bat wow fadeInUp">
              <div class="newscol ">
                    <h2><a class="" href=""><i class="icon-cat fa fa-asterisk" aria-hidden="true"></i>Nổi bật</a></h2>
                    <div class="slide-noibat">
                      <div id="wrapper-noibat">
                        <div id="carousel">
                          <?php
                            $queryHot = "SELECT * FROM news ORDER BY luotxem DESC LIMIT 6";
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
                          <div class="item-carousel">
                            <a class="link-carousel" href="<?php echo $urlNews?>">
                              <img class="img-carousel" src="<?php echo $urlPicture?>" alt="dakar"/>
                            </a>
                            <h4 class="title-carousel"><a href="<?php echo $urlNews?>"><?php echo $nameHot ?></a></h4>
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
            <script type="text/javascript">
              new WOW().init();
            </script>
            <div class="cleaner "></div>
            <div class="newscol col half wow fadeInUp">
                <h2><a href="<?php echo '/category/dao-tao-1' ?>" ><i class="icon-cat fa fa-book" aria-hidden="true"></i>Đào tạo</a></h2>
                <?php
                  $queryNewsDM = "SELECT * FROM news WHERE cat_id=1 LIMIT 3";
                  $resulNewsDM = $mySQLI->query($queryNewsDM);
                  while($arNewsDM = mysqli_fetch_assoc($resulNewsDM)) {
                    $idNewsDM = $arNewsDM['id'];
                    $nameNewsDM = $arNewsDM['name'];
                    $previewNewsDM = $arNewsDM['preview'];
                    $pictureNewsDM = $arNewsDM['picture'];
                    $urlPictureNewsDM = "";
                    if($pictureNewsDM == '') {
                     $urlPictureNewsDM = "/files/news_default.jpg";
                    } else {
                     $urlPictureNewsDM = "/files/".$pictureNewsDM;
                    }
                    $urlNews = "/fullpost/".convertUtf8ToLatin($nameNewsDM)."-".$idNewsDM.".html";
                    ?>
                    <script type="text/javascript">
                      jQuery(document).ready(function($) {
                        $('.newsbox').mouseover(function(event) {
                          $(this).children('.news-left').children('.img-news').attr('class','img-news animated bounceIn');
                        });
                        $('.newsbox').mouseleave(function(event) {
                          $(this).children('.news-left').children('.img-news').attr('class','img-news');
                        });
                      });
                    </script>
                      <div class="newsbox col one_fourth">
                          <a class="news-left" href="<?php echo $urlNews?>"><img class="img-news" src="<?php echo $urlPictureNewsDM?>" alt="image" /></a>
                          <div class="news-right">
                          <h4 class="h3-news"><a href="<?php echo $urlNews?>"><?php echo $nameNewsDM ?></a></h6>
                          <p><?php echo $previewNewsDM ?></p>
                          </div>
                        <div class="cleaner"></div>
                      </div>

                    <?php 
                  }
                ?>
            </div>
            
            <div class="newscol col half no_margin_right  wow fadeInUp" data-wow-delay="0.5s">
                <h2><a href="<?php echo '/category/cong-nghe-2' ?>"><i class="icon-cat fa fa-object-ungroup" aria-hidden="true"></i>Công nghệ</a></h2>
                <?php
                  $queryNewsDM = "SELECT * FROM news WHERE cat_id=2 LIMIT 3";
                  $resulNewsDM = $mySQLI->query($queryNewsDM);
                  while($arNewsDM = mysqli_fetch_assoc($resulNewsDM)) {
                    $idNewsDM = $arNewsDM['id'];
                    $nameNewsDM = $arNewsDM['name'];
                    $previewNewsDM = $arNewsDM['preview'];
                    $pictureNewsDM = $arNewsDM['picture'];
                    $urlPictureNewsDM = "";
                    if($pictureNewsDM == '') {
                     $urlPictureNewsDM = "/files/news_default.jpg";
                    } else {
                     $urlPictureNewsDM = "/files/".$pictureNewsDM;
                    }
                    $urlNews = "/fullpost/".convertUtf8ToLatin($nameNewsDM)."-".$idNewsDM.".html";
                    ?>
                      <div class="newsbox col one_fourth">
                          <a class="news-left" href="<?php echo $urlNews?>"><img class="img-news" src="<?php echo $urlPictureNewsDM?>" alt="image" /></a>
                          <div class="news-right">
                          <h4 class="h3-news"><a href="<?php echo $urlNews?>"><?php echo $nameNewsDM ?></a></h6>
                          <p><?php echo $previewNewsDM ?></p>
                          </div>
                        <div class="cleaner"></div>
                      </div>

                    <?php 
                  }
                ?>
            </div>
            
            <div class="newscol col half wow fadeInUp">
                <h2><a href="<?php echo '/category/Lap-trinh-3' ?>"><i class="icon-cat fa fa-desktop" aria-hidden="true"></i>Lập trình</a></h2>
                <?php
                  $queryNewsDM = "SELECT news.*,cat_list.parent_id AS parent_id FROM news INNER JOIN
                  cat_list ON news.cat_id=cat_list.id WHERE cat_id=3 OR parent_id=3 LIMIT 3";
                  $resulNewsDM = $mySQLI->query($queryNewsDM);
                  while($arNewsDM = mysqli_fetch_assoc($resulNewsDM)){
                    $idNewsDM = $arNewsDM['id'];
                    $nameNewsDM = $arNewsDM['name'];
                    $previewNewsDM = $arNewsDM['preview'];
                    $pictureNewsDM = $arNewsDM['picture'];
                    $urlPictureNewsDM = "";
                    if($pictureNewsDM == '') {
                     $urlPictureNewsDM = "/files/news_default.jpg";
                    } else {
                     $urlPictureNewsDM="/files/".$pictureNewsDM;
                    }
                    $urlNews = "/fullpost/".convertUtf8ToLatin($nameNewsDM)."-".$idNewsDM.".html";
                    ?>
                      <div class="newsbox col one_fourth">
                          <a class="news-left" href="<?php echo $urlNews?>"><img class="img-news" src="<?php echo $urlPictureNewsDM?>" alt="image" /></a>
                          <div class="news-right">
                          <h4 class="h3-news"><a href="<?php echo $urlNews?>"><?php echo $nameNewsDM ?></a></h6>
                          <p><?php echo $previewNewsDM ?></p>
                          </div>
                        <div class="cleaner"></div>
                      </div>

                    <?php 
                  }
                ?>
            </div>
            
            <div class="newscol col half no_margin_right wow fadeInUp" data-wow-delay="0.5s">
                <h2><a href="<?php echo '/category/web-design-7' ?>"><i class="icon-cat fa fa-pencil" aria-hidden="true"></i>Web - Design</a></h2>
                <?php
                  $queryNewsDM = "SELECT * FROM news WHERE cat_id=7 LIMIT 3";
                  $resulNewsDM = $mySQLI->query($queryNewsDM);
                  while($arNewsDM = mysqli_fetch_assoc($resulNewsDM)) {
                    $idNewsDM = $arNewsDM['id'];
                    $nameNewsDM = $arNewsDM['name'];
                    $previewNewsDM = $arNewsDM['preview'];
                    $pictureNewsDM = $arNewsDM['picture'];
                    $urlPictureNewsDM = "";
                    if($pictureNewsDM == '') {
                     $urlPictureNewsDM = "/files/news_default.jpg";
                    } else {
                     $urlPictureNewsDM = "/files/".$pictureNewsDM;
                    }
                    $urlNews = "/fullpost/".convertUtf8ToLatin($nameNewsDM)."-".$idNewsDM.".html";
                    ?>
                      <div class="newsbox col one_fourth">
                          <a class="news-left" href="<?php echo $urlNews?>"><img class="img-news" src="<?php echo $urlPictureNewsDM?>" alt="image" /></a>
                          <div class="news-right">
                          <h4 class="h3-news"><a href="<?php echo $urlNews?>"><?php echo $nameNewsDM ?></a></h6>
                          <p><?php echo $previewNewsDM ?></p>
                          </div>
                        <div class="cleaner"></div>
                      </div>

                    <?php 
                  }
                ?>
            </div>

            <div class="cleaner"></div>
        </div> <!-- END of tooplate_main -->
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right-bar.php' ?>
    </div>   
    
</div> <!-- END of tooplate_wrapper -->

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php' ?>