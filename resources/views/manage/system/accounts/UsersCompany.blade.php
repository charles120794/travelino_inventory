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

				@include('manage.system.accounts.includes.UsersAccessTab')

				<div class="tab-content" style="min-height: 75vh;">

					@include('manage.system.accounts.forms.FormSearchUsersCompany')

					<div id="form_users_company">
						@include('manage.system.accounts.includes.TableUsersCompanyAccess')
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@include('manage.common.modal.ModalImageUpload')

@include('manage.system.accounts.scripts.UsersCompanyScript')

@endsection

