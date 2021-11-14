<table class="table table-bordered users-account-datatables" id="users_table">

	<thead>

		<tr class="bg-gray-light" style="font-size: 12px; white-space: nowrap;">
			<th class="text-center" style="vertical-align: top; width: 10%"> ID </th>
			<th class="text-center" style="vertical-align: top; width: 10%"> COMPANY </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> FULL NAME </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> EMAIL ADDRESS </th>
			<th class="text-center" style="vertical-align: top; width: 20%"> CONTACT NUMBER </th>
			<th class="text-center" style="vertical-align: top; width: 10%"> STATUS </th>
			<th class="text-center" style="vertical-align: top; width: 10%"> ACTION </th>
		</tr>

	</thead>

	<tbody>

		@foreach($companyUsers as $key => $value)

			<tr style="font-size: 12px; white-space: nowrap;">
				<td class="text-center" style="vertical-align: middle;">{{ $value->users_id }}</td>
				<td style="vertical-align: middle;">{{ $value->companyDefaultAccess->companyInfo['company_code'] }}</td>
				<td style="vertical-align: middle;">{{ $value->firstname }} {{ $value->middlename }} {{ $value->lastname }} </td>
				<td style="vertical-align: middle;">{{ $value->personal_email }}</td>
				<td style="vertical-align: middle;">{{ $value->personal_contact_phone }}</td>
				<td class="text-center" style="padding-top: 5px; padding-bottom: 0px; vertical-align: middle;"> 
					<i class="{{ ($value->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $value->users_id }}" onclick="return updateStatus(this.id,'{{ route('actions.route',['path' => $path, 'action' => 'toggle-users-profile', 'id' => encrypt($value->users_id)]) }}')" style="font-size: 23px; cursor: pointer;"></i> 
				</td>

				<td class="text-center">
					
					{{-- <a href="{{ route('actions.route',['path' => 'users', 'action' => 'users-company', 'id' => encrypt($value->users_id)]) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="User Access" data-placement="top"> &nbsp; <i class="fa fa-cogs"></i>&nbsp; </a> --}}

					<div class="dropdown">
						<a href="{{ route('accounts.route',['path' => 'users', 'action' => 'users-profile', 'id' => encrypt($value->users_id)]) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="User Profile" data-placement="top"> &nbsp; <i class="fa fa-edit"></i>&nbsp; </a>
					  	<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"> Users Access
					  	<span class="caret"></span></button>
					  	<ul class="dropdown-menu">
					    	<li><a href="{{ route('accounts.route',['path' => 'users', 'action' => 'users-company', 'id' => encrypt($value->users_id)]) }}"> Company </a></li>
					    	<li><a href="{{ route('accounts.route',['path' => 'users', 'action' => 'users-module', 'id' => encrypt($value->users_id)]) }}"> Module </a></li>
					    	<li><a href="{{ route('accounts.route',['path' => 'users', 'action' => 'users-window', 'id' => encrypt($value->users_id)]) }}"> Window </a></li>
					    	<li><a href="{{ route('accounts.route',['path' => 'users', 'action' => 'users-method', 'id' => encrypt($value->users_id)]) }}"> Roles </a></li>
					  	</ul>
					</div>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
