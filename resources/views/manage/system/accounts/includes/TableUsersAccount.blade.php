<table class="table table-bordered" id="users_table">
	<thead>
		<tr style="font-size: 12px; white-space: nowrap;">
			<th class="text-center" style="vertical-align: top; width: 03%"> ID </th>
			@if($allSelected)
			<th class="text-center" style="vertical-align: top; width: 15%"> COMPANY </th>
			@endif
			<th class="text-center" style="vertical-align: top; width: 20%"> FULL NAME </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> EMAIL ADDRESS </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> CONTACT NUMBER </th>
			<th class="text-center" style="vertical-align: top; width: 10%"> STATUS </th>
			<th class="text-center" style="vertical-align: top; width: 10%"> ACTION </th>
		</tr>
	</thead>
	<tbody>
		@forelse($allUsers as $key => $value)
		<tr style="font-size: 12px; white-space: nowrap;">
			<td class="text-center" style="vertical-align: middle;">{{ $value->users_id }}</td>
			@if($allSelected)
			<td style="vertical-align: middle;">{{ $value->companyInfo['company_code'] }}</td>
			@endif
			<td style="vertical-align: middle;">{{ $value->firstname }} {{ $value->middlename }} {{ $value->lastname }} </td>
			<td style="vertical-align: middle;">{{ $value->personal_email }}</td>
			<td style="vertical-align: middle;">{{ $value->personal_contact_phone }}</td>
			<td class="text-center" style="padding-top: 5px; padding-bottom: 0px; vertical-align: middle;"> 
				<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->users_id }}" onclick="return updateStatus(this.id,'{{ route('accounts.route',['path' => $path, 'action' => 'toggle-users-profile', 'id' => encrypt($value->users_id)]) }}')" style="font-size: 23px; cursor: pointer;"></i> 
			</td>
			<td class="text-center">
				<a href="{{ route('accounts.route',['path' => 'users', 'action' => 'users-profile', 'id' => encrypt($value->users_id)]) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="User Profile" data-placement="top"> &nbsp; <i class="fa fa-edit"></i>&nbsp; </a>
				<a href="{{ route('accounts.route',['path' => 'users', 'action' => 'users-company', 'id' => encrypt($value->users_id)]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="User Access" data-placement="top"> &nbsp; <i class="fa fa-cogs"></i>&nbsp; </a>
			</td>
		</tr>
		@empty
		<tr>
			<td colspan="6"> No result's found. </td>
		</tr>
		@endforelse
	</tbody>
</table>
