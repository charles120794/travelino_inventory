<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'update-users-company', 'id' => encrypt($thisUserAccount->users_id)]) }}" id="form_update_users_company">
	{{ csrf_field() }}
	<table class="table table-bordered table-condensed table-hover" id="users_table">
		<thead>
			<tr style="font-size: 12px; white-space: nowrap;">
				<th class="text-center" style="vertical-align: top; width: 5%">  ID </th>
				<th class="text-center" style="vertical-align: top; width: 5%"> COMPANY CODE </th>
				<th class="text-center" style="vertical-align: top; width: 30%"> COMPANY NAME </th>
				<th class="text-center" style="vertical-align: top; width: 60%"> COMPANY DESCRIPTION </th>
			</tr>
		</thead>
		<tbody>

			@forelse($systemCompany as $key => $value)

				<tr style="font-size: 12px; white-space: nowrap;">
					<td class="text-center">
						<input type="hidden" name="company[{{ $key }}][users_id]" value="{{ encrypt($thisUserAccount->users_id) }}">
						<input type="hidden" name="company[{{ $key }}][company_id]" value="{{ encrypt($value->company_id) }}">
						<input type="checkbox" class="method-checkbox" name="company[{{ $key }}][checkbox]" {{ (in_array($value->company_id, $usersCompany)) ? 'checked' : '' }} style="height: 16px; width: 16px;" @if($thisUserAccount->company_id == $value->company_id) onclick="return false" @endif>
					</td>
					<td style="vertical-align: middle;"> 
						{{ $value->company_code }}
					</td>
					<td style="vertical-align: middle;"> 
						{{ $value->company_name }} @if($thisUserAccount->company_id == $value->company_id) (DEFAULT COMPANY) @endif
					</td>
					<td style="vertical-align: middle;"> {{ $value->company_description }} </td>
				</tr>

			@empty

				<tr style="font-size: 12px; white-space: nowrap;">
					<td colspan="4" class="text-center">No result's found.</td>
				</tr>

			@endforelse

		</tbody>

	</table>
	
</form>
