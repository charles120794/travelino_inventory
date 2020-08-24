@if (Session::has('success'))
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-check"></i> Success! </h4>
	{{ Session::get('success') }}
</div>
@endif

@if (Session::has('failed'))
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-ban"></i> Error! </h4>
	{{ Session::get('failed') }}
</div>
@endif

@if ($errors->all())
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-ban"></i> Error! </h4>
	<ul>
		@foreach($errors->all() as $value)
			<li>{{ $value }}</li>
		@endforeach
	</ul>
</div>
@endif

<div class="alert alert-info alert-dismissible" id="alert_success" style="display: none;">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-check"></i> Success! </h4>
	<span id="alert_success_msg"></span>
</div>

<div class="alert alert-danger alert-dismissible" id="alert_failed" style="display: none;">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><i class="icon fa fa-check"></i> Failed! </h4>
	<span id="alert_failed_msg"></span>
</div>

<div id="custom_ajax_alert"></div>

@isset($error_message)
	@if(count($error_message) > 0)
		<div class="alert alert-info alert-dismissible">
			<ul>
				@foreach($error_message as $message) 
					<li>{{ $message }}</li>
				@endforeach
			</ul>
		</div>
	@endif
@endisset