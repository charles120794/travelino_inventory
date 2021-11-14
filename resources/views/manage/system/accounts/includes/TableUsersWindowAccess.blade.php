<form method="post" action="{{ route('actions.route',['path' => $path,'action' => 'update-users-window','id' => encrypt($thisUserAccount->users_id)]) }}" id="form_update_users_window">

	{{ csrf_field() }}

	<table class="table table-bordered table-condensed table-hover users-window-access-datatables" id="users_table">

		<thead>
			<tr class="bg-gray-light" style="font-size: 12px; white-space: nowrap;">
				<th class="text-left" style="width: 5%;"> <i class="fa fa-check-square-o" style="cursor: pointer;"></i> </th>
				<th class="text-left" style="width: 30%;"> DESCRIPTION </th>
				<th class="text-left" style="width: 60%;"> PATH </th>
			</tr>
		</thead>

		<tbody id="users_table_body">

			@foreach(collect($allWindow)->sortBy('order_level') as $key => $value)

				<tr style="font-size: 12px;">

					<td class="text-center" style="padding-bottom: 0px;">

						<input type="hidden" name="window[{{ $key }}][users_id]" value="{{ encrypt($thisUserAccount->users_id) }}">

						<input type="hidden" name="window[{{ $key }}][module_id]" value="{{ encrypt($moduleId) }}">
						<input type="hidden" name="window[{{ $key }}][company_id]" value="{{ encrypt($companyId) }}">

						<input type="hidden" name="window[{{ $key }}][menu_id]" value="{{ encrypt($value->menu_id) }}">

						<input type="hidden" name="window[{{ $key }}][menu_type]" value="{{ encrypt($value->menu_type) }}">
						<input type="hidden" name="window[{{ $key }}][menu_parent]" value="{{ encrypt($value->menu_parent) }}">
						<input type="hidden" name="window[{{ $key }}][order_level]" value="{{ encrypt($value->order_level) }}">
						<input type="hidden" name="window[{{ $key }}][menu_name]" value="{{ $value->menu_name }}">

						<input type="checkbox" name="window[{{ $key }}][checkbox]" class="method-checkbox" {{ (in_array($value->menu_id, $windowAccess)) ? 'checked' : '' }} style="height: 17px; width: 17px; background-color: transparent;">

					</td>

					<td style="vertical-align: middle;"> 
						<i class="{{ $value->menu_icon }}"></i> {{ $value->menu_name }} 
					</td>

					<td style="vertical-align: middle;"> {{ ucfirst($value->menu_path) }} </td>

				</tr>

			@endforeach

		</tbody>

	</table>

</form>
