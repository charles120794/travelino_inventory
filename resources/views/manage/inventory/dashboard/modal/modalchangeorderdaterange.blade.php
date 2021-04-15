<div class="modal fade" id="modalchangeorderdaterange">
    <div class="modal-dialog">
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
                        <input type="date" class="form-control order-date-from" name="o_df" value="{{ request()->has('df') ? request()->get('df') : date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Date To:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control order-date-to" name="o_dt" value="{{ request()->has('dt') ? request()->get('dt') : date('Y-m-d') }}" required>
                    </div>
                </div>
    		</div>
    		<div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-flat" id="btnmodalchangeorderdaterangeclose"><i class="fa fa-check"></i> Ok </button>
    			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
    		</div>
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    
    $(function(){
    
        $('#btnmodalchangeorderdaterange').on('click', function(event){
            $($(this).attr('href')).modal('show');
            event.preventDefault();
        });

        $('#btnmodalchangeorderdaterangeclose').on('click', function(event){
            $('#modalchangeorderdaterange').modal('hide');
            retrieve_customer_orders('pending', 'retrieve-pending-orders');
            retrieve_customer_orders('paid', 'retrieve-delivered-orders');
            retrieve_customer_orders('cancelled', 'retrieve-cancelled-orders');
            var dd_f = new Date($('.order-date-from').val());
            var dd_t = new Date($('.order-date-to').val());
            var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
            var date_range_f = months[dd_f.getMonth()] + ' ' + datezero(dd_f.getDate()) + ', ' + dd_f.getFullYear();
            var date_range_t = months[dd_t.getMonth()] + ' ' + datezero(dd_t.getDate()) + ', ' + dd_t.getFullYear();
            $('#s_order_dt_rng').text('(' + date_range_f + ' - ' + date_range_t + ')');
        });

        $(document).on('change', '.order-date-from', function(){
            if(new Date($(this).val()) > new Date($('.order-date-to').val()) && $.trim($('.order-date-to').val()) != "") {
                alert('Invalid Date Range');
                $(this).val("");
            }
        });

        $(document).on('change', '.order-date-to', function(){
            if(new Date($(this).val()) < new Date($('.order-date-from').val()) && $.trim($('.order-date-from').val()) != "") {
                alert('Invalid Date Range');
                $(this).val("");
            }
        });
    });

</script>

@endpush