<form method="post" action="{{ route('accounts.route',['path' => $path,'action' => 'update-users-window','id' => encrypt($thisUserAccount->users_id)]) }}" id="form_update_users_window">
	{{ csrf_field() }}
	<table class="table table-bordered table-condensed table-hover" id="users_table">
		<thead>
			<tr style="font-size: 12px; white-space: nowrap;">
				<th class="text-center" style="min-width: 20px"> <i class="fa fa-check-square-o" style="cursor: pointer;"></i> </th>
				<th class="text-center" style="min-width: 250px"> DESCRIPTION </th>
				<th class="text-center" style="min-width: 150px;"> PATH </th>
			</tr>
		</thead>
		<tbody id="users_table_body">

			@forelse($allWindow as $key => $value)

				<tr style="font-size: 12px;">
					<td class="text-center" style="padding-bottom: 0px;">
						<input type="hidden" name="window[{{ $key }}][users_id]" value="{{ encrypt($thisUserAccount->users_id) }}">
						<input type="hidden" name="window[{{ $key }}][menu_id]" value="{{ encrypt($value->menu_id) }}">
						<input type="hidden" name="window[{{ $key }}][module_id]" value="{{ encrypt($moduleId) }}">
						<input type="hidden" name="window[{{ $key }}][company_id]" value="{{ encrypt($companyId) }}">
						<input type="hidden" name="window[{{ $key }}][menu_type]" value="{{ encrypt($value->menu_type) }}">
						<input type="hidden" name="window[{{ $key }}][menu_parent]" value="{{ encrypt($value->menu_parent) }}">
						<input type="checkbox" name="window[{{ $key }}][checkbox]" class="method-checkbox" {{ (in_array($value->menu_id, $windowAccess)) ? 'checked' : '' }} style="height: 17px; width: 17px; background-color: transparent;">
					</td>
					<td style="vertical-align: middle;"> <i class="{{ $value->menu_icon }}"></i> {{ $value->menu_name }} </td>
					<td style="vertical-align: middle;"> {{ $value->menu_path }} </td>
				</tr>

			@empty

				<tr style="font-size: 12px; white-space: nowrap;">
					<td colspan="3" class="text-center">No result's found.</td>
				</tr>

			@endforelse

		</tbody>
	</table>
</form>
