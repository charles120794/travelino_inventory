@push('scripts')

<script type="text/javascript">
	
	$('#btn_edit').on('click',function(){
		if($(this).is(':checked')){
			$('#btn_save').removeClass('hide');
			$('.info-text').hide();
			$('.info-input').show().css('border-color','darkgreen');
			$('.info-input')[0].focus();
		}else{
			$('#btn_save').addClass('hide');
			$('.info-text').show();
			$('.info-input').hide();
		}
	});

	function updateStatus(id,url){
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			$.get(url,{status:0},function(data){
				alert(data.message);
			});
		} else if($('#'+id).hasClass('fa-toggle-off')){
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			$.get(url,{status:1},function(data){
				alert(data.message);
			});
		}
	}

	function submitModalImageUpload()
	{
		if($.trim($('#media_image_path').val()) == "") {
			alert('Please select image first.')
		} else {
			$('#change_profile_image').val($('#media_image_path').val());
			$('#addimageupload').modal('hide');
			$('#form-update-profile-image').submit();
		}
	}

</script>

@endpush