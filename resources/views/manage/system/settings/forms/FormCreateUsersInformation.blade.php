<style type="text/css">
	.info-input {  display: none; }
</style>
<form method="post" action="{{ route('settings.route',['path' => $path, 'action' => 'settings-update-users-profile-info','id' => Crypt::encrypt($UserDetails->id)]) }}"> {{ csrf_field() }}
	<div class="box box-default">
		<div class="box-header with-border" style="padding-top: 20px; padding-bottom: 20px;">
			<h3 class="box-title"> <i class="fa fa-user fa-fw"></i> Personal Info </h3>
			<div class="box-tools pull-right">
				<label style="margin-right: 20px;">
					<input type="checkbox" id="btn_edit" style="height: 16px; width: 16px; position: absolute; top: 1px; left: -20px;"> Edit
				</label>
				<button type="submit" id="btn_save" class="btn btn-primary btn-sm" disabled>
					<i class="fa fa-check fa-fw"></i> Save </button>
			</div>
		</div>
		<div class="box-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label for="fname" class="col-sm-2 control-label"> Firstname: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ $UserDetails->firstname }}</span>
						<input type="text" class="form-control info-input" name="firstname" id="fname" value="{{ $UserDetails->firstname }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="mname" class="col-sm-2 control-label"> Middlename: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ $UserDetails->middlename }}</span>
						<input type="text" class="form-control info-input" name="middlename" id="mname" value="{{ $UserDetails->middlename }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="lname" class="col-sm-2 control-label"> Lastname: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ $UserDetails->lastname }}</span>
						<input type="text" class="form-control info-input" name="lastname" id="lname" value="{{ $UserDetails->lastname }}" required>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label for="position_title" class="col-sm-2 control-label"> Occupation: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ $UserDetails->position_title }}</span>
						<input type="text" class="form-control info-input" name="position_title" id="position_title" value="{{ $UserDetails->position_title }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="contact" class="col-sm-2 control-label"> Contact No: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ $UserDetails->contact }}</span>
						<input type="text" class="form-control info-input" name="contact" id="contact" value="{{ $UserDetails->contact }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label"> Email Address: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ $UserDetails->email }}</span>
						<input type="text" class="form-control info-input" name="email" id="email" value="{{ $UserDetails->email }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="birthdate" class="col-sm-2 control-label"> Date of Birth: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ date('m/d/Y',strtotime($UserDetails->birthdate)) }}</span>
						<input type="date" class="form-control info-input" name="birthdate" id="birthdate" value="{{ $UserDetails->birthdate }}" required>
					</div>
				</div>
				<div class="form-group">
					<label for="address" class="col-sm-2 control-label"> Complete Address: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ $UserDetails->address }}</span>
						<textarea class="form-control info-input" name="address" id="address" style="resize: vertical; min-height: 100px;" required>{{ $UserDetails->address }}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="education" class="col-sm-2 control-label"> Education: </label>
					<div class="col-sm-10">
						<span class="form-control info-text">{{ $UserDetails->education }}</span>
						<textarea class="form-control info-input" name="education" id="education" style="resize: vertical; min-height: 100px;" required>{{ $UserDetails->education }}</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>