<div class="modal fade" id="modaleditunitmeasure">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'update-unit-measure', 'id' => encrypt(1)]) }}"> @csrf
        		<div class="modal-header">
        		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        		    <span aria-hidden="true"> &times; </span></button>
        		    <h4 class="modal-title"><i class="fa fa-edit"></i> Update Unit of Measure </h4>
        		</div>
        		<div class="modal-body">
			    	<div class="form-group">
			          	<label>Description</label> <span class="text-red">*</span>
                        <input type="hidden" name="unit_id" id="unit_id">
			          	<input type="text" class="form-control" name="unit_description" id="unit_description" autocomplete="unit-description" maxlength="100" required>
			        </div>
        		</div>
        		<div class="modal-footer">
        			<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Update </button>
        		</div>
        	</form>
        </div>
    </div>
</div>