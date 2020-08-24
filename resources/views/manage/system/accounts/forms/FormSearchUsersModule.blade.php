<form method="post" action="{{ route('accounts.route', ['path' => $path, 'action' => 'search-users-module-table', 'id' => encrypt($thisUserAccount->users_id)]) }}" id="form_search_users_module" data-request="json"> 
	{{ csrf_field() }}
	<table class="table table-bordered">
		<tr>
			<td colspan="2" style="padding-right: 0px;">
				<div class="text-right">
					<button type="submit" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
					<button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
					<button type="button" class="btn btn-primary btn-sm" onclick="updateUsersModule()"><i class="fa fa-save"></i> UPDATE </button>
				</div>
			</td>
		</tr>
		<tr style="white-space: nowrap;">
			<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 20%;">
				SELECT COMPANY: 
			</td>
			<td style="padding: 0px;" colspan="3">
				<select class="form-control input-sm" id="company_id" name="company_id" onchange="return submitFormSearch()" required>
		            @foreach($usersCompany as $key => $value)
		            <option value="{{ $value->company_id }}" {{ ($value->company_id == $thisUserAccount->company_id) ? 'selected' : ''}}> {{ strtoupper($value->company_code) }} - {{ strtoupper($value->company_name) }} {{ ($value->company_id == $thisUserAccount->company_id) ? ' (DEFAULT COMPANY)' : ''}}</option>
		            @endforeach
		        </select>
			</td>
		</tr>
	</table>
</form>