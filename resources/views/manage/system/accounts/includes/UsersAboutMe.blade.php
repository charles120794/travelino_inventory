<div class="box box-primary">

	<div class="box-body box-profile">

		<p class="text-muted text-center">
			{{ $thisUserCompany->company_code }} - {{ $thisUserCompany->company_name }}
		</p>

		<img class="profile-user-img img-responsive" src="{{ Storage::url($thisUserAccount->personal_profile_path) }}" alt="User profile picture" style="height: 150px; width: 150px;">

		<h3 class="profile-username text-center">
			{{ $thisUserAccount->firstname }} {{ $thisUserAccount->middlename }} {{ $thisUserAccount->lastname }}
		</h3>

		<p class="text-muted text-center">{{ $thisUserAccount->position_title }}</p>

		<button type="button" class="btn btn-default btn-block" data-target="#addimageupload" data-toggle="modal"><b> Change Profile </b></button>

	</div>

</div>

<div class="box box-primary">

	<div class="box-header with-border">
		<h3 class="box-title">About Me</h3>
	</div>

	<div class="box-body">

		<strong>
			<i class="margin-r-5 fa fa-envelope"></i> E-mail Addess
		</strong>
		
		<p class="text-muted"> {{ $thisUserAccount->personal_email }} </p> <hr>

		<strong>
			<i class="margin-r-5 fa fa-phone"></i> Contact No.
		</strong>

		<p class="text-muted"> {{ $thisUserAccount->personal_contact_phone }} </p> <hr>

	</div>

</div>