<form method="post" action="{{ route('settings.route',['path' => $path, 'action' => $formSearchModule , 'id' => encrypt('') ]) }}"> 
	<table class="table table-condensed table-bordered">
		<tr>
			<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 20%;">
				SELECT COMPANY 
			</td>
			<td class="no-padding">
				<select class="form-control input-sm" name="company_id" onchange="submitFormSearch()">
					<option value="">-- Select Company --</option>
					@foreach($usersCompanyAccess as $key => $value)
					<option value="{{ $value->company_id }}"> {{ $value->company_code }} - {{ $value->company_description }} </option>
					@endforeach
				</select>
			</td>
		</tr>
	</table>
	{{ csrf_field() }}
</form>