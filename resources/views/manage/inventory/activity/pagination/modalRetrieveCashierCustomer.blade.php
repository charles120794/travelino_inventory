<div class="box box-default box-solid">
    <div class="box-body">
        {{-- <input type="text" class="form-control" name="search_modal_customer" id="search_modal_customer" placeholder="Search Here..." value="{{ $search ?? '' }}" style="margin-bottom: 10px;"> --}}
        <div class="row" style="overflow-x: auto;">
            <div class="col-md-12">
            	<table class="table table-bordered table-condensed table-hover cashier-customer-datatable" style="max-height: 70vh; overflow-y: scroll;">
            	    <thead>
            	        <tr class="bg-gray-light" style="height: 40px; white-space: nowrap;">
            	            <th class="v-align-middle text-center"> Code </th>
            	            <th class="v-align-middle text-center"> Customer Name </th>
            	            <th class="v-align-middle text-center"> Mobile / Phone No. </th>
            	            <th class="v-align-middle text-center"> E-mail </th>
            	            <th class="v-align-middle text-center"> Action </th>
            	        </tr>
            	    </thead>
            	    <tbody>
                        
            	        @forelse ($customers as $key => $chuck)

                            @foreach ($chuck as $customer)

                                <tr>
                                    <td class="v-align-middle">{{ $customer['customer_code'] }}</td>
                                    <td class="v-align-middle">{{ $customer['customer_description'] }}</td>
                                    <td class="v-align-middle">{{ $customer['contact_number'] }}</td>
                                    <td class="v-align-middle">{{ $customer['contact_email'] }}</td>
                                    <td class="v-align-middle text-center">
                                        <button class="btn btn-primary btn-flat btn-sm btn-block btn-selected-customer" data-customer="{{ encrypt($customer['customer_id']) }}">Select</button>
                                    </td>
                                </tr>

                            @endforeach
            	        
            	        @empty
            	        <tr>
            	            <td class="text-center" colspan="6"> No result's found </td>
            	        </tr>
            	        @endforelse
            	    </tbody>
            	</table>
			</div>
        </div>
    </div>
    <div class="overlay modal-loader-overlay">
        <i class="fa fa-refresh fa-spin modal-loader-spin"></i>
    </div>
</div>
