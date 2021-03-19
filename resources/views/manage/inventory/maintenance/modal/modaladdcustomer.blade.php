<div class="modal fade" id="modaladdcustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-customer', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-plus"></i> Customer </h4>
        		</div>
        		<div class="modal-body">
		            <div class="box box-solid">
		            	<div class="box-header">
		            		<h3 class="box-title"><i class="fa fa-user"></i> Customer </h3>
	                    </div>
	                    <div class="box-body">
                    	 	<div class="row">
				                <div class="col-md-12">
			                		<div class="form-group">
			                			<?php $code = strtoupper(uniqid()); ?>
			                	      	<label>Code</label> <span class="text-red">*</span>
			                	      	<input type="text" class="form-control" name="code" autocomplete="customer-code" value="{{ $code }}" maxlength="20" required>
			                	    </div>
				                </div>
				                <div class="col-md-12">
			                		<div class="form-group">
			                	      	<label>Customer Name</label> <span class="text-red">*</span>
			                	      	<input type="text" class="form-control" name="description" autocomplete="customer-description" maxlength="50" required>
			                	    </div>
				                </div>
				            </div>
				            <div class="row hide">
			                	<div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>TIN Number</label>
			                	      	<input type="text" class="form-control input-number" name="tin" autocomplete="customer-tin" maxlength="20">
			                	    </div>
				                </div>
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Business Style</label>
			                	      	<input type="text" class="form-control" name="business_style" autocomplete="customer-business-style" maxlength="50">
			                	    </div>
				                </div>
			                </div>
            	            <div class="row hide">
                            	<div class="col-md-6">
                            		<div class="form-group">
                            	      	<label>TAX</label>
                            	      	<input type="text" class="form-control text-right input-currency" name="tax" autocomplete="customer-tax" value="0.00" maxlength="20">
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
			                	      	<input type="hidden" name="contact[0][code]" value="{{ $code }}">
										<input type="text" class="form-control" name="contact[0][description]" autocomplete="contact-description" maxlength="50" required>
			                	    </div>
				                </div>
				                <div class="col-md-6">
				                	<div class="form-group">
				                      	<label>Contact Position</label>
				                      	<input type="text" class="form-control" name="contact[0][position]" id="position" autocomplete="contact-position" maxlength="20">
				                    </div>
				                </div>
				            </div>
                    	 	<div class="row">
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Contact Number</label> <span class="text-red">*</span>
			                	      	<input type="text" class="form-control input-number" name="contact[0][number]" id="number" autocomplete="contact-number" maxlength="15" required>
			                	    </div>
				                </div>
				                <div class="col-md-6">
				                	<div class="form-group">
				                	  	<label>Contact E-mail</label> <span class="text-red">*</span>
				                	  	<input type="email" class="form-control" name="contact[0][email]" id="email" autocomplete="contact-email" maxlength="30" required>
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
				                  		<input type="hidden" name="address[0][code]" value="{{ $code }}">
										<input type="text" class="form-control" name="address[0][number]" autocomplete="address-building" maxlength="30" required>
					                </div>
					            </div>
					            <div class="col-md-6">
					                <div class="form-group">
				                      	<label>Street</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][street]" autocomplete="address-street" maxlength="30" required>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>Barangay</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][barangay]" autocomplete="address-barangay" maxlength="30" required>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>City</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="address[0][city]" autocomplete="address-city" maxlength="30" required>
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