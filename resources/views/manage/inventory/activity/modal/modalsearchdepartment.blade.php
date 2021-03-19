<div class="modal fade" id="modalsearchdepartment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
    		<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-plus"></i> Contact </h4>
    		</div>
    		<div class="modal-body">
    			<table class="table table-bordered">
	                <thead>
	                    <tr class="bg-gray-light" style="height: 50px;">
	                        <th class="text-center" style="vertical-align: middle;">Code</th>
	                        <th class="text-center" style="vertical-align: middle;">Description</th>
	                        <th class="text-center" style="vertical-align: middle;">Action</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @forelse($department as $key => $value)
	                    <tr class="searchable">
	                        <td style="vertical-align: middle;">{{ $value->department_code }}</td>
	                        <td style="vertical-align: middle;">{{ $value->department_description }}</td>
	                        <td class="text-center">
	                            <button class="btn btn-primary btn-flat selected-department" data-contact="{{ $value->department_id }}" data-description="{{ $value->department_description }}">Select</button>
	                        </td>
	                    </tr>
	                    @empty
	                    <tr class="not-searchable">
	                        <td class="text-center" colspan="3"> No result's found </td>
	                    </tr>
	                    @endforelse
	                </tbody>
	            </table>
    		</div>
    		<div class="modal-footer">
    			<button type="submit" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
    		</div>
        </div>
    </div>
</div>