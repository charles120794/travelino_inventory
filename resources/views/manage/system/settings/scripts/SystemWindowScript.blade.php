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

    function selectedCompany(company)
    {
        var company_id = company.value;
        $.get('{{ route('settings.route',['path' => $path, 'action' => 'search-company-module-json', 'id' => Crypt::encrypt($thisUser->users_id)]) }}',
            { company_id:company_id },
            function(data) {
            var option = '<option value=""> SELECT MODULE </option>';
            if(data.length > 0 ){
                $.each( data, function(key,value) {
                    option += '<option value="' + value.module_id + '">' + value.module_description + '</option>';
                });
                $('#module_id').attr('disabled',false);
                $('#module_id').html(option);
            } else {
                $('#module_id').attr('disabled',true);
                $('#module_id').html(option);
            }
        });
    }

    function selectedModule()
    {

        var module_id = $('#module_id').val();

        var company_id = $('#company_id').val();

        $.ajax({
            url : '{{ route('settings.route',['path' => $path, 'action' => 'search-module-window-json', 'id' => encrypt($thisUser->users_id)]) }}', 
            data : { company_id : company_id, module_id : module_id },
            dataType : 'html',
            success : function(data) {
                $('#form_system_window').html(data);
            }
        });

        $.ajax({
            url : '{{ route('settings.route',['path' => $path, 'action' => 'search-module-window-json-data', 'id' => encrypt($thisUser->users_id)]) }}',
            dataType : 'json',
            data : { module_id : module_id, company_id : company_id},
            success : function(data){
                var option = '<option value="0"> Main Class </option>';
                if(data.length > 0){
                    $.each( data, function(key,value) {
                        option += '<option value="' + value.menu_id + '">' + value.menu_name + '</option>';
                    });
                    $('#menu_parent').html(option);
                } else {
                    $('#menu_parent').html(option);
                }
            }
        });

        $('#form_module_id').val(module_id);

    }

    function showButtons()
    {
        $('#submit_buttons').show();
    }

    function hideButtons()
    {
        $('#submit_buttons').hide();
    }

    function updateUsersWindow()
    {
        $.ajax({
            url : $('#form_update_window').attr('action'),
            method : 'post',
            data : $('#form_update_window').serializeArray(),
            dataType : 'html',
            success : function(data){
                alert('Successfully Updated');
                selectedModule();
            }
        });
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
        if($.trim($('#module_id').val()) == "") {
            alert('Please select valid module.');
        } else {
            selectedModule();
        }
    }

</script>

@endpush