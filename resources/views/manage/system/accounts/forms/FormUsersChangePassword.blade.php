<div class="row">
	<div class="col-lg-12">
		<div class="box box-default">
			<div class="box-header with-border" style="padding-top: 20px; padding-bottom: 20px;">
				<h3 class="box-title"><i class="fa fa-lock fa-fw"></i> Change Password </h3>
			</div>
			<form method="post" action="{{ route('actions.route',['path' => $path, 'action' => 'update-users-password','id' => encrypt($thisUserAccount->users_id)]) }}"> {{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<label for="opassword" class="control-label"> Password </label>
						<input type="password" class="form-control" name="opassword" id="opassword" required>
					</div>
					<div class="form-group">
						<label for="npassword" class="control-label"> New Password </label>
						<input type="password" class="form-control" name="npassword" id="npassword" required>
					</div>
					<div class="form-group">
						<label for="cpassword" class="control-label"> Confirm Password </label>
						<input type="password" class="form-control" name="cpassword" id="cpassword" required>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Submit </button>
				</div>
			</form>
		</div>
	</div>
</div>