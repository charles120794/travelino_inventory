<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'update-users-company', 'id' => encrypt($thisUserAccount->users_id)]) }}" id="form_update_users_company">
	{{ csrf_field() }}
	<table class="table table-bordered table-condensed table-hover users-company-access-datatables" id="users_table">
		<thead>
			<tr class="bg-gray-light" style="font-size: 12px; white-space: nowrap;">
				<th class="text-center" style="vertical-align: top; width: 5%">  </th>
				<th class="text-center" style="vertical-align: top; width: 5%"> DEFAULT </th>
				<th class="text-center" style="vertical-align: top; width: 5%"> COMPANY CODE </th>
				<th class="text-center" style="vertical-align: top; width: 30%"> COMPANY NAME </th>
				<th class="text-center" style="vertical-align: top; width: 65%"> COMPANY DESCRIPTION </th>
			</tr>
		</thead>
		<tbody>

			@foreach($systemCompany as $key => $value)

				<tr style="font-size: 12px; white-space: nowrap;">

					<td class="text-center">
						<input type="hidden" name="company[{{ $key }}][users_id]" value="{{ encrypt($thisUserAccount->users_id) }}">
						<input type="hidden" name="company[{{ $key }}][company_id]" value="{{ encrypt($value->company_id) }}">
						<input type="checkbox" class="method-checkbox" name="company[{{ $key }}][checkbox]" 
							{{ (in_array($value->company_id, $usersCompany)) ? 'checked' : '' }} 
							style="height: 16px; width: 16px;" 
							@if($usersDefaultCompany == $value->company_id) onclick="alert('Default Company'); return false;" @endif>
					</td>

					<td class="text-center">
						<input type="checkbox" class="method-checkbox" name="company[{{ $key }}][default_id]" value="{{ encrypt($value->company_id) }}" style="height: 16px; width: 16px;" {{ ($usersDefaultCompany == $value->company_id) ? 'checked' : '' }} >
					</td>

					<td style="vertical-align: middle;"> {{ $value->company_code }} </td>

					<td style="vertical-align: middle;"> 
						{{ $value->company_name }} @if($usersDefaultCompany == $value->company_id) (DEFAULT COMPANY) @endif
					</td>

					<td style="vertical-align: middle;"> {{ $value->company_description }} </td>

				</tr>

			@endforeach

		</tbody>

	</table>
	
</form>
