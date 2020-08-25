<div class="modal fade" id="modaladdsupplier">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-supplier', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-plus"></i> Supplier </h4>
        		</div>
        		<div class="modal-body">

		            <div class="box box-solid">
		            	<div class="box-header">
		            		<h3 class="box-title"><i class="fa fa-user"></i> Supplier</h3>
	                    </div>
	                    <div class="box-body">
                    	 	<div class="row">
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Code</label> <span class="text-red">*</span>
			                	      	<input type="text" class="form-control" name="code" autocomplete="supplier-code" value="{{ strtoupper(uniqid()) }}" maxlength="20" required>
			                	    </div>
				                </div>
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Description</label> <span class="text-red">*</span>
			                	      	<input type="text" class="form-control" name="description" autocomplete="supplier-description" maxlength="50" required>
			                	    </div>
				                </div>
				            </div>
				            <div class="row">
			                	<div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>TIN Number</label>
			                	      	<input type="text" class="form-control input-number" name="tin" autocomplete="supplier-tin" maxlength="20" required>
			                	    </div>
				                </div>
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Business Style</label>
			                	      	<input type="text" class="form-control" name="business_style" autocomplete="supplier-business-style" maxlength="50">
			                	    </div>
				                </div>
			                </div>
            	            <div class="row">
                            	<div class="col-md-6">
                            		<div class="form-group">
                            	      	<label>TAX</label>
                            	      	<input type="text" class="form-control text-right input-currency" name="tax" autocomplete="supplier-tax" value="0.00" maxlength="20" required>
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
    	      								<input type="text" class="form-control" name="currency_name" id="currency_name" required readonly>
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
										<div class="input-group">
											<div class="input-group-btn">
												<button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></button>
												<ul class="dropdown-menu">
													<li>
														<input type="text" class="form-control input-sm" id="search-contact" placeholder="Search Contact">
													</li>
													<li><a href="#" data-object="[]" class="selected-contact no-selected-contact">-- No Selected Contact --</a></li>
													@foreach($contact as $key => $value)
													<li><a href="#" data-object="{{ $value }}" class="selected-contact">{{ $value->contact_description }} / {{ $value->contact_number }} / {{ $value->contact_position }} / {{ $value->contact_email }} </a></li>
													@endforeach
												</ul>
											</div>
											<input type="text" class="form-control" name="option[0][description]" id="contact_person" autocomplete="contact-description" maxlength="50" required>
				                	      	<input type="hidden" name="option[0][code]" value="{{ strtoupper(uniqid()) }}">
				                	      	<input type="hidden" name="contact_id" id="contact_id">
										</div>
			                	    </div>
				                </div>
				                <div class="col-md-6">
				                	<div class="form-group">
				                      	<label>Contact Position</label>
				                      	<input type="text" class="form-control" name="option[0][position]" id="position" autocomplete="contact-position" maxlength="20">
				                    </div>
				                </div>
				            </div>
                    	 	<div class="row">
				                <div class="col-md-6">
			                		<div class="form-group">
			                	      	<label>Mobile / Phone No.</label> <span class="text-red">*</span>
			                	      	<input type="text" class="form-control input-number" name="option[0][number]" id="number" autocomplete="contact-number" maxlength="15" required>
			                	    </div>
				                </div>
				                <div class="col-md-6">
				                	<div class="form-group">
				                	  	<label>Contact E-mail</label> <span class="text-red">*</span>
				                	  	<input type="email" class="form-control" name="option[0][email]" id="email" autocomplete="contact-email" maxlength="30" required>
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
					                  	<div class="input-group">
											<div class="input-group-btn">
												<button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></button>
												<ul class="dropdown-menu">
													<li>
														<input type="text" class="form-control input-sm" id="search-address" placeholder="Search Address">
													</li>
													<li><a href="#" data-object="[]" class="selected-address no-selected-address">-- No Selected Address --</a></li>
													@foreach($address as $key => $value)
													<li><a href="#" data-object="{{ $value }}" class="selected-address">{{ $value->address_number }} / {{ $value->address_street }} / {{ $value->address_barangay }} / {{ $value->address_city }} / {{ $value->address_zip }}</a></li>
													@endforeach
												</ul>
											</div>
											<input type="text" class="form-control" name="option[0][number]" id="building_no" autocomplete="address-building" maxlength="30" required>
					                  		<input type="hidden" name="address_id" id="address_id">
										</div>
					                </div>
					            </div>
					            <div class="col-md-6">
					                <div class="form-group">
				                      	<label>Street</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="option[0][street]" id="street" autocomplete="address-street" maxlength="30" required>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>Barangay</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="option[0][barangay]" id="barangay" autocomplete="address-barangay" maxlength="30" required>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                      	<label>City</label> <span class="text-red">*</span>
				                      	<input type="text" class="form-control" name="option[0][city]" id="city" autocomplete="address-city" maxlength="30" required>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-md-12">
				            		<div class="form-group">
				            		  	<label>ZIP Code</label> <span class="text-red">*</span>
				            		  	<input type="text" class="form-control" name="option[0][zip]" id="zip" autocomplete="address-zip" maxlength="30" required>
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