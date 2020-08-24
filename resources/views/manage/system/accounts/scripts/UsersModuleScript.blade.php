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

	function selectAllCheckbox(event) {
		if($(event).attr('checked')) {
			$('.method-checkbox').prop('checked',false);
			$(event).removeAttr('checked');
			$(event).html('<i class="fa fa-square"></i> SELECT');
		} else {
			$('.method-checkbox').prop('checked',true);
			$(event).attr('checked',true);
			$(event).html('<i class="fa fa-check-square"></i> SELECT');
		}
	}

	function submitFormSearch() {
		$.ajax({
		    url : $('#form_search_users_module').attr('action'),
		    data : $('#form_search_users_module').serialize(),
		    method : "post",
		    cache : false,
		    processData : false,
		    success : function(data) {
		    	$('#form_users_module').html(data);
		    }
		});
	}

    function updateUsersModule() {
        $.ajax({
            url : $('#form_update_users_module').attr('action'),
            data : $('#form_update_users_module').serialize(),
            method : "post",
            cache : false,
            processData : false,
            success : function(data) {
            	alert('Users Module successfully updated.');
            	submitFormSearch();
            }
        });
    }

	function updateStatus(id,url){
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			$.get(url,{status:0},function(count){
				
			});
		} else if($('#'+id).hasClass('fa-toggle-off')){
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			$.get(url,{status:1},function(count){
				
			});
		}
	}

</script>

@endpush