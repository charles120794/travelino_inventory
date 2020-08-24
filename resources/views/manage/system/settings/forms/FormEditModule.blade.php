<form method="post" action="{{ route('settings.route',['path' => $path, 'action' => $updateModule , 'id' => encrypt($moduleInfo->module_id) ]) }}"> {{ csrf_field() }}
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
			<h2 style="font-size: 18px; font-weight: bold;"><i class="fa fa-dropbox"></i> System Module </h2>
			<hr>
			<table class="table table-bordered">
				<tr>
					<td style="font-size: 12px; vertical-align: middle; padding: 6px; width: 25%;" colspan="2">
						<div class="form-group">
							<label> Code: </label>
							<input type="text" class="form-control input-sm" name="module_code" value="{{ $moduleInfo['module_code'] }}" autocomplete="off" readonly>
						</div>
						<div class="form-group">
							<label> Name: </label>
							<input type="text" class="form-control input-sm" name="module_name" value="{{ $moduleInfo['module_name'] }}" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label> Description: </label>
							<input type="text" class="form-control input-sm" name="module_description" value="{{ $moduleInfo['module_description'] }}" autocomplete="off" required>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-edit"></i> Update </button>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>