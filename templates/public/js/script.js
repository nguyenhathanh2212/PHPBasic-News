$(document).ready(function() {
	
	$('.btn-reply-cmt').click(function() {
		var show=$(this).next(".comments-tdk-c2");
		if($(show).is(':visible')){
			$(show).slideUp();
		}
		else {
			$(show).slideDown();
		}
		return false;
	});
	$('.sub').click(function(event) {
		var id=$(this).parent('form').attr('id');
		var content=$(this).parent('form').children('.content-cmt').val();
		var email=$(this).parent('form').children('.infor-cmt').children('div').children('#email-sub').val();
		var hoten=$(this).parent('form').children('.infor-cmt').children('div').children('#hoten-sub').val();
		if(hoten!=''&&email!=''&&content!=''){
			$.ajax({
				url: '/ajaxcmt.php',
				type: 'POST',
				data: {
					aid:id,
					acontent:content,
					ahoten:hoten,
					aemail:email,
				},
				success: function(value){
					$(".ul-list-cmt").prepend(value);
				},
				error: function (){
					alert('Có lỗi xảy ra');
				}
			});
		}else{
			alert("Điền đủ thông tin bình luận ");
		}
		
		return false;
	});
	$('.sub2').click(function(event) {
		var id=$(this).parent('form').attr('class');
		var idparent=$(this).parent('form').attr('id');
		var content=$(this).parent('form').children('.content-cmt-c2').val();
		var hoten=$(this).parent('form').children('.infor-cmt2').children('div').children('.hoten2').val();
		var email=$(this).parent('form').children('.infor-cmt2').children('div').children('.email2').val();
		if(hoten!=''&&email!=''&&content!=''){
		$.ajax({
			url: '/ajaxcmt2.php',
			type: 'POST',
			data: {
				aid:id,
				aidparent:idparent,
				acontent:content,
				ahoten:hoten,
				aemail:email,
			},
			success: function(value){
				$(".ul-list-cmt-c2").prepend(value);
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
		});}else{
			alert("Điền đủ thông tin bình luận ");
		}
		return false;
	});

	
});