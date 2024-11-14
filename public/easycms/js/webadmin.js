$(document).ready(function(){
	$(".check").on("click", function(){
		$.post(
				contUrl + 'checkBox', 
				{id:this.value, name:this.name, title:this.title, checked:this.checked}, 
				function(n){alert(n);}
			);
	});

	$(".delete").on("click", function(e){
		var rec_no = $(this).data('id');
		var to_delete = confirm(rec_no + " nolu kaydı silmek istediğinizden emin misiniz?");
		if ( ! to_delete)
		{
			e.preventDefault();
		}
	});

	$("#search_category_id").change(function()
		{
			var category_id = $(this).val();
			var subcategory_select = '<option value="">Lütfen bekleyiniz</option>';
			$("#search_subcategory_id").html(subcategory_select).load(site_url + 'webadmin/subcategory/select_options', {category_id:category_id});
		}
	);

	$("#category_id").change(function()
		{
			var category_id = $(this).val();
			var subcategory_select = '<option value="">Lütfen bekleyiniz</option>';
			$("#subcategory_id").html(subcategory_select).load(site_url + 'webadmin/subcategory/select_options', {category_id:category_id});
		}
	);

	$("#edit_content").validate({
		rules: {
			title: {required: true}
		},
		messages: {
			title: {required: 'Lütfen içerik adını yazınız.'}
		}
	});

	$('.save_button').on('click', function(e){
		e.preventDefault();
		var id = $(this).val();
		var language_id = $('#language_id_'+id).val();
		var subcategory_id = $('#subcategory_id_'+id).val();
		var name = $('#name_'+id).val();
		var old_name = $('#old_name_'+id).val();
		var summary = $('#summary_'+id).val();
		var text = $('#text_'+id).val();

		$.ajax({
			url: site_url+'webadmin/content/ajax_update',
			type: 'post',
			data: {
				id: id,
				language_id: language_id,
				subcategory_id: subcategory_id,
				name: name,
				old_name: old_name,
				summary: summary,
				text: text
			},
			success: function(r_data){
				alert(r_data);
			},
			error: function(xhr, status){
				alert('Hata! Kayıt işlemi gerçekleştirilemedi.');
			}
		});
	});
});
