<input type="hidden" name="company_id" value="{{ Crypt::encrypt($company_id) }}">
<table class="table table-bordered table-condensed table-hover" id="users_table">
	<thead>
		<tr style="font-size: 12px;">
			<th class="text-center" style="vertical-align: top; width: 03%"> </th>
			<th class="text-center" style="vertical-align: top; width: 03%"> LEVEL </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> MODULE CODE </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> MODULE DESCRIPTION </th>
		</tr>
	</thead>
	<tbody id="users_table_body">
		@foreach( $module as $key => $value )
			<tr style="font-size: 12px; white-space: nowrap;">
				<td class="text-center no-padding" style="vertical-align: middle;">
					<input type="hidden" name="module[{{ $key }}][company_id]" value="{{ Crypt::encrypt($company_id) }}">
					<input type="hidden" name="module[{{ $key }}][module_id]" value="{{ Crypt::encrypt($value->module_id) }}">
					<input type="checkbox" class="method-checkbox" name="module[{{ $key }}][checkbox]" {{ (in_array($value->module_id,$companyModuleAccess)) ? 'checked' : '' }} style="width: 16px; height: 16px;">
				</td>
				<td class="text-center"> {{ $value->order_level }} </td>
				<td style="text-transform: uppercase; vertical-align: middle;"> {{ $value->module_code }} </td>
				<td style="vertical-align: middle;"> {{ $value->module_description }} </td>
			</tr>
		@endforeach
	</tbody>
</table>