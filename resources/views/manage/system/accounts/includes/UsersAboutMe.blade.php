<div class="box box-primary">

	<div class="box-body box-profile">

		<form method="post" action="{{ route('accounts.route',['path' => $path, 'action' => 'update-users-profile-photo','id' => encrypt($thisUserAccount->users_id) ]) }}" enctype="multipart/form-data" id="form-update-profile-image"> {{ csrf_field() }}

			<p class="text-muted text-center">
				{{ $thisUserAccount->companyInfo['company_code'] }} - {{ $thisUserAccount->companyInfo['company_name'] }}
			</p>

			<img class="profile-user-img img-responsive" src="{{ Storage::url($thisUserAccount->profile_path) }}" alt="User profile picture" style="height: 150px; width: 150px;">

			<h3 class="profile-username text-center">
				{{ $thisUserAccount->firstname }} {{ $thisUserAccount->middlename }} {{ $thisUserAccount->lastname }}
			</h3>

			<p class="text-muted text-center">{{ $thisUserAccount->position_title }}</p>

			<input type="hidden" id="change_profile_image" name="change_profile_image">

			<button type="button" class="btn btn-default btn-block" data-target="#addimageupload" data-toggle="modal"><b> Change Profile </b></button>

		</form>

	</div>

</div>

<div class="box box-primary">

	<div class="box-header with-border">
		<h3 class="box-title">About Me</h3>
	</div>

	<div class="box-body">

		<strong>
			<i class="margin-r-5 fa fa-book"></i> Education 
		</strong>

		<p class="text-muted"> {{ $thisUserAccount->education }} </p> <hr>

		<strong>
			<i class="margin-r-5 fa fa-envelope"></i> Email 
		</strong>
		
		<p class="text-muted"> {{ $thisUserAccount->personal_email }} </p> <hr>

		<strong>
			<i class="margin-r-5 fa fa-phone"></i> Contact 
		</strong>

		<p class="text-muted"> {{ $thisUserAccount->personal_contact_phone }} </p> <hr>

		<strong>
			<i class="margin-r-5 fa fa-map-marker"></i> Address 
		</strong>

		<p class="text-muted"> {{ $thisUserAccount->usersAddress['address_complete'] }} </p> <hr>

	</div>

</div>