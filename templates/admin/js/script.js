$(document).ready(function() {
	CKFinder.setupCKEditor();
	$('.active').click(function(event) {
		var active=0;
		var id=$(this).val();
		if($(this).prop("checked") == true){
                active=1;
        }
		$.ajax({
			url: '/admin/users/ajax.php',
			type: 'POST',
			data: {
				act:active,
				aid:id,
			},
			success: function(value){
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
		});
	});
	$('.slide').click(function(event) {
		var slide=0;
		var id=$(this).val();
		if($(this).prop("checked") == true){
                slide=1;
        }
		$.ajax({
			url: '/admin/news/ajax.php',
			type: 'POST',
			data: {
				act:slide,
				aid:id,
			},
			success: function(value){
			},
			error: function (){
				alert('Có lỗi xảy ra');
			}
		});
	});
	jQuery.validator.setDefaults({
	  success: "valid",
	  ignore: [],
	  debug: false,
	});
	$(".form-adduser").validate({
		rules:{
			"username": {
				required: true,
				rangelength: [4, 32],
			},
			"password": {
				required: true,
				minlength: 6,
			},
			"repassword": {
				required: true,
				equalTo: "#password",
			},
			"email": {
				required: true,
				email: true,
			},
			"fullname": {
				required: true,
			},
		},
		messages:{
			"username": {
				required: "Vui lòng nhập tên đăng nhập !",
				rangelength: "Nhập trong phạm vi 4 - 32 kí tự",
			},
			"password": {
				required: "Vui lòng nhập mật khẩu đăng nhập !",
				rangelength: "Mật khẩu phải trên 6 kí tự !",
			},
			"repassword": {
				required: "Vui lòng xác nhân mật khẩu !",
				equalTo: "Mật khẩu xác nhận ko đúng !",
			},
			"email": {
				required: "Vui lòng nhập email !",
				email: "Vui lòng nhập đúng email !",
			},
			"fullname": {
				required: "Vui lòng nhập fullname !",
			},
		},
	}); 
	$(".form-edituser").validate({
		rules:{
			"username": {
				required: true,
				rangelength: [4, 32],
			},
			"password": {
				required: true,
			},
			"email": {
				required: true,
				email: true,
			},
			"fullname": {
				required: true,
			},
		},
		messages:{
			"username": {
				required: "Vui lòng nhập tên đăng nhập !",
				rangelength: "Nhập trong phạm vi 4 - 32 kí tự",
			},
			"password": {
				required: "Vui lòng xác nhận mật khẩu !",
			},
			"email": {
				required: "Vui lòng nhập email !",
				email: "Vui lòng nhập đúng email !",
			},
			"fullname": {
				required: "Vui lòng nhập fullname !",
			},
		},
	}); 
	$(".form-addtin").validate({
		rules:{
			"ten": {
				required:true,
			},
			"danhmuc": {
				required:true,
			},
			'detail': {
				required: function() {
                    CKEDITOR.instances.detail.updateElement();
                },
				minlenght:1,
			},
			"preview":{
				required:true,
			},
		},
		messages:{
			"ten": {
				required:"Vui lòng nhập tên tin rao bán!",
			},
			"danhmuc": {
				required:"Vui lòng chọn danh mục !",
			},
			"detail": {
				required:"Vui lòng nhập mô tả !",
				minlenght:"Vui lòng nhập mô tả !",
			},
			"preview":{
				required:"Vui lòng nhập preview !",
			}
		},
	}); 
	$(".form-addcat").validate({
		rules:{
			"ten": {
				required:true,
			},
		},
		messages:{
			"ten": {
				required:"Vui lòng nhập tên danh mục!",
			},
		},
	});
	$(".form-login").validate({
		rules:{
			"username": {
				required:true,
			},
			"password": {
				required:true,
			}
		},
		messages:{
			"username": {
				required:"Vui lòng nhập username !",
			},
			"password": {
				required:"Vui lòng nhập password !",
			}
		},
	});
});