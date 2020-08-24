<div class="modal fade" id="modaladdaddress">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-address', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-plus"></i> Department </h4>
        		</div>
        		<div class="modal-body">
					<div class="form-group">
				      	<label>Building No.</label> <span class="text-red">*</span>
				      	<input type="text" class="form-control" name="option[0][number]" autocomplete="building-number" maxlength="50" placeholder="Blk 88 Lot 3" required>
				    </div>
			    	<div class="form-group">
			          	<label>Street</label> <span class="text-red">*</span>
			          	<input type="text" class="form-control" name="option[0][street]" autocomplete="address-street" maxlength="100" placeholder="Amorseco Street" required>
			        </div>
		        	<div class="form-group">
		              	<label>Barangay</label> <span class="text-red">*</span>
		              	<input type="text" class="form-control" name="option[0][barangay]" autocomplete="address-barangay" maxlength="100" placeholder="Rizal" required>
		            </div>
	            	<div class="form-group">
	                  	<label>City</label> <span class="text-red">*</span>
	                  	<input type="text" class="form-control" name="option[0][city]" autocomplete="address-city" maxlength="100" placeholder="Makati City" required>
	                </div>
	                <div class="form-group">
	                  	<label>ZIP Code</label> <span class="text-red">*</span>
	                  	<input type="text" class="form-control" name="option[0][zip]" autocomplete="address-zip" maxlength="100" placeholder="1218" required>
	                </div>
        		</div>
        		<div class="modal-footer">
        			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Submit </button>
        		</div>
        	</form>
        </div>
    </div>
</div>