<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'search-users-company-table', 'id' => encrypt($thisUserAccount->users_id)]) }}" id="form_search_users_company" data-request="json"> 
	{{ csrf_field() }}
	<table class="table table-bordered">
		<tr>
			<td colspan="2" style="padding-right: 0px;">
				<div class="text-right">
					<button type="submit" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
					<button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
					<button type="button" class="btn btn-primary btn-sm" onclick="updateUsersCompany()"><i class="fa fa-save"></i> UPDATE </button>
				</div>
			</td>
		</tr>
		<tr style="white-space: nowrap;">
            <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 15%;">
                SEARCH COMPANY: 
            </td>
            <td style="padding: 0px;">
                <input class="form-control input-sm" id="company_id" name="company_id" onchange="return submitFormSearch()" placeholder="Search Company">
            </td>
        </tr>
	</table>
</form>