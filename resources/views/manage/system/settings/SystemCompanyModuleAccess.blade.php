@extends('layouts.layout')

@section('title', 'Company Module Access')

@section('content')

<section class="content-header">
	<h1> &nbsp; </h1>
	<ol class="breadcrumb">
		<li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="" onclick="return false;"><i class="fa fa-cogs fa-fw"></i> Settings </a> </li>
		<li class="active"> <i class="fa fa-dashboard fa-fw"></i> Company Module Access </li>
	</ol>
</section>

<div class="content">
	<div class="box box-primary">
		<div class="box-body" id="users_box" style="min-height: 75vh;">
			<div class="panel panel-default">
				<div class="panel-heading clearfix" style="background-color: white;">
					<h3 class="panel-title pull-left">
						<label><i class="fa fa-home"></i> COMPANY MODULE ACCESS </label>
					</h3>
					<div class="text-right">
						<button type="button" class="btn btn-warning btn-sm" onclick="submitFormSearch()"><i class="fa fa-search"></i> SEARCH </button>
						<button type="button" class="btn btn-success btn-sm" onclick="selectAllCheckbox(this)"><i class="fa fa-square"></i> SELECT </button>
						<button type="button" class="btn btn-primary btn-sm" onclick="updateCompanyModule()"><i class="fa fa-save"></i> UPDATE </button>
					</div>
				</div>
				<div class="panel-body">
					<form method="post" id="form_search_company_module"> {{ csrf_field() }}
						<table class="table table-condensed table-bordered">
							<tr>
								<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 20%;">
									SELECT COMPANY
								</td>
								<td class="no-padding">
									<select class="form-control input-sm" name="company_id" onchange="submitFormSearch()">
										<option value="">-- Select Company --</option>
										@foreach( $webdata->usersCompany() as $key => $value)
										<option value="{{ $value->company_id }}"> {{ $value->company_code }} - {{ $value->company_description }} </option>
										@endforeach
									</select>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<form method="post" id="form_update_company_module"> {{ csrf_field() }}
					<div class="panel-body" id="panel_body" style="min-height: 56vh;"></div>
				</form>
			</div>
		</div>
		<div class="overlay box-overlay-loader" style="display: none;">
          	<i class="fa fa-refresh fa-spin"></i>
        </div>
	</div>
</div>

@push('scripts')

<script type="text/javascript">

	$(document).ready(function(){
		$('form').on('submit',function(e){
			e.preventDefault();
		});
	});

	function selectAllCheckbox(event) {
		if($(event).attr('checked')) {
			$('.method-checkbox').prop('checked',false);
			$(event).removeAttr('checked');
			$(event).html('<i class="fa fa-square"></i> SELECT');
		} else {
			$('.method-checkbox').prop('checked',true);
			$(event).attr('checked',true);
			$(event).html('<i class="fa fa-check-square"></i> SELECT');
		}
	}

	function submitFormSearch() {
		$('.box-overlay-loader').show();
		$.ajax({
		    url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-search-company-module', 'id' => Crypt::encrypt('')]) }}',
		    method : "post",
		    data : new FormData($('#form_search_company_module')[0]),
		    contentType: false,
		    cache: false,
		    processData: false,
		    success: function(data) {
		    	$('#panel_body').html(data);
		    	$('.box-overlay-loader').hide();
		    }
		});
	}

	function updateCompanyModule() {
		$('.box-overlay-loader').show();
		$.ajax({
		    url: '{{ route('settings.route',['path' => $path, 'action' => 'settings-update-company-module-access', 'id' => Crypt::encrypt('')]) }}',
		    method:"POST",
		    data: new FormData($('#form_update_company_module')[0]),
		    contentType: false,
		    cache: false,
		    processData: false,
		    success: function() {
		    	alert('Successfully Updated');
		    	submitFormSearch();
		    	$('.box-overlay-loader').hide();
		    }
		});
	}

	function deleteUsersModule(event) {
		if(confirm('Are you sure you want to PERMANENTLY delete this row?')) {
			$.ajax({
			    url: '{{ route('settings.route',['path' => $path, 'action' => 'settings-delete-users-module', 'id' => Crypt::encrypt('')]) }}',
			    method:"POST",
			    data: new FormData($('#' + form)[0]),
			    contentType: false,
			    cache: false,
			    processData: false,
			    success: function(data) {
			    	$('#panel_body').html(data);
			    }
			});
		}
	}

</script>

@endpush

@endsection


