<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'update-users-module', 'id' => encrypt($thisUserAccount->users_id)]) }}" id="form_update_users_module">
	{{ csrf_field() }}
	<table class="table table-bordered table-condensed table-hover users-module-access-datatables" id="users_table">
		<thead>
			<tr class="bg-gray-light" style="font-size: 12px; white-space: nowrap;">
				<th class="text-center" style="vertical-align: top; width: 05%"> </th>
				{{-- <th class="text-center" style="vertical-align: top; width: 20%"> MODULE CODE </th> --}}
				<th class="text-center" style="vertical-align: top; width: 95%"> MODULE DESCRIPTION </th>
			</tr>
		</thead>
		<tbody id="users_table_body">

			@forelse($companyModule as $key => $value)

				<tr style="font-size: 12px; white-space: nowrap;">
					<td class="text-center no-padding" style="vertical-align: middle;">
						<input type="hidden" name="module[{{ $key }}][company_id]" value="{{ encrypt($companyId) }}">
						<input type="hidden" name="module[{{ $key }}][module_id]" value="{{ encrypt($value->module_id) }}">
						<input type="checkbox" class="method-checkbox" name="module[{{ $key }}][checkbox]" {{ (in_array($value->module_id, $moduleAccess)) ? 'checked' : '' }} style="width: 16px; height: 16px;">
					</td>
					{{-- <td style="text-transform: uppercase; vertical-align: middle;"> {{ $value->module_code }} </td> --}}
					<td style="vertical-align: middle;"> {{ $value->module_description }} </td>
				</tr>

			@empty

				<tr style="font-size: 12px; white-space: nowrap;">
					<td colspan="3" class="text-center">No result's found.</td>
				</tr>

			@endforelse

		</tbody>

	</table>
	
</form>
