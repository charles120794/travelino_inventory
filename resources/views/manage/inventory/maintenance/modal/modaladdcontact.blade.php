<div class="modal fade" id="modaladdcontact">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-contact', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-plus"></i> Contact Information </h4>
        		</div>
        		<div class="modal-body">

		            <div class="box box-solid">
		            	<div class="box-header">
		            		<h3 class="box-title"><i class="fa fa-phone"></i> Contact </h3>
	                    </div>
	                    <div class="box-body">
							<div class="form-group">
								<?php $code = strtoupper(uniqid()); ?>
						      	<label>Code</label> <span class="text-red">*</span>
						      	<input type="text" class="form-control" name="contact[0][code]" autocomplete="contact-code" maxlength="20" value="{{ $code }}" required>
						    </div>
					    	<div class="form-group">
					          	<label>Contact Person</label> <span class="text-red">*</span>
					          	<input type="text" class="form-control" name="contact[0][description]" autocomplete="contact-description" maxlength="50" required>
					        </div>
				        	<div class="form-group">
				              	<label>Mobile / Phone No.</label> <span class="text-red">*</span>
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

		            <div class="box box-solid">
		            	<div class="box-header">
		            		<h3 class="box-title"><i class="fa fa-home"></i> Address </h3>
	                    </div>
	                    <div class="box-body">
                    	 	<div class="row">
				                <div class="col-md-6">
					                <div class="form-group">
					                  	<label>Building No.</label> <span class="text-red">*</span>
				                  		<input type="hidden" name="address[0][code]" value="{{ $code }}">
										<input type="text" class="form-control" name="address[0][number]" id="building_no" autocomplete="address-building" maxlength="30" required>
					                </div>
					            </div>
					            <div class="col-md-6">
					                <div class="form-group">
				                      	<label>Street</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][street]" id="street" autocomplete="address-street" maxlength="30" required>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>Barangay</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][barangay]" id="barangay" autocomplete="address-barangay" maxlength="30" required>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>City</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][city]" id="city" autocomplete="address-city" maxlength="30" required>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-12">
				            		<div class="form-group">
				            		  	<label>ZIP Code</label>
				            		  	<input type="text" class="form-control" name="address[0][zip]" id="zip" autocomplete="address-zip" maxlength="30">
				            		</div>
				            	</div>
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