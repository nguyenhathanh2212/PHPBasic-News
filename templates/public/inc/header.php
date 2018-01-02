<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/dbconnect.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/replace.php';
    ob_start();
    session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ShareIT- NNT</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<!--
Template 2060 Newspaper 
http://www.tooplate.com/view/2060-newspaper
-->
<link href="/templates/public/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/libraries/jquery-3.2.1.min.js"></script>
<link rel="shortcut icon" href="favicon.jpg" />
<script type="text/javascript" src="/libraries/bxslider/dist/jquery.bxslider.min.js"></script>
<link rel="stylesheet" type="text/css" href="/libraries/bxslider/dist/jquery.bxslider.min.css">
<link rel="stylesheet" type="text/css" href="/libraries/bootstrap-3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/libraries/font-awesome-4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="/libraries/jquery.validate.min.js"></script>
<script type="text/javascript" src="/libraries/bootstrap-3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/libraries/coolcarousel/jquery.carouFredSel-6.0.4-packed.js"></script>
<script type="text/javascript" src="/templates/public/js/script.js"></script>
<link rel="stylesheet" type="text/css" href="/libraries/animate.css">
<script type="text/javascript" src="/libraries/wow.min.js"></script>
</head>
<body>
    <div id="tooplate_wrapper" >
        <div id="tooplate_header">
            <div id="tooplate_menu" class="ddsmoothmenu ">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
                <br style="clear: left" />
            </div> <!-- end of tooplate_menu -->
        </div> <!-- END of tooplate_header -->
        <div class="header-mid row">
            <div class="left-header-mid col-sm-5">
                <a href="/"><img src="/templates/public/images/logo1.png" style="height: 60px;" /></a>
            </div>
            <div class="right-header-mid col-sm-7">
              <nav class="navbar navbar-default">
                <div class="container-fluid row">
                  <ul class="nav navbar-nav col-sm-8">
                     <?php
                        $queryDM = "SELECT * FROM cat_list WHERE parent_id = 0 LIMIT 4";
                        $resultDM = $mySQLI->query($queryDM);
                        while($arDM = mysqli_fetch_assoc($resultDM)) {
                            $idDM = $arDM['id'];
                            $nameDM = $arDM['name'];
                            $idDMC = $arDM['parent_id'];
                            $queryDM2 = "SELECT * FROM cat_list WHERE parent_id={$idDM}";
                            $resultDM2 = $mySQLI->query($queryDM2);
                            $arDM2 = mysqli_fetch_assoc($resultDM2);
                            if(count($arDM2) == 0) { 
                              $urlDM = "/category/".convertUtf8ToLatin($nameDM)."-".$idDM;
                            ?>
                            <li><a href="<?php echo $urlDM ?>"><?php echo "$nameDM" ?></a></li>
                            <?php } else { ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo "$nameDM" ?>
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                <?php 
                                    $resultDM2 = $mySQLI->query($queryDM2);
                                    while($arDM2 = mysqli_fetch_assoc($resultDM2)) {
                                        $idDM2 = $arDM2['id'];
                                        $nameDM2 = $arDM2['name'];
                                        $urlDM2 = "/category/".convertUtf8ToLatin($nameDM2)."-".$idDM2;
                                ?>  
                                <li><a href="<?php echo $urlDM2?>"><?php echo "$nameDM2" ?></a></li>
                                <?php } ?>
                                </ul>
                            </li>
                            <?php } 
                            } ?>
                  </ul>
                  <?php 
                    if(isset($_POST['submit'])) {
                        $text = $_POST['search'];
                        $url = "/search/".convertUtf8ToLatin($text);
                        header("location:{$url}");
                    }
                  ?>
                    <form action="" method="post" class="navbar-form navbar-left col-sm-4" style="padding-left: 5px !important;padding-right: 5px !important;    width: 224px;">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit" style="height: 34px;">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

              </nav>
            </div>
        </div>
    