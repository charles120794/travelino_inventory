<table class="table table-bordered table-hover">

	<thead>

		<tr style="font-size: 12px;">
			<th class="text-center" style="vertical-align: top; width: 2%"> ID </th>
			<th class="text-center" style="vertical-align: top; width: 15%"> CODE </th>
			<th class="text-center" style="vertical-align: top; width: 25%"> NAME </th>
			<th class="text-center" style="vertical-align: top; width: 25%"> DESCRIPTION </th>
			<th class="text-center" style="vertical-align: top; width: 25%"> ICON (font-awesome & glyphicon) </th>
			<th class="text-center" style="vertical-align: top; width: 25%"> ACTION </th>
		</tr>

	</thead>

	<tbody>

		@foreach($allModule as $key => $value)

			<tr style="font-size: 12px; white-space: nowrap;">
				<td class="text-center" style="vertical-align: middle;">{{ $key + 1 }}</td>
				<td style="vertical-align: middle;">{{ $value->module_code }}</td>
				<td style="vertical-align: middle;">{{ $value->module_name }}</td>
				<td style="vertical-align: middle;">{{ $value->module_description }}</td>
				<td style="vertical-align: middle;">{{ $value->module_icon }}</td>
				<td class="text-center">
					<a href="{{ route('settings.route',['path' => $path, 'action' => 'edit-system-module', 'id' => encrypt($value->module_id) ]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
					<a href="{{ route('settings.route',['path' => $path, 'action' => 'delete-system-module', 'id' => encrypt($value->module_id) ]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this module?')"><i class="fa fa-trash"></i></a>
				</td>
			</tr>

		@endforeach

	</tbody>

</table>
