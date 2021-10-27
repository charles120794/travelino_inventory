<div class="modal fade" id="modalorderpending">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> &times; </span></button>
                <h4 class="modal-title"><i class="fa fa-list"></i> Pending Orders </h4>
            </div>
            <div class="modal-body">
                <div class="box box-default box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-condensed order-pending-datatable" style="white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50%;"> Customer Name </th>
                                            <th class="text-center" style="width: 20%;"> Date Ordered </th>
                                            <th class="text-center" style="width: 20%;"> Status </th>
                                            <th class="text-center" style="width: 20%;"> Total Amount </th>
                                            <th class="text-center" style="width: 20%;"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    $('#modalorderpending').ready(function(){ 
        var table = $('.order-pending-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{ route('inventory.route',['path' => $path, 'action' => 'inventory-retrieve-order-history', 'id' => str_random(30)]) }}",
                data : { order_type : 'pending' },
                // success : function(data) {
                //     $('#pending_order_count').text(data.recordsFiltered);
                // }
            },
            columns: [
                // {data: 'customer_code', className : 'v-align-middle'},
                { data: 'customer_name', className : 'v-align-middle' },
                { data: 'customer_date_purchased', className : 'v-align-middle' },
                { data: 'customer_status', className : 'v-align-middle' },
                { data: 'customer_total_purchase', className : 'v-align-middle text-right' },
                { data: 'customer_pending_action', className : 'v-align-middle' },
            ],
            autoWidth: false,
            fixedColumns: true
        });

        table.on( 'xhr', function () {
            var json = table.ajax.json();
            $('#pending_order_count').text(json.recordsFiltered);
        } );
    });
</script>

@endpush