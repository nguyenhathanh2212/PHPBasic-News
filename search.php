<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php' ?>  
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/defines.php" ?>
<?php
    if(!empty($_GET['txt'])) {
        $txt = $_GET['txt'];
        $txt = trim($txt);
	} else {
	    header("location:/");
	}
	$queryPage = "SELECT COUNT(id) AS sotin FROM news WHERE name LIKE '%{$txt}%'";
	$resultPage = $mySQLI->query($queryPage);
	$arSoTin = mysqli_fetch_assoc($resultPage);
	$rowCount = ROW_COUNT_CATEGORY;
	$pageCount = ceil($arSoTin['sotin']/$rowCount);
	$currentPage = 1;
	if(!empty($_GET['idpage'])) {
		$currentPage = $_GET['idpage'];
	}
?> 
    <div id="tooplate_main">
		<div class="content row">
            <div class="col-sm-9">
            	<div>
            		<h2 style="padding-left: 50px;display: inline-block; "><a style="color: #333;font-size: 22px;" href="/">Trang chủ</a></h2> / 
            		<h2 style="display: inline-block;"><a style="color: #333;font-size: 22px;" href="#">Search</a></h2>
            		<?php
            			if($arSoTin['sotin']==0){
		                	echo "<i>Không tìm thấy kết quả</i>";
		                }else{
		                	echo "<i>".$arSoTin['sotin']." kết quả được tìm thấy</i>";
		                }
            		?>
            	</div>
            	<?php
            		$offset = ($currentPage-1)*$rowCount;
	                $queryNewsCat = "SELECT news.*,users.fullname AS fullname FROM news INNER JOIN users
	                ON news.created_by=users.id WHERE news.name LIKE '%{$txt}%' LIMIT {$offset},{$rowCount}";
	                $resultNewsCat = $mySQLI->query($queryNewsCat);
	                while ($arNewsCat = mysqli_fetch_assoc($resultNewsCat)) {
	                	$idNewsCat = $arNewsCat['id'];
	                	$nameNewsCat = $arNewsCat['name'];
	                	$dateNewsCat = $arNewsCat['date_create'];
	                	$dateNewsCat = date("d/m/Y ",strtotime($dateNewsCat));
	                	$pictureNewsCat = $arNewsCat['picture'];
	                	$urlPictureNewsCat = "/files/".$pictureNewsCat;
	                	if($pictureNewsCat == '') {
	                		$urlPictureNewsCat = "/files/news_default.jpg";
	                	}
	                	$fullnameNewsCat = $arNewsCat['fullname'];
	                	$previewNewsCat = $arNewsCat['preview'];
	                	$luotxem = $arNewsCat['luotxem'];
              			$urlNews = "/fullpost/".convertUtf8ToLatin($nameNewsCat)."-".$idNewsCat.".html";
            	?>
        		<div class="item-news-cat">
		            <div class="img-item-cat">
		                <a href="<?php echo $urlNews?>"><img alt="" src="<?php echo $urlPictureNewsCat ?>"> 
		                </a>
		            </div>
		            <div class="title-item-cat">
		                <h2><a href="<?php echo $urlNews?>" title=""><?php echo$nameNewsCat ?></a></h2>
		                <span>Đăng ngày <?php echo $dateNewsCat ?></span> | <span>by <?php echo $fullnameNewsCat ?></span> | <span><i style="padding-right: 5px" class="fa fa-eye" aria-hidden="true"></i>  <?php echo $luotxem ?></span>
					</div>
		            <div class="preview-item-cat">
		                <p><?php echo $previewNewsCat ?></p>
		            </div>
		        </div>
        		<?php } ?>
        		<?php if($pageCount > 1) { ?>
        		<div class="pagination">           
					<div class="numbers">
						<span>Trang:</span> 
						<?php
							for($i = 1; $i <= $pageCount; $i++) {
								$current = "";
								if($i == $currentPage) {
									$current = 'current';
								}
								$url = "/search/".convertUtf8ToLatin($txt)."-p".$i;
						?>
						<a href="<?php echo $url ?>" class="<?php echo $current ?>"><?php echo $i?></a> 
						<span>|</span> 
						<?php } ?>   
					</div> 
					<div style="clear: both;"></div> 
		 		</div>
		 		<?php } ?>
            </div>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right-bar.php' ?>
            <div class="cleaner"></div>
	</div> <!-- END of tooplate_main -->   
    
</div> <!-- END of tooplate_wrapper -->

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php' ?>