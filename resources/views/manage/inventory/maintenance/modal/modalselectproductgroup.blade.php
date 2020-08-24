<div class="modal fade" id="modalselectproductgroup">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-plus"></i> Product Group </h4>
    		</div>
    		<div class="modal-body">
    			@include('manage.inventory.maintenance.includes.productgroupsearch',['addgroup' => false])
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-primary btn-flat close-modal-add-group"><i class="fa fa-check"></i> Done </button>
    		</div>
    	</div>
    </div>
</div>
