<div class="modal fade" id="modaladdcontact">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-contact', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-plus"></i> Contact </h4>
        		</div>
        		<div class="modal-body">
					<div class="form-group">
				      	<label>Code</label> <span class="text-red">*</span>
				      	<input type="text" class="form-control" name="option[0][code]" autocomplete="contact-code" maxlength="20" required>
				    </div>
			    	<div class="form-group">
			          	<label>Description</label> <span class="text-red">*</span>
			          	<input type="text" class="form-control" name="option[0][description]" autocomplete="contact-description" maxlength="50" placeholder="Charles Dave Wong" required>
			        </div>
		        	<div class="form-group">
		              	<label>Mobile / Phone No.</label> <span class="text-red">*</span>
		              	<input type="text" class="form-control input-number" name="option[0][number]" autocomplete="contact-number" maxlength="15" placeholder="0916 8696 466" required>
		            </div>
	            	<div class="form-group">
	                  	<label>Contact Position</label>
	                  	<input type="text" class="form-control" name="option[0][position]" autocomplete="contact-position" maxlength="20" placeholder="Web Developer">
	                </div>
	                <div class="form-group">
	                  	<label>Contact E-mail</label> <span class="text-red">*</span>
	                  	<input type="email" class="form-control" name="option[0][email]" autocomplete="address-zip" maxlength="30">
	                </div>
        		</div>
        		<div class="modal-footer">
        			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Submit </button>
        		</div>
        	</form>
        </div>
    </div>
</div>