@push('scripts')

<script type="text/javascript">

	$(document).ready(function(){
		$('form[data-request="json"]').on('submit',function(e){
			e.preventDefault();
		});
		$('input,select,textarea').on('change',function(e){
			if($.trim($(this).val()) != "") {
	    		$(this).css('border-color','');
	    	}
	    });	
	});

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

	function submitFormSearch()
	{
		$.ajax({
			url : $('#form_search_company_users').attr('action'),
			data : $('#form_search_company_users').serialize(),
			method : 'post',
			dataType : 'html',
			success : function(data) {
				$('#form_company_users').html(data);
			} 
		});
	}

</script>

@endpush