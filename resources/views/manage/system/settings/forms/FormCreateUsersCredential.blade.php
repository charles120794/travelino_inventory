<div class="row">
	<div class="col-lg-12">
		<div class="box box-default">
			<div class="box-header with-border" style="padding-top: 20px; padding-bottom: 20px;">
				<h3 class="box-title"> Change Password </h3>
			</div>
			<form method="post" action="{{ route('settings.route',['path' => $path, 'action' => 'settings-update-users-profile-password','id' => Crypt::encrypt($UserDetails->id)]) }}"> {{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"> Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="opassword" id="inputEmail3" placeholder="Old Password" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="npassword" id="inputPassword3" placeholder="New Password" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="cpassword" id="inputPassword3" placeholder="Confirm Password" required>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Submit </button>
				</div>
			</form>
		</div>
	</div>
</div>