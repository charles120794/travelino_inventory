<div class="modal fade" id="modaladdproductgroup">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="{{ route('inventory.route',['path' => 'product-group', 'action' => 'create-product-group', 'id' => encrypt(1)]) }}"> @csrf
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true"> &times; </span></button>
	                <h4 class="modal-title"><i class="fa fa-plus"></i> Product Group </h4>
	            </div>
	            <div class="modal-body">
	            	<input type="hidden" name="option[0][group_parent]" id="modalgroupparent">
    				<div class="form-group">
    			      	<label>Group Type</label>
    			      	<select class="form-control" name="option[0][group_type]">
    			      		<option value="0">Child</option>
    			      		<option value="1">Parent</option>
    			      	</select>
    			    </div>
    		    	<div class="form-group">
    		          	<label>Group Description</label>
    		          	<input type="text" class="form-control" name="option[0][group_description]" autocomplete="group-description" maxlength="100" required>
    		        </div>
	            	<div id="groupoptions"></div>
	            </div>
	            <div class="modal-footer">
	            	<button type="button" class="btn btn-warning btn-flat add-group-option"><i class="fa fa-plus"></i> Add </button>
	            	<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Submit </button>
	            </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
	$(function(){
		var count = 1;
		$('.add-group-option').on('click', function(){
			var loop = count++;
			var groupParent = $('#modalgroupparent').val();
        	var options = '<hr><input type="hidden" name="option[' + loop + '][group_parent]" value="' + groupParent + '">'
        	+'<div id="groupoptions">'
				+'<div class="form-group">'
			      	+'<label>Group Type</label>'
			      	+'<select class="form-control" name="option[' + loop + '][group_type]">'
			      		+'<option value="0">Child</option>'
			      		+'<option value="1">Parent</option>'
			      	+'</select>'
			    +'</div>'
		    	+'<div class="form-group">'
		          	+'<label>Group Description</label>'
		          	+'<input type="text" class="form-control" name="option[' + loop + '][group_description]" autocomplete="group-description" maxlength="100" required>'
		        +'</div>'
        	+'</div>'
        	$('#groupoptions').append(options);
		});
	})
</script>
@endpush