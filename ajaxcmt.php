<?php require_once $_SERVER['DOCUMENT_ROOT'].'/functions/dbconnect.php'; ?>
<?php
	$id = $_POST['aid'];
	$hoten = $_POST['ahoten'];
	$email = $_POST['aemail'];
	$content = $_POST['acontent'];
	$date = date('Y').'-'.date('m').'-'.date('d').' '.date('H').':'.date('i').':'.date('s');
	$hour = date('H').':'.date('i').":".date('s');
	$day = date('d').'-'.date('m')."-".date('Y');
    $parent_id = 0;
    $queryAddCmt = "INSERT INTO comments(content,email,name_create,date_create,parent_id,news_id)
    VALUES ('{$content}','{$email}','{$hoten}','{$date}',{$parent_id},{$id})";
    $resultAddCmt = $mySQLI->query($queryAddCmt);
    echo "<li class='li-list-cmt'>";
    echo "<h4>{$hoten}</h4>";
    echo "<div  class='detail-cmt'>";
    echo "<span>{$hour}</span> | <span>{$day}</span> | <span>{$email}</span>";
    echo "</div>";                
    echo "<p>{$content}</p>";
    echo "</li>";

?>