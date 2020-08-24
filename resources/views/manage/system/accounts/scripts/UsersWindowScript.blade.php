@push('scripts')

<script type="text/javascript">

	$(document).ready(function(){
		$('form[data-request="json"]').on('submit',function(e){
			e.preventDefault();
		});
		$('input, select, textarea').on('change',function(e){
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

	function selectedCompany(event, option = '') {
        $.ajax({
            url : '{{ route('accounts.route',['path' => $path, 'action' => 'search-users-company-module-json', 'id' => encrypt($thisUserAccount->users_id)]) }}',
            method : "post",
            data : { 'company_id' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
            	var option = '<option value=""> SELECT MODULE </option>';
                if(data.length > 0){
                	$.each( data, function(key,value) {
	                    option += '<option value="' + value.module_id + '">' + value.module_description + '</option>';
	                });
	                $('#module_id').attr('disabled',false);
	                $('#module_id').html(option);
                } else {
                	$('#module_id').attr('disabled',true);
                	$('#module_id').html(option);
                }
            }
        });
	}

    function submitFormSearch() {
		$.ajax({
		    method : "post",
		    url : $('#form_search_users_window').attr('action'),
		    data : $('#form_search_users_window').serialize(),
		    cache : false,
		    dataType : 'html',
		    processData : false,
		    success : function(data) {
		    	$('#form_users_window_access').html(data);
		    }
		});
    }

    function updateUsersWindow(event, option = '') {
        $.ajax({
            method : "post",
            url : $('#form_update_users_window').attr('action'),
            data : $('#form_update_users_window').serialize(),
            cache : false,
            processData : false,
            success : function(data) {
            	alert('Users Window Access successfully updated.');
            	submitFormSearch();
            }
        });
    }
</script>

@endpush