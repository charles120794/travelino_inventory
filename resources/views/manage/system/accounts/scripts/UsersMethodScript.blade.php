@push('scripts')

<script type="text/javascript">

    $(document).ready(function(){

        $('.users-method-access-datatables').DataTable({
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

    function selectedCompany(event) {
        $.ajax({
            url : '{{ route('actions.route',['path' => $path, 'action' => 'search-users-module-json', 'id' => encrypt($thisUserAccount->users_id)]) }}',
            data : { company_id : event.value },
            method : 'post',
            dataType : 'json',
            success : function(data) {
                var option = '<option value=""> -- Select Module -- </option>';
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
            }
        });
    }

    function selectedModule(event) {
        $.ajax({
            url : '{{ route('actions.route',['path' => $path, 'action' => 'search-users-window-json', 'id' => encrypt($thisUserAccount->users_id)]) }}',
            data : $('#form_search_users_method').serialize(),
            method : 'post',
            dataType : 'json',
            success : function(data) {
                var option = '<option value=""> -- Select Window -- </option>';
                if(data.length > 0 ){
                    $.each( data, function(key,value) {
                        option += '<option value="' + value.menu_id + '">' + (value.menu_name).toUpperCase() + '</option>';
                    });
                    $('#window_id').attr('disabled',false);
                    $('#window_id').html(option);
                } else {
                    $('#window_id').attr('disabled',true);
                    $('#window_id').html(option);
                }
            }
        });
    }

    function submitFormSearch() {
        $.ajax({
            url : $('#form_search_users_method').attr('action'),
            data: $('#form_search_users_method').serialize(),
            method : 'post',
            dataType : 'html',
            processData: false,
            cache: false,
            success : function(data) {
                $('#form_users_window_method').html(data);
                $('.users-method-access-datatables').DataTable({
                    autoWidth: false,
                });
            }
        });
    }

    function updateUserMethod() {
        $.ajax({
            url : $('#form_update_users_method').attr('action'),
            data: $('#form_update_users_method').serialize(),
            method : 'post',
            dataType : 'json',
            cache: false,
            processData: false,
            success : function(data) {
                alert(data.message);
                submitFormSearch();
            }
        });
    }

</script>

@endpush