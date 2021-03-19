<div class="modal fade" id="modalsearchcontact">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
    		<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-plus"></i> Contact </h4>
    		</div>
    		<div class="modal-body">
    			<table class="table table-bordered table-hover">
	                <thead>
	                    <tr class="bg-gray-light" style="height: 50px;">
	                        <th class="text-center" style="vertical-align: middle;">Code</th>
	                        <th class="text-center" style="vertical-align: middle;">Description</th>
	                        <th class="text-center" style="vertical-align: middle;">Mobile / Phone No.</th>
	                        <th class="text-center" style="vertical-align: middle;">Contact Position</th>
	                        <th class="text-center" style="vertical-align: middle;">E-mail</th>
	                        <th class="text-center" style="vertical-align: middle;">Action</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @forelse($contact as $key => $value)
	                    <tr>
	                        <td style="vertical-align: middle;">{{ $value->contact_code }}</td>
	                        <td style="vertical-align: middle;">{{ $value->contact_description }}</td>
	                        <td style="vertical-align: middle;">{{ $value->contact_number }}</td>
	                        <td style="vertical-align: middle;">{{ $value->contact_position }}</td>
	                        <td style="vertical-align: middle;">{{ $value->contact_email }}</td>
	                        <td class="text-center">
	                            <button class="btn btn-primary btn-flat selected-contact" data-contact="{{ $value->contact_id }}" data-description="{{ $value->contact_description }}">Select</button>
	                        </td>
	                    </tr>
	                    @empty
	                    <tr>
	                        <td class="text-center" colspan="6"> No result's found </td>
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