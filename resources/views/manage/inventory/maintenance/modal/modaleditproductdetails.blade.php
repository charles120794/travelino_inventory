<div class="modal fade" id="modaleditproductdetails">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form action="{{ route('inventory.route',['path' => active_path(), 'action' => 'update-product-details', 'id' => encrypt(1)]) }}" method="post">
    				{{ csrf_field() }}
	        	<div class="modal-header">
	    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    		    <span aria-hidden="true"> &times; </span></button>
	    		    <h4 class="modal-title"><i class="fa fa-edit"></i> Product Details </h4>
	    		</div>
	    		<div class="modal-body">
                	<div id="editproductdetails"></div>
	    		</div>
	    		<div class="modal-footer">
	    			<button type="submit" class="btn btn-primary btn-flat" onclick="return confirm('Are you sure you want to update?')"><i class="fa fa-check"></i> Update </button>
	    			<button type="button" class="btn btn-default btn-flat" data-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i> Close </button>
	    		</div>
	    	</form>
    	</div>
    </div>
</div>
