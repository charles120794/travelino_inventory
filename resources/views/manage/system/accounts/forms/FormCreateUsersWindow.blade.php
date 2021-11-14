<form id="form_addwindow" action="{{ route('actions.route',['path' => $path, 'action' => 'accounts-create-users-window' , 'id' => Crypt::encrypt('') ]) }}" method="post"> {{ csrf_field() }} {{ csrf_field() }}
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
			<table class="table table-bordered">
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						SELECT MODULE: 
					</td>
					<td style="padding: 0px;">
						<select class="form-control input-sm" id="module_id" name="module_id" onchange="return selectModule(this)" required>
				            <option value="" selected> SELECT MODULE </option>
				            @foreach($thisUser->moduleAccess as $key => $value)
				            <option value="{{ $value->moduleInfo->module_id }}"> {{ strtoupper($value->moduleInfo->module_code) }} - {{ $value->moduleInfo->module_description }} </option>
				            @endforeach
				        </select>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						MENU CLASS:
					</td>
					<td style="padding: 0px;">
						<select class="form-control input-sm" name="menu_parent" id="menu_parent" style="border-radius: 0px; text-transform: uppercase;" required>
				            <option value="0" selected> MAIN CLASS </option>
				        </select>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						MENU DESCRIPTION:
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="menu_name" autocomplete="off">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						MENU PATH: 
					</td>
					<td style="padding: 0px;">
						<div class="input-group">
				            <span class="input-group-addon" style="background-color: #EDEDED;">{{ request()->root() }}/</span>
				            <input type="text" class="form-control input-sm" name="menu_path" placeholder="your-path-here" style="text-transform: lowercase;" autocomplete="off" required>
				        </div>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						MENU TYPE: 
					</td>
					<td style="padding: 0px;">
						<select class="form-control input-sm" name="menu_type" required>
				            <option value="0"> WITHOUT DROPDOWN </option>
				            <option value="1"> WITH DROPDOWN </option>
				        </select>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<button class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i> SUBMIT </button>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>

@push('scripts')

<script type="text/javascript">

    function selectModule(event, option = '') {
        $.ajax({
            url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-retrieve-active-windows', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data : { 'module' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
                option += '<option value="0"> MAIN CLASS </option>';
                $.each( data, function(key,value) {
                    option += '<option value="' + value.menu_id + '">' + value.menu_name + '</option>';
                });
                $('#menu_parent').html(option);
            }
        });
    }

    function submitFormAddModule(form){
        $.ajax({
            url: $('#' + form).attr('action'),
            method:"POST",
            data: new FormData($('#' + form)[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var alert = document.createElement("DIV");
                alert.setAttribute("class", "alert alert-info");
                alert.innerHTML = "<button type='button' class='close alert-close' data-dismiss='alert' area-hidden='true'>&times;</button>";
                alert.innerHTML += "<label><i class='fa fa-warning'></i> " + data + "</label>";
                $('#modaladdmodule #modal_add_module_alert').html(alert);
                $('#' + form)[0].reset();
            }
        });
    }

</script>

@endpush 