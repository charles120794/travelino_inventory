<form method="post" action="{{ route('settings.route',['path' => $path, 'action' => $updateWindow, 'id' => encrypt('')]) }}" id="form_update_window">
	{{ csrf_field() }}
	<table class="table table-condensed checkbox-check table-hover table-bordered">

		<thead>
			<tr>
				<th class="text-center" style="min-width: 20px"> <i class="fa fa-check-square-o" style="cursor: pointer;"></i> </th>
				<th class="text-center" style="width: 40px"> LVL. </th>
				<th class="text-center" style="min-width: 200px;"> ICON </th>
				<th class="text-center" style="min-width: 250px"> ORIG. DESCRIPTION </th>
				<th class="text-center" style="min-width: 250px;"> PARENT CLASS </th>
				<th class="text-center" style="min-width: 150px;"> PATH </th>
				<th class="text-center" style="width: 60px;"> DDTYP </th>
			</tr>
		</thead>

		<tbody>

			@include('manage.system.settings.includes.WindowNestedLooping', ['allWindow' => $allWindow, 'margin' => '0'])

			@if(count($allWindow) == 0)
			<td class="text-center" colspan="8">
				No result's found. Please select module.
			</td>
			@endif

		</tbody>

	</table>

</form>