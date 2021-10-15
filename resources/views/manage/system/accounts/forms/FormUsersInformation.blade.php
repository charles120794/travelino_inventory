<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'update-users-information','id' => encrypt($thisUserAccount->users_id)]) }}"> {{ csrf_field() }}
	<div class="box box-default">
		<div class="box-header with-border" style="padding-top: 20px; padding-bottom: 20px;">
			<h3 class="box-title"> <i class="fa fa-user fa-fw"></i> Personal Information </h3>
			<label><input type="checkbox" id="btn_edit" style="height: 16px; width: 16px; margin: 0px 5px 0px 10px;"> <span style="margin-top: -2px; float: right"> Edit </span> </label>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label for="fname" class="control-label"> Firstname: </label>
				<span class="form-control info-text">{{ $thisUserAccount->firstname }}</span>
				<input type="text" class="form-control info-input" name="firstname" id="fname" value="{{ $thisUserAccount->firstname }}" required>
			</div>
			<div class="form-group">
				<label for="mname" class="control-label"> Middlename: </label>
				<span class="form-control info-text">{{ $thisUserAccount->middlename }}</span>
				<input type="text" class="form-control info-input" name="middlename" id="mname" value="{{ $thisUserAccount->middlename }}" required>
			</div>
			<div class="form-group">
				<label for="lname" class="control-label"> Lastname: </label>
				<span class="form-control info-text">{{ $thisUserAccount->lastname }}</span>
				<input type="text" class="form-control info-input" name="lastname" id="lname" value="{{ $thisUserAccount->lastname }}" required>
			</div>
			<hr>
{{-- 			<div class="form-group">
				<label for="position_title" class="control-label"> Occupation: </label>
				<span class="form-control info-text">{{ $thisUserAccount->position_title }}</span>
				<input type="text" class="form-control info-input" name="position_title" id="position_title" value="{{ $thisUserAccount->position_title }}" required>
			</div> --}}
			<div class="form-group">
				<label for="contact" class="control-label"> Contact No: </label>
				<span class="form-control info-text">{{ $thisUserAccount->personal_contact_phone }}</span>
				<input type="text" class="form-control info-input" name="contact" id="contact" value="{{ $thisUserAccount->personal_contact_phone }}" required>
			</div>
			<div class="form-group">
				<label for="email" class="control-label"> Email Address: </label>
				<span class="form-control info-text">{{ $thisUserAccount->personal_email }}</span>
				<input type="text" class="form-control info-input" name="email" id="email" value="{{ $thisUserAccount->personal_email }}" required>
			</div>
			<div class="form-group">
				<label for="birthdate" class="control-label"> Date of Birth: </label>
				<span class="form-control info-text">{{ date('F d, Y',strtotime($thisUserAccount->birth_date)) }}</span>
				<input type="date" class="form-control info-input" name="birthdate" id="birthdate" value="{{ $thisUserAccount->birth_date }}" required>
			</div>
			<div class="form-group">
				<label for="address" class="control-label"> Complete Address: </label>
				<span class="form-control info-text">{{ $thisUserAccount->address }}</span>
				<textarea class="form-control info-input" name="address" id="address" style="resize: vertical; min-height: 100px;" required>{{ $thisUserAccount->address }}</textarea>
			</div>
{{-- 			<div class="form-group">
				<label for="education" class="control-label"> Education: </label>
				<span class="form-control info-text">{{ $thisUserAccount->education }}</span>
				<textarea class="form-control info-input" name="education" id="education" style="resize: vertical; min-height: 100px;" required>{{ $thisUserAccount->education }}</textarea>
			</div> --}}
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Submit </button>
		</div>
	</div>
</form>