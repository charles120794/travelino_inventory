<form id="form_search_system_window" action="{{ route('settings.route',['path' => $path , 'action' => 'settings-search-system-window', 'id' => Crypt::encrypt('')]) }}" method="post"> {{ csrf_field() }}
	<div class="row">
		<div class="col-lg-12">
			<?php $usersModule = new App\Http\Controllers\Admin\ModuleController; ?>
			<table class="table table-bordered table-condensed" style="font-size: 12px;">
				<tr>
					<th style="width: 15%;"> SELECT MODULE </th>
					<td class="no-padding" style="width: 35%;">
						<select class="form-control input-sm" id="filter_module" name="filter_module" onchange="submitFormSearch()">
							<option value=""> SELECT ALL </option>
							@foreach($usersModule->usersModule() as $key => $value)
							<option value="{{ $value->module_code }}"> {{ strtoupper($value->module_code) }} - {{ $value->module_description }} </option>
							@endforeach
						</select>
					</td>
					<th style="width: 15%; padding-left: 10px;"> DESCRIPTION </th>
					<td class="no-padding" style="width: 35%;">
						<input type="text" class="form-control input-sm" id="filterDescription" name="filterDescription" oninput="submitFormSearch()" autocomplete="off">
					</td>
				</tr>
				<tr>
					<th> MENU LEVEL </th>
					<td class="no-padding">
						<select class="form-control input-sm" id="filterLevel" name="filterLevel" onchange="submitFormSearch()">
							<option value=""> SELECT ALL </option>
							<option value="1"> FIRST </option>
							<option value="2"> SECOND </option>
							<option value="3"> THIRD </option>
						</select>
					</td>
					<th style="padding-left: 10px;"> MENU ICON </th>
					<td class="no-padding">
						<input type="text" class="form-control input-sm" id="filterIcon" name="filterIcon" oninput="submitFormSearch()" autocomplete="off">
					</td>
				</tr>
				<tr>
					<th> MENU PARENT </th>
					<td class="no-padding">
						<select class="form-control input-sm" id="filterClass" name="filterClass" onchange="submitFormSearch()">
							<option value=""> SELECT ALL </option>
							<option value="0"> Main Class </option>
							@foreach(app('SystemWindow')->where('menu_type','1')->where('menu_status','1')->get() as $key => $parent)
							<option value="{{ $parent->menu_id }}">
								{{ $parent->menu_name }}
							</option>
							@endforeach
						</select>
					</td>
					<th style="padding-left: 10px;"> MENU PATH </th>
					<td class="no-padding">
						<input type="text" class="form-control input-sm" id="filterPath" name="filterPath" oninput="submitFormSearch()" autocomplete="off">
					</td>
				</tr>
			</table>
		</div>
		<div class="col-lg-12 text-right">
			<button type="button" class="btn btn-warning btn-sm" onclick="submitFormSearch()">
				<i class="fa fa-search"></i> SEARCH
			</button>
			<button type="button" class="btn btn-primary btn-sm" onclick="updateUsersWindow('form_update_users_window')">
				<i class="fa fa-save"></i> UPDATE
			</button>
			<button type="button" class="btn btn-danger btn-sm" onclick="deleteUsersWindow('form_users_window')">
				<i class="fa fa-save"></i> DELETE
			</button>
		</div>
	</div>
</form>
