<div class="row">
	<div class="col-lg-12" style="overflow: auto;">
		<table class="table table-bordered table-condensed" id="users_table">
			<thead>
				<tr style="font-size: 12px; white-space: nowrap;">
					<th class="text-center" style="vertical-align: top; width: 50px;"> ID </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> CODE </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> NAME </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> DESCRIPTION </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> TAGLINE </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> STATUS </th>
					<th class="text-center" style="vertical-align: top; min-width: 150px;"> ACTION </th>
				</tr>
			</thead>
			<tbody id="users_table_body">
				@foreach($allCompany as $key => $value)
					<tr style="font-size: 12px;">
						<td class="text-center" style="vertical-align: middle;">{{ ($key + 1) }}</td>
						<td style="vertical-align: middle;">{{ $value->company_code }}</td>
						<td style="vertical-align: middle;">{{ $value->company_name }}</td>
						<td style="vertical-align: middle;">{{ $value->company_description }}</td>
						<td style="vertical-align: middle;">{{ $value->company_tagline }}</td>
						<td class="text-center" style="padding-top: 5px; padding-bottom: 0px; vertical-align: middle;"> 
							<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->company_id }}" onclick="return updateStatus(this.id,'{{ route('settings.route',['path' => $path, 'action' => 'settings-toggle-users-company', 'id' => Crypt::encrypt($value->company_id)]) }}')" style="font-size: 22px; cursor: pointer;"></i>
						</td>
						<td class="text-center">
							<a href="{{ route('settings.route',['path' => $path, 'action' => 'edit-system-company', 'id' => encrypt($value->company_id)]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
							<a href="{{ route('settings.route',['path' => $path, 'action' => 'delete-system-company', 'id' => encrypt($value->company_id)]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Company?')"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@push('scripts')

<script type="text/javascript">

	function updateStatus(id,url){
		if($('#'+id).hasClass('fa-toggle-on')){
			$('#'+id).removeClass('fa-toggle-on')
			.removeClass('text-orange')
			.addClass('fa-toggle-off').addClass('text-red');
			$.get(url,{status:0},function(count){
				
			});
		} else if($('#'+id).hasClass('fa-toggle-off')){
			$('#'+id).removeClass('fa-toggle-off')
			.removeClass('text-red')
			.addClass('fa-toggle-on').addClass('text-orange');
			$.get(url,{status:1},function(count){
				
			});
		}
	}
	
</script>

@endpush