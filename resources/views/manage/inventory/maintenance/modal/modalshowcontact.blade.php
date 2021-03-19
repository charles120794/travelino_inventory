<div class="modal fade" id="modalshowcontact">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-contact', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-phone"></i> Contact Information </h4>
        		</div>
        		<div class="modal-body">
			    	<div class="form-group">
			          	<label>Contact Person</label>
			          	<input type="text" class="form-control bg-white" id="show_contact_description" autocomplete="contact-description" maxlength="50" disabled>
			        </div>
		        	<div class="form-group">
		              	<label>Contact No.</label>
		              	<input type="text" class="form-control bg-white input-number" id="show_contact_number" autocomplete="contact-number" maxlength="15" disabled>
		            </div>
		            <div class="form-group">
		              	<label>Contact E-mail</label>
		              	<input type="email" class="form-control bg-white" id="show_contact_email" autocomplete="contact-email" maxlength="30" disabled>
		            </div>
	            	<div class="form-group">
	                  	<label>Contact Position</label>
	                  	<input type="text" class="form-control bg-white" id="show_contact_position" autocomplete="contact-position" maxlength="20" disabled>
	                </div>
        		</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i> Close </button>
        		</div>
        	</form>
        </div>
    </div>
</div>