<div class="modal fade" id="modaladdaddress">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-address', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-plus"></i> Address Information </h4>
        		</div>
        		<div class="modal-body">

		            <div class="box box-solid">
		            	<div class="box-header">
		            		<h3 class="box-title"><i class="fa fa-home"></i> Address </h3>
	                    </div>
	                    <div class="box-body">
	                    	<div class="row">
	                    		<div class="col-md-6">
	                    			<div class="form-group">
	                    				<?php $code = strtoupper(uniqid()); ?>
	                    		      	<label>Code</label> <span class="text-red">*</span>
	                    		      	<input type="text" class="form-control" name="address[0][code]" autocomplete="address-code" maxlength="20" value="{{ $code }}" required>
	                    		    </div>
	                    		</div>
	                    		<div class="col-md-6">
					                <div class="form-group">
					                  	<label>Building No.</label> <span class="text-red">*</span>
										<input type="text" class="form-control" name="address[0][number]" autocomplete="building-number" maxlength="30" required>
					                </div>
					            </div>
	                    	</div>
                    	 	<div class="row">
					            <div class="col-md-6">
					                <div class="form-group">
				                      	<label>Street</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][street]" autocomplete="address-street" maxlength="30" required>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>Barangay</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][barangay]" autocomplete="address-barangay" maxlength="30" required>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>City</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][city]" autocomplete="address-city" maxlength="30" required>
				                    </div>
				                </div>
				                <div class="col-md-6">
	                    			<div class="form-group">
	                    			  	<label>ZIP Code</label>
	                    			  	<input type="text" class="form-control" name="address[0][zip]" autocomplete="address-zip" maxlength="30">
	                    			</div>
	                    		</div>
				            </div>
							
			            </div>
			        </div>

		            <div class="box box-solid">
		            	<div class="box-header">
		            		<h3 class="box-title"><i class="fa fa-phone"></i> Contact </h3>
	                    </div>
	                    <div class="box-body">
	 				      	<input type="hidden" class="form-control" name="contact[0][code]" autocomplete="contact-code" maxlength="20" value="{{ $code }}" required>
    	 			    	<div class="form-group">
    	 			          	<label>Contact Person</label> <span class="text-red">*</span>
    	 			          	<input type="text" class="form-control" name="contact[0][description]" autocomplete="contact-description" maxlength="50" required>
    	 			        </div>
    	 		        	<div class="form-group">
    	 		              	<label>Contact Number</label> <span class="text-red">*</span>
    	 		              	<input type="text" class="form-control input-number" name="contact[0][number]" autocomplete="contact-number" maxlength="15" required>
    	 		            </div>
    	 		            <div class="form-group">
    	 		              	<label>Contact E-mail</label> <span class="text-red">*</span>
    	 		              	<input type="email" class="form-control" name="contact[0][email]" autocomplete="contact-email" maxlength="30">
    	 		            </div>
    	 	            	<div class="form-group">
    	 	                  	<label>Contact Position</label>
    	 	                  	<input type="text" class="form-control" name="contact[0][position]" autocomplete="contact-position" maxlength="20">
    	 	                </div>
	                    </div>
	                </div>

        		</div>
        		<div class="modal-footer">
        			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Submit </button>
        		</div>
        	</form>
        </div>
    </div>
</div>

<div class="modal fade" id="">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-address', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-plus"></i> Address </h4>
        		</div>
        		<div class="modal-body">
					<div class="form-group">
				      	<label>Building No.</label> <span class="text-red">*</span>
				      	<input type="text" class="form-control" name="address[0][number]" autocomplete="building-number" maxlength="50" placeholder="Blk 88 Lot 3" required>
				    </div>
			    	<div class="form-group">
			          	<label>Street</label> <span class="text-red">*</span>
			          	<input type="text" class="form-control" name="address[0][street]" autocomplete="address-street" maxlength="100" placeholder="Amorseco Street" required>
			        </div>
		        	<div class="form-group">
		              	<label>Barangay</label> <span class="text-red">*</span>
		              	<input type="text" class="form-control" name="address[0][barangay]" autocomplete="address-barangay" maxlength="100" placeholder="Rizal" required>
		            </div>
	            	<div class="form-group">
	                  	<label>City</label> <span class="text-red">*</span>
	                  	<input type="text" class="form-control" name="address[0][city]" autocomplete="address-city" maxlength="100" placeholder="Makati City" required>
	                </div>
	                <div class="form-group">
	                  	<label>ZIP Code</label> <span class="text-red">*</span>
	                  	<input type="text" class="form-control" name="address[0][zip]" autocomplete="address-zip" maxlength="100" placeholder="1218" required>
	                </div>
        		</div>
        		<div class="modal-footer">
        			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Submit </button>
        		</div>
        	</form>
        </div>
    </div>
</div>