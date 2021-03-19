<div class="modal fade" id="modalsearchcustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
    		<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-search"></i> Customer </h4>
    		</div>
    		<div class="modal-body">
    			<table class="table table-bordered table-condensed table-hover">
	                <thead>
	                    <tr class="bg-gray-light" style="height: 40px;">
	                        <th class="v-align-middle text-center">Code</th>
	                        <th class="v-align-middle text-center">Customer Name</th>
	                        <th class="v-align-middle text-center">Mobile / Phone No.</th>
	                        <th class="v-align-middle text-center">E-mail</th>
	                        <th class="v-align-middle text-center">Action</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @forelse($customer as $key => $value)
	                    <tr>
	                        <td class="v-align-middle">{{ $value->customer_code }}</td>
	                        <td class="v-align-middle">{{ $value->customer_description }}</td>
	                        <td class="v-align-middle">{{ $value->customerContact['contact_number'] }}</td>
	                        <td class="v-align-middle">{{ $value->customerContact['contact_email'] }}</td>
	                        <td class="v-align-middle text-center">
	                            <button class="btn btn-default btn-sm btn-block btn-selected-customer" data-id="{{ $value->customer_id }}" data-description="{{ $value->customer_description }}">Select</button>
	                        </td>
	                    </tr>
	                    @empty
	                    <tr>
	                        <td class="text-center" colspan="6"> No result's found </td>
	                    </tr>
	                    @endforelse
	                </tbody>
	            </table>
    		</div>
    		<div class="modal-footer">
    			<button type="submit" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
    		</div>
        </div>
    </div>
</div>