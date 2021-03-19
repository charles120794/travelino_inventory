<div class="modal fade" id="modaladdwarehouse">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-warehouse', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-edit"></i> Warehouse </h4>
        		</div>
        		<div class="modal-body">
					<div class="form-group">
				      	<label>Code</label> <span class="text-red">*</span>
				      	<input type="text" class="form-control" name="option[0][code]" autocomplete="warehouse-code" maxlength="50"  value="{{ strtoupper(uniqid()) }}" required>
				    </div>
			    	<div class="form-group">
			          	<label>Description</label> <span class="text-red">*</span>
			          	<input type="text" class="form-control" name="option[0][description]" autocomplete="warehouse-description" maxlength="100" required>
			        </div>
	            	<div class="form-group">
	                  	<label>Contact</label> <span class="text-red">*</span>
	                  	<input type="text" class="form-control" name="option[0][contact]" autocomplete="warehouse-contact" maxlength="100" placeholder="Code / Name / Number / Position" required>
	                </div>
                	<div class="form-group">
                      	<label>Address</label> <span class="text-red">*</span>
                      	<input type="text" class="form-control" name="option[0][address]" autocomplete="warehouse-address" maxlength="100" placeholder="" required>
                    </div>
			        <hr>
			        <div id="groupoptions"></div>
        		</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btn-warning btn-flat add-group-option hide"><i class="fa fa-plus"></i> Append </button>
        			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Submit </button>
        		</div>
        	</form>
        </div>
    </div>
</div>