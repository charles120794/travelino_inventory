@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<div class="content">

	@include('layouts.alerts.errors.alerts')

	<div class="row">

	  	<div class="col-md-3">
			@include('manage.system.accounts.includes.UsersAboutMe')
		</div> 

		<div class="col-md-9">

			<div class="nav-tabs-custom">

				<ul class="nav nav-tabs" style="height: 80px;">
					<li style="width: 20%;" class="active">
						<a href="#activity" data-toggle="tab"><i class="fa fa-edit fa-fw"></i> Information </a>
					</li>
					<li style="width: 20%;">
						<a href="#security" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> Security </a>
					</li>
				</ul>

				<div class="pull-right" style="margin-right: 20px; margin-top: -60px;">
					<p>Account Status &nbsp;&nbsp;
						<i class="{{ ($thisUserAccount->status == 1) ? 'fa fa-toggle-on text-orange' : 'fa fa-toggle-off text-red' }}" id="togglestatus{{ $thisUserAccount->users_id }}" onclick="return updateStatus(this.id,'{{ route('accounts.route',['path' => 'accounts', 'action' => 'toggle-users-profile', 'id' => encrypt($thisUserAccount->users_id)]) }}')" style="font-size: 23px; cursor: pointer;"></i> 
					</p>
				</div>

				<div class="tab-content">
					<div class="active tab-pane" id="activity">
						@include('manage.system.accounts.forms.FormUsersInformation')
					</div>
					<div class="tab-pane" id="security">
						@include('manage.system.accounts.forms.FormUsersCredential')
					</div>
				</div> 

			</div>

		</div>

	</div> 

</div>

@include('manage.common.modal.ModalImageUpload')

@include('manage.system.accounts.scripts.UsersProfileScript')

@endsection

