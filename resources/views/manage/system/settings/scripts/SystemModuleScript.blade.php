@push('scripts')

<script type="text/javascript">

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

	function selectModule(event, option = '') {
	    $.ajax({
	        url : '{{ route('settings.route',['path' => 'side-menu-setup', 'action' => 'settings-retrieve-active-windows', 'id' => Crypt::encrypt('')]) }}',
	        method : "post",
	        data : { 'module' : event.value },
	        processData : true,
	        dataType : 'json',
	        cache : false,
	        success : function(data) {
	            option += '<option value="0"> MAIN CLASS </option>';
	            $.each( data, function(key,value) {
	                option += '<option value="' + value.menu_id + '">' + value.menu_name + '</option>';
	            });
	            $('#menu_parent').html(option);
	        }
	    });
	}

	function submitFormAddModule(form){
	    $.ajax({
	        url: $('#' + form).attr('action'),
	        method:"POST",
	        data: new FormData($('#' + form)[0]),
	        contentType: false,
	        cache: false,
	        processData: false,
	        success: function(data) {

	            var alert = document.createElement("DIV");
	            alert.setAttribute("class", "alert alert-info");
	            alert.innerHTML = "<button type='button' class='close alert-close' data-dismiss='alert' area-hidden='true'>&times;</button>";
	            alert.innerHTML += "<label><i class='fa fa-warning'></i> " + data + "</label>";
	            $('#modaladdmodule #modal_add_module_alert').html(alert);

	            $('#' + form)[0].reset();

	        }
	    });
	}

	function submitFormSearch(event) {
		$.ajax({
		    url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-search-system-module', 'id' => Crypt::encrypt('')]) }}',
		    method : "post",
		    data : new FormData($('#form_search_system_module')[0]),
		    contentType: false,
		    cache: false,
		    processData: false,
		    success: function(data) {
		    	$('#panel_body').html(data);
		    }
		});
	}

	function updateSystemModule(form) {
		$('.box-overlay-loader').show();
		if(confirm('Are you sure you want to update system module?')) {
			$.ajax({
			    url: '{{ route('settings.route',['path' => $path, 'action' => 'settings-update-system-module', 'id' => Crypt::encrypt('')]) }}',
			    method:"POST",	
			    data: new FormData($('#form_update_system_module')[0]),
			    contentType: false,
			    cache: false,
			    processData: false,
			    success: function(data) {
			    	alert('Successfully Updated');
			    	$('#panel_body').html(data);
			    	submitFormSearch();
			    	$('.box-overlay-loader').hide();
			    }
			});
		}
	}

	function deleteSystemModule(form) {
		if(confirm('Are you sure you want to PERMANENTLY delete this row?')) {
			// $.ajax({
			//     url: '{{ route('settings.route',['path' => $path, 'action' => 'settings-delete-system-module', 'id' => Crypt::encrypt('')]) }}',
			//     method:"POST",
			//     data: new FormData($('#form_update_system_module')[0]),
			//     contentType: false,
			//     cache: false,
			//     processData: false,
			//     success: function(data) {
			//     	$('#panel_body').html(data);
			//     }
			// });
		}
	}

</script>

@endpush