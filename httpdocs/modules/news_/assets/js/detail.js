$(document).ready( function(){
//
	  $("#toc").toc({
      content: ".description",
      headings: "h1,h2,h3,h4"
    });
    $(".button-select").click(function() {
      $('.fa-angle-down').toggleClass('active');
      $('.title-toc .title').addClass('display');
      $('.mr-1').toggleClass('active');
      $('.list-toc').slideToggle();
    });

    $(window).scroll(function() {
      var scroll = $(window).scrollTop();

      if (scroll >= 700) {
        $("#left1").addClass("fixtoc");
        $('.fa-angle-down').removeClass('active');
        $('.tablecontent').removeClass('none');
        $(".fa-angle-down").addClass("none");
        $(".mr-1").addClass("none");

      }
      if (scroll < 700) {
        $("#left1").removeClass("fixtoc");
        $('.tablecontent').addClass('none');
        $('.fa-angle-down').removeClass('none');
        $(".mr-1").removeClass("none");
      }
    });

    $('#toc a').on('click', function(e) {
      e.preventDefault();
      let target = $(this).attr('href');
      target = target.replace(/\./g, '\\.');
      $('html, body').animate({
        'scrollTop': $(target).offset().top - 60
      }, 800);
    });
//	$('#resetbt').click(function(){
//		document.comment_add_form.reset();
//	});
	//submit_comment();
	//display_hidden_comment_form();
	// update hits
	setTimeout(function() {
		var news_id = $('#news_id').val();
		$.get("/index.php?module=news&view=news&task=update_hits&raw=1",{id: news_id}, function(status){
		});
	}, 3000);

//    $('#myTab a').click(function (e) {
//    	 e.preventDefault();
//    	 $(this).tab('show');
//    });
//    
//    $('.view-change').click(function () {
//    	 $('.view-change').hide();
//         $('#imgCaptcha').show();
//    });
});
	     
//function submit_comment()
//{
//	$('#submitbt').click(function(){
//		if(!notEmpty2("name",'Họ tên',"Bạn phải nhập họ tên"))
//		{
//			return false;
//		}
//		if(!notEmpty2("email",'Email',"Bạn phải nhập số email"))
//			return false;
//		if(!emailValidator("email","Email nhập không hợp lệ")){
//			return false;
//		}
//		if(!notEmpty2("text",'Nội dung',"Bạn phải nhập nội dung"))
//			return false;
//		if(!notEmpty2("txtCaptcha","Mã kiểm tra","Bạn phải nhập mã hiển thị"))
//			return false;
//		$.ajax({url: "/index.php?module=users&task=ajax_check_captcha&raw=1",
//			data: {txtCaptcha: $('#txtCaptcha').val()},
//			dataType: "text",
//			async: false,
//			success: function(result) {
//				$('label.username_check').prev().remove();
//				$('label.username_check').remove();
//				if(result == 0){
//					invalid('txtCaptcha','Bạn nhập sai mã hiển thị');
//					console.log('--------');
//					return false;
//				} else {
//					valid('txtCaptcha');
//					$('<br/><div class=\'label_success username_check\'>'+'Bạn đã nhập đúng mã hiển thị'+'</div>').insertAfter($('#username').parent().children(':last'));
//					console.log('+++');
//						$('.button_area').html('<a class="button " href="javascript: void(0)"><span>Gửi</span></a><a id="resetbt" class="button" href="javascript: void(0)"><span>Làm lại</span></a>');
//						document.comment_add_form.submit();
//					return true;
//				}
//			}
//		});
//	});
//}

/****** TREE COMMENTS ******/
//function submit_reply(comment_id){
//	if(!notEmpty2("name_"+comment_id,'Họ tên',"Bạn phải nhập họ tên")){
//		return false;
//	}
//	if(!notEmpty2('email_'+comment_id,'Email',"Bạn phải nhập số email"))
//		return false;
//	if(!notEmpty2('text_'+comment_id,'Nội dung','Bạn phải nhập nội dung')){
//		return false;
//	}
//	$('#comment_reply_form_'+comment_id).submit();
//} 
/****** end .TREE COMMENTS ******/