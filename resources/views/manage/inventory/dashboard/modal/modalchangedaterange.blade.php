<div class="modal fade" id="modalchangedaterange">
    <div class="modal-dialog">
        <form method="get" action="">
            <div class="modal-content">
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-calendar"></i> Select Date Range </h4>
        		</div>
        		<div class="modal-body">
                    <div class="form-group">
                        <label>Date From:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control date-from" name="df" value="{{ request()->has('df') ? request()->get('df') : date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Date To:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control date-to" name="dt" value="{{ request()->has('dt') ? request()->get('dt') : date('Y-m-d') }}" required>
                        </div>
                    </div>
        		</div>
        		<div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Ok </button>
        			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
        		</div>
            </div>
        </form>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    
    $(function(){
        $('#btnmodalchangedaterange').on('click', function(event){
            $($(this).attr('href')).modal('show');
            event.preventDefault();
        });

        $('#modalchangedaterange .date-from').on('change', function(){
            if(new Date($(this).val()) > new Date($('.date-to').val()) && $.trim($('.date-to').val()) != "") {
                alert('Invalid Date Range');
                $(this).val("");
            }
        });

        $('#modalchangedaterange .date-to').on('change', function(){
            if(new Date($(this).val()) < new Date($('.date-from').val()) && $.trim($('.date-from').val()) != "") {
                alert('Invalid Date Range');
                $(this).val("");
            }
        });
    });

</script>

@endpush