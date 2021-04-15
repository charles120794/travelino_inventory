<div class="modal fade" id="modalnonmovingproductdate">
    <div class="modal-dialog">
        <div class="modal-content">
    		<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-calendar"></i> Select Date </h4>
    		</div>
    		<div class="modal-body">
                <div class="form-group">
                    <label>Select Date:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control date-from" name="non_m_product" id="non_m_product" value="{{ request()->has('non_m_product') ? request()->get('non_m_product') : date('Y-m-d') }}" required>
                    </div>
                </div>
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
    		</div>
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    
    $(function(){
        $('#btnmodalnonmovingproductdate').on('click', function(event){
            $($(this).attr('href')).modal('show');
            event.preventDefault();
        });

        $('#non_m_product').on('change', function(){
            var dd_f = new Date($(this).val());
            var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
            var date = months[dd_f.getMonth()] + ' ' + datezero(dd_f.getDate()) + ', ' + dd_f.getFullYear();
            $('#s_non_moving_dt').text(date)
            retrieve_non_moving_products('.products-widget-ee');
            $('#modalnonmovingproductdate').modal('hide');
        });
    });

</script>

@endpush