<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'search-company-users-table', 'id' => encrypt('1') ]) }}" id="form_search_company_users" data-request="json">
    {{ csrf_field() }}
    <table class="table table-bordered">
        <tr style="white-space: nowrap;">
            <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 15%;">
                SELECT COMPANY: 
            </td>
            <td style="padding: 0px;">
                <select class="form-control input-sm" id="company_id" name="company_id" onchange="return submitFormSearch()" required>
                    <option value="">--SELECT ALL--</option>
                    @foreach($usersCompany as $key => $value)
                    <option value="{{ $value->company_id }}" {{ ($value->company_id == $thisUser->company_id) ? 'selected' : ''}}> {{ strtoupper($value->company_code) }} - {{ strtoupper($value->company_name) }} {{ ($value->company_id == $thisUser->company_id) ? ' (DEFAULT COMPANY)' : ''}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    </table>
</form>