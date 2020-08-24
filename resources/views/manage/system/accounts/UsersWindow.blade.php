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

				<div class="tab-content">

					@include('manage.system.accounts.forms.FormSearchUsersWindow')

	              	<div id="form_users_window_access">
						@include('manage.system.accounts.includes.TableUsersWindowAccess',['allWindow' => array()])
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@include('manage.system.accounts.scripts.UsersWindowScript')

@endsection


