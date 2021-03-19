<div class="modal fade" id="modaleditcustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'update-customer', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-edit"></i> Update Customer Information </h4>
        		</div>
        		<div class="modal-body">
		            <div class="box box-solid">
		            	<div class="box-header">
		            		<h3 class="box-title"><i class="fa fa-user"></i> Customer </h3>
	                    </div>
	                    <div class="box-body">
                    	 	<div class="row">
				                <div class="col-md-6">
			                		<div class="form-group">
			                			<input type="hidden" name="customer_id">
			                	      	<label>Description</label> <span class="text-red">*</span>
			                	      	<input type="text" class="form-control" name="customer_description" autocomplete="customer-description" maxlength="50" required>
			                	    </div>
				                </div>
				            </div>
				            <div class="row hide">
			                	<div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>TIN Number</label>
			                	      	<input type="text" class="form-control input-number" name="customer_tin" autocomplete="customer-tin" maxlength="20">
			                	    </div>
				                </div>
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Business Style</label>
			                	      	<input type="text" class="form-control" name="customer_business_style" autocomplete="customer-business-style" maxlength="50">
			                	    </div>
				                </div>
			                </div>
            	            <div class="row hide">
                            	<div class="col-md-6">
                            		<div class="form-group">
                            	      	<label>TAX</label>
                            	      	<input type="text" class="form-control text-right input-currency" name="customer_tax" autocomplete="customer-tax" value="0.00" maxlength="20">
                            	    </div>
            	                </div>
            	                <div class="col-md-6">
                            		<div class="form-group">
                            	      	<label>Currency</label>
    	      							<div class="input-group">
    	      								<div class="input-group-btn">
    	      									<button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></button>
    	      									<ul class="dropdown-menu pull-left">
    	      										<li><a href="#" data-object="[]" class="selected-currency no-selected-currency">-- No Selected Currency --</a></li>
    	      										@foreach($currency as $key => $value)
    	      										<li><a href="#" data-object="{{ $value }}" class="selected-currency">{{ $value->currency_code }} - {{ $value->currency_description }} </a></li>
    	      										@endforeach
    	      									</ul>
    	      								</div>
    	      								<input type="text" class="form-control" name="currency_name" id="currency_name" readonly>
    	      	                	      	<input type="hidden" name="currency_id" id="currency_id">
    	      							</div>
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
                    	 	<div class="row">
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Contact Person</label> <span class="text-red">*</span>
										<input type="text" class="form-control" name="contact_description" autocomplete="contact-description" maxlength="50" required>
			                	      	<input type="hidden" name="contact_id" id="contact_id">
			                	    </div>
				                </div>
				                <div class="col-md-6">
				                	<div class="form-group">
				                      	<label>Contact Position</label>
				                      	<input type="text" class="form-control" name="contact_position" autocomplete="contact-position" maxlength="20">
				                    </div>
				                </div>
				            </div>
                    	 	<div class="row">
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Contact Number</label> <span class="text-red">*</span>
			                	      	<input type="text" class="form-control input-number" name="contact_number" autocomplete="contact-number" maxlength="15" required>
			                	    </div>
				                </div>
				                <div class="col-md-6">
				                	<div class="form-group">
				                	  	<label>Contact E-mail</label> <span class="text-red">*</span>
				                	  	<input type="email" class="form-control" name="contact_email" autocomplete="contact-email" maxlength="30" required>
				                	</div>
				                </div>
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
				                  		<input type="hidden" name="address_id" id="address_id">
										<input type="text" class="form-control" name="address_number" autocomplete="address-building" maxlength="30" required>
					                </div>
					            </div>
					            <div class="col-md-6">
					                <div class="form-group">
				                      	<label>Street</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address_street" autocomplete="address-street" maxlength="30" required>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>Barangay</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address_barangay" autocomplete="address-barangay" maxlength="30" required>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>City</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address_city" autocomplete="address-city" maxlength="30" required>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-12">
				            		<div class="form-group">
				            		  	<label>ZIP Code</label> <span class="text-red">*</span>
				            		  	<input type="text" class="form-control" name="address_zip" autocomplete="address-zip" maxlength="30" required>
				            		</div>
				            	</div>
				            </div>
	                    </div>
	                </div>
	    		</div>
        		<div class="modal-footer">
        			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Update </button>
        		</div>
        	</form>
        </div>
    </div>
</div>