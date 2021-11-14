<form method="post" action="{{ route('actions.route',['path' => $path, 'action' => 'search-users-window-method-table', 'id' => encrypt($thisUserAccount->users_id)]) }}" id="form_search_users_method" data-request="json"> 
    {{ csrf_field() }}
    <table class="table table-bordered">
        <tr>
            <td colspan="2">
                <div class="text-right">
                    <button type="submit" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
                    <button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="updateUserMethod()"><i class="fa fa-save"></i> UPDATE </button>
                </div>
            </td>
        </tr>
        <tr style="white-space: nowrap;">
            <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 20%;">
                SELECT COMPANY: 
            </td>
            <td style="padding: 0px;" colspan="3">
                <select class="form-control" id="company_id" name="company_id" onchange="return selectedCompany(this)" required>
                    <option value="" selected>-- Select Company --</option>
                    @foreach($usersCompany as $key => $value)
                    <option value="{{ $value->company_id }}"> {{ strtoupper($value->company_name) }} {{ ($value->company_id == $thisUserAccount->company_id) ? ' (DEFAULT COMPANY)' : ''}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr style="white-space: nowrap;">
            <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
                SELECT MODULE:
            </td>
            <td style="padding: 0px;" colspan="3">
                <select class="form-control" id="module_id" name="module_id" onchange="return selectedModule(this)" disabled required>
                    <option value="" selected>-- Select Module --</option>
                </select>
            </td>
        </tr>
        <tr style="white-space: nowrap;">
            <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
                SELECT WINDOW: 
            </td>
            <td style="padding: 0px;" colspan="3">
                <select class="form-control" id="window_id" name="window_id" onchange="return submitFormSearch()" disabled required>
                    <option value="" selected>-- Select Window --</option>
                </select>
            </td>
        </tr>
    </table>
</form>