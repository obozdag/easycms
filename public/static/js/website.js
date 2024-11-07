$(function(){
	$('.zoom').colorbox({
		rel: "zoom",
		current:"{current}/{total}",
		previous:"<<",
		next:">>",
		close:"X",
		maxWidth:"90%"
	});

	$("#contactForm").validate({
		submitHandler:	function(){
			$("#contactForm").ajaxSubmit({
				target: '#ajaxFormResult',
				success: function(){$('#contactForm').clearForm();},
				error: function(){$('#ajaxFormResult').html('<span class="alert alert-danger">Error! Please try again later.</span>');}
			});
		},
		rules: {
			name: {required: true, minlength: 5},
			email: {required: true, email: true},
			hmessage: {required: true, minlength: 5}
		},
		messages: {
			name: {required: 'Please write your name.', minlength: 'At least 5 letters please!'},
			email: {required: 'Please write your email.', email: 'Please write a valid email address.'},
			hmessage: {required: 'Please write your message.', minlength: 'At least 5 letters please!'}
		}
	});
});
