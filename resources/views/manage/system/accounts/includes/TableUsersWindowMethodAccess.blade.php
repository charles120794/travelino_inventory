<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'update-users-window-method', 'id' => encrypt($thisUserAccount->users_id)]) }}" id="form_update_users_method">
	{{ csrf_field() }}
	<table class="table table-bordered table-condensed table-hover users-method-access-datatables" id="users_table">
		<thead>
			<tr class="bg-gray-light" style="font-size: 12px; white-space: nowrap;">
				<th class="text-center" style="vertical-align: top; width: 05%"> </th>
				<th class="text-center" style="vertical-align: top; width: 80%"> ACTION REQUIRED </th>
				{{-- <th class="text-center" style="vertical-align: top; width: 20%"> ACTION ROUTE </th> --}}
				<th class="text-center" style="vertical-align: top; width: 15%"> WINDOW TYPE </th>
			</tr>
		</thead>
		<tbody id="users_table_body">

			@foreach($allMethods as $key => $value)

				<tr style="font-size: 12px; white-space: nowrap;">
					<td class="text-center">
						<input type="checkbox" class="method-checkbox" name="method[{{ $key }}][checkbox]" style="height: 17px; width: 17px;" {{ (in_array($value->method_id, $methodAccess)) ? 'checked' : '' }}>
						<input type="hidden" name="method[{{ $key }}][menu_id]" value="{{ encrypt($value->menu_id) }}">
						<input type="hidden" name="method[{{ $key }}][method_id]" value="{{ encrypt($value->method_id) }}">
						<input type="hidden" name="method[{{ $key }}][company_id]" value="{{ encrypt($companyId) }}">
						<input type="hidden" name="method[{{ $key }}][module_id]" value="{{ encrypt($moduleId) }}">
					</td>
					<td style="vertical-align: middle;">{{ Str::title(str_replace('-', ' ', $value->method_name)) }}</td>
					{{-- <td style="vertical-align: middle;">{{ Str::title(str_replace('_', ' ', $value->method_function)) }}</td> --}}
					<td style="vertical-align: middle;">{{ (is_null($value->method_blade)) ? 'CRUD' : 'DISPLAY' }}</td>
				</tr>

			@endforeach

		</tbody>

	</table>

</form>
