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

</script>

@endpush 