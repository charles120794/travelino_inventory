<div class="modal fade" id="modalsearchcustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
    		<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-search"></i> Customer </h4>
    		</div>
    		<div class="modal-body" id="modal_load_customers">
                <table class="table table-bordered table-condensed table-hover cashier-customer-datatable" style="max-height: 70vh; overflow-y: scroll;">
                    <thead>
                        <tr class="bg-gray-light">
                            {{-- <th class="v-align-middle text-center"> Code </th> --}}
                            <th class="v-align-middle text-center"> Customer Name </th>
                            <th class="v-align-middle text-center"> Mobile / Phone No. </th>
                            <th class="v-align-middle text-center"> E-mail </th>
                            <th class="v-align-middle text-center"> Action </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
    		</div>
    		<div class="modal-footer">
    			<button type="submit" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
    		</div>
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    $('#modalsearchcustomer').ready(function(){ 
        $('.cashier-customer-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventory.route',['path' => $path, 'action' => 'inventory-retrieve-customer-cashier-modal', 'id' => str_random(30)]) }}",
            columns: [
                // {data: 'customer_code', className : 'v-align-middle'},
                { data: 'customer_description', className : 'v-align-middle' },
                { data: 'customer_phone_no', className : 'v-align-middle' },
                { data: 'customer_email', className : 'v-align-middle' },
                { data: 'action', className : 'v-align-middle' },
            ],
            autoWidth: false,
            fixedColumns: true
        });
    });
</script>

@endpush