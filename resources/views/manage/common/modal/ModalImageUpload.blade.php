<div class="modal fade" id="addimageupload">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> &times; </span></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> ADD IMAGE </h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#upload" id="to-upload-image" data-toggle="tab"><b> <i class="fa fa-upload fa-fw"></i> Upload Image </b></a></li>
                        <li class="active"><a href="#select" id="to-select-image" data-toggle="tab"><b> <i class="fa fa-list fa-fw"></i> Select Image </b></a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="upload">
                        <form method="post" action="{{ route('settings.route',['path' => 'settings', 'action' => 'upload-image-content', 'id' => encrypt('') ]) }}" id="form-upload-image" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3" style="margin-top: 80px; margin-bottom: 80px;">
                                            <input type="file" name="images[]" class="form-control" multiple="multiple">
                                            <div class="box-header with-border text-center" style="margin-top: 10px;">
                                                <h3 class="box-title" style="font-size: 14px;">Choose Image to Upload</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane active fade in" id="select">
                        <div id="uploaded-image-content"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-primary btn-sm btn-submit" id="btn-upload" style="display: none;"><i class="fa fa-upload"></i> Upload </button>
                <button type="button" class="btn btn-flat btn-primary btn-sm btn-submit" id="btn-submit" onclick="return submitModalImageUpload()"><i class="fa fa-check"></i> Submit </button>
                <button type="button" class="btn btn-flat btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
            </div>
        </div>
    </div> 
</div>

@push('scripts')

<script type="text/javascript">

    $(document).ready(function(){
 
        $.ajax({
            url : '{{ route('settings.route', ['path' => 'settings', 'action' => 'retrieve-images', 'id' => encrypt('') ]) }}',
            type : 'post',
            dataType : 'html',
            success : function(data){
                $('#uploaded-image-content').html(data);
                callBackUpdateMedia();
            } 
        });

        $('#btn-upload').on('click', function(){
            $('#upload #form-upload-image').submit();
        });

        $('#to-upload-image').on('click', function(){
            $('#btn-upload').show();
            $('#btn-submit').hide();
        });

        $('#to-select-image').on('click', function(){
            $('#btn-submit').show();
            $('#btn-upload').hide();
        });

    });

    function callBackUpdateMedia() {
        $('#addimageupload #uploaded-image-content #form-media-details').on('submit', function(event){
            event.preventDefault();
            if($.trim($('#media_id').val()) == "") {
                alert('Please select image to update');
            } else {
                if(confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url : $(this).attr('action'),
                        type : 'post',
                        dataType : 'json',
                        data : $(this).serialize(),
                        success : function(data){
                            alert(data.message);
                            if(data.action == 'delete') {
                                $('.selected-image').parent().fadeOut();
                                $('#media_name').val("");
                                $('#media_description').val("");
                                $('#media_alt_name').val("");
                                $('#media_tags').val("");
                                $('#media_id').val("");
                                $('#media_image_path').val("");
                            }
                        }
                    });
                }
            }
        });
    }

    function selectedImage(evt) {

        $('#media_name').val($(evt).data('title'));
        $('#media_description').val($(evt).data('description'));
        $('#media_alt_name').val($(evt).attr('alt'));
        $('#media_tags').val($(evt).data('tags'));
        $('#media_id').val($(evt).data('media_id'));
        $('#media_image_path').val($(evt).data('orig_path'));

        $.each($('.sel-image-class'), function(key, value){
            $(this).removeClass('img-thumbnail selected-image').addClass('img-responsive');
        });

        $(evt).addClass('img-thumbnail selected-image').removeClass('img-responsive');

    }
    
</script>

@endpush