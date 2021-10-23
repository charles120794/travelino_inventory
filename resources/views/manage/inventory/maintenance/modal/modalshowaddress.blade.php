<div class="modal fade" id="modalshowaddress">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'update-address', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-home"></i> Address Information </h4>
        		</div>
        		<div class="modal-body">
					<div class="form-group">
				      	<label>Building No.</label> <span class="text-red">*</span>
				      	<input type="text" class="form-control bg-white" name="address_number" id="show_address_number" autocomplete="building-number" maxlength="50" disabled>
				    </div>
			    	<div class="form-group">
			          	<label>Street</label> <span class="text-red">*</span>
			          	<input type="text" class="form-control bg-white" name="address_street" id="show_address_street" autocomplete="address-street" maxlength="100" disabled>
			        </div>
		        	<div class="form-group">
		              	<label>Barangay</label> <span class="text-red">*</span>
		              	<input type="text" class="form-control bg-white" name="address_barangay" id="show_address_barangay" autocomplete="address-barangay" maxlength="100" disabled>
		            </div>
	            	<div class="form-group">
	                  	<label>City</label> <span class="text-red">*</span>
	                  	<input type="text" class="form-control bg-white" name="address_city" id="show_address_city" autocomplete="address-city" maxlength="100" disabled>
	                </div>
	                <div class="form-group">
	                  	<label>ZIP Code</label> <span class="text-red">*</span>
	                  	<input type="text" class="form-control bg-white" name="address_zip" id="show_address_zip" autocomplete="address-zip" maxlength="100" disabled>
	                </div>
        		</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i> Close </button>
        		</div>
        	</form>
        </div>
    </div>
</div>