<form action="{{ route('settings.route',['path' => $path, 'action' => $createMethod , 'id' => encrypt('') ]) }}" method="post"> 
	{{ csrf_field() }} 
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="overflow-x: auto;">
			<h2 style="font-size: 18px; font-weight: bold;"><i class="fa fa-dropbox"></i> System Method </h2>
			<hr>
			<table class="table table-bordered">
				<tr style="white-space: nowrap;">
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						SELECT WINDOW: 
					</td>
					<td style="padding: 0px;" colspan="3">
						<select class="form-control input-sm" id="menu_id" name="menu_id" onchange="return selectedModule(this)" required>
				            <option value="" selected> Select Window </option>
				        </select>
					</td>
				</tr>
				<tr style="white-space: nowrap;">
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						SELECT MODULE: 
					</td>
					<td style="padding: 0px;" colspan="3">
						<select class="form-control input-sm" id="module_id" name="module_id" onchange="return selectedModule(this)" required>
				            <option value="" selected> Select Module </option>
				        </select>
					</td>
				</tr>
				<tr style="white-space: nowrap;">
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						METHOD NAME: 
					</td>
					<td style="padding: 0px;" colspan="3">
						<input type="text" name="method_name" class="form-control input-sm" maxlength="100" required autofocus="tru" autocomplete="off">
					</td>
				</tr>
				<tr style="white-space: nowrap;">
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						REQUEST TYPE:
					</td>
					<td style="padding: 0px;" colspan="3">
						<select class="form-control input-sm" name="request_type" id="request_type" style="border-radius: 0px; text-transform: uppercase;" required>
				            <option value="post"> POST </option>
				            <option value="get"> GET </option>
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