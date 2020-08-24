<form method="post" id="form_search_system_window"> {{ csrf_field() }}
    <table class="table table-bordered">
        <tr style="white-space: nowrap;">
            <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 20%;">
                SELECT COMPANY: 
            </td>
            <td style="padding: 0px;" colspan="3">
                <select class="form-control input-sm" id="company_id" name="company_id" onchange="return selectedCompany(this)" required>
                    @foreach($usersCompany as $key => $value)
                    <option value="{{ $value->company_id }}" {{ ($value->company_id == $thisUser->company_id) ? 'selected' : ''}}> {{ strtoupper($value->company_code) }} - {{ strtoupper($value->company_name) }} {{ ($value->company_id == $thisUser->company_id) ? ' (ACTIVE COMPANY)' : ''}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
                SELECT MODULE:
            </td>
            <td style="padding: 0px;" colspan="3">
                <select class="form-control input-sm" id="module_id" name="module_id" onchange="return selectedModule(this)">
                    <option value=""> SELECT MODULE </option>
                    @foreach($usersModule as $key => $value)
                    <option value="{{ $value->module_id }}"> {{ strtoupper($value->module_description) }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 0px;" colspan="2">
                <div class="text-right" id="submit_buttons">
                    <button type="button" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
                    <button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="updateUsersWindow()"><i class="fa fa-save"></i> UPDATE </button>
                </div>
            </td>
        </tr>
    </table>
</form>