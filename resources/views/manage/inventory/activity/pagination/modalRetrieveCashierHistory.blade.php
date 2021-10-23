<div class="modal fade" id="modalcashierhistory">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> &times; </span></button>
                <h4 class="modal-title"><i class="fa fa-list"></i> Transaction History </h4>
            </div>
            <div class="modal-body">
                <div class="box box-default box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-condensed cashier-history-datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50%;"> Customer Name </th>
                                            <th class="text-center" style="width: 20%;"> Date Purchased </th>
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
    $('#modalcashierhistory').ready(function(){ 
        $('.cashier-history-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventory.route',['path' => $path, 'action' => 'inventory-retrieve-cashier-history', 'id' => str_random(30)]) }}",
            columns: [
                // {data: 'customer_code', className : 'v-align-middle'},
                { data: 'customer_name', className : 'v-align-middle' },
                { data: 'customer_date_purchased', className : 'v-align-middle' },
                { data: 'customer_total_purchase', className : 'v-align-middle text-right' },
                { data: 'action', className : 'v-align-middle' },
            ],
            autoWidth: false,
            fixedColumns: true
        });
    });
</script>

@endpush