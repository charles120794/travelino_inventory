@push('scripts')

<script type="text/javascript">

	$(document).ready(function(){

		$('.users-company-access-datatables').DataTable({
			autoWidth: false,
		});

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
			console.log($('#form-update-profile-image').submit())
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
		    url : $('#form_search_users_company').attr('action'),
		    data: $('#form_search_users_company').serialize(),
		    method : 'post',
		    cache: false,
		    processData: false,
		    success : function(data) {
		    	$('#form_users_company').html(data);
		    }
		});
	}

	function updateUsersCompany() {
	    $.ajax({
	        url : $('#form_update_users_company').attr('action'),
	        data: $('#form_update_users_company').serialize(),
	        method : 'post',
	        cache: false,
	        processData: false,
	        success : function(data) {
	        	alert('Successfully Updated.');
	        }
	    });
	}

</script>

@endpush