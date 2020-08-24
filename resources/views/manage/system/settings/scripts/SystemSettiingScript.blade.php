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

    function updateStatus(id,url){
        if($('#'+id).hasClass('fa-toggle-on')){
            $('#'+id).removeClass('fa-toggle-on')
                .removeClass('text-orange')
                .addClass('fa-toggle-off')
                .addClass('text-red');
            tooglestatus(url,0);
        } else if($('#'+id).hasClass('fa-toggle-off')){
            $('#'+id).removeClass('fa-toggle-off')
                .removeClass('text-red')
                .addClass('fa-toggle-on').addClass('text-orange');
            tooglestatus(url,1);
        }
    }

    function tooglestatus(url,stat)
    {
        $.get(url,{status:stat},function(count){ });
    }

    function submitFormSearch(){
        $.ajax({
            url: $('#form_search_system_window').attr('action'),
            method:"POST",
            data: new FormData($('#form_search_system_window')[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#panel_body').html(data);
            }
        });
    }

    function updateUsersWindow(form){
        if(confirm('Are you sure you want to update users window details?')){
            $.ajax({
                url : $('#' + form).attr('action'),
                method : "POST",
                data : new FormData($('#'+ form)[0]),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data)
                {
                    alert('Successfully Updated.');
                    submitFormSearch();
                }
            });
        }
    }

    function deleteUsersWindow(form){
        if(confirm('Are you sure you want to delete all checked users window?')){
            $.ajax({
                url : '{{ route('settings.route',['path' => $path , 'action' => 'settings-delete-users-window', 'id' => Crypt::encrypt('')]) }}',
                method : "POST",
                data : new FormData($('#'+ form)[0]),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data)
                {
                    alert('Successfully Deleted.');
                    submitFormSearch();
                }
            });
        }
    }

</script>

@endpush