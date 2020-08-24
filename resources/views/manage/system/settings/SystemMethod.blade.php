@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.settings.includes.WindowBreadCrumbs')

<div class="content">

	@include('layouts.alerts.errors.alerts')

	<div class="box box-primary">
		
		<div class="box-body" style="min-height: 75vh;">

			<div class="panel panel-default">

				<div class="panel-heading clearfix bg-white">
                    <h3 class="panel-title pull-left">
                        <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
                    </h3>
                </div>

				<div class="panel-body">
					<div class="nav-tabs-custom">
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL METHOD </b></a></li>
					        <li><a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD METHOD </b></a></li>
					    </ul>
					</div>
					<div class="tab-content">
					    <div class="tab-pane active fade in" id="list">
					        @include('manage.system.settings.includes.TableSystemMethod')
					    </div>
					    <div class="tab-pane fade" id="add">
					        @include('manage.system.settings.forms.FormCreateMethod')
					    </div>
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@push('scripts')

<script type="text/javascript">

    function selectedModule(event, option = '') {
        $.ajax({
            url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-retrieve-window-classes', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data : { 'module' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
                
                option += '<option value=""> SELECT CLASS </option>';

                if(data.length > 0 ){

                	$.each( data, function(key,value) {
	                    option += '<option value="' + value.menu_id + '">' + value.menu_name + '</option>';
	                });

	                $('#menu_parent').attr('disabled',false);
               		$('#menu_parent').html(option);

	                $('#menu_child').attr('disabled',true);
               		$('#menu_child').html('<option value=""> SELECT SUB-CLASS </option>');

                } else {
             
	                $('#menu_parent').attr('disabled',true);
               		$('#menu_parent').html(option);

                }
               
            }
        });
    }

    function selectedClass(event, option = '') {
        $.ajax({
            url : '{{ route('settings.route',['path' => $path, 'action' => 'settings-retrieve-window-sub-class', 'id' => Crypt::encrypt('')]) }}',
            method : "post",
            data : { 'parent' : event.value },
            processData : true,
            dataType : 'json',
            cache : false,
            success : function(data) {
                
                option += '<option value=""> SELECT SUB-CLASS </option>';

                if(data.length > 0 ){

                	$.each( data, function(key,value) {
	                    option += '<option value="' + value.menu_id + '">' + value.menu_name + '</option>';
	                });

	                $('#menu_child').attr('disabled',false);
               		$('#menu_child').html(option);

                } else {
             
	                $('#menu_child').attr('disabled',true);
               		$('#menu_child').html(option);

                }
               
            }
        });
    }

    function submitFormAddModule(form){
        $.ajax({
            url: $('#' + form).attr('action'),
            method:"POST",
            data: new FormData($('#' + form)[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                var alert = document.createElement("DIV");
                alert.setAttribute("class", "alert alert-info");
                alert.innerHTML = "<button type='button' class='close alert-close' data-dismiss='alert' area-hidden='true'>&times;</button>";
                alert.innerHTML += "<label><i class='fa fa-warning'></i> " + data + "</label>";
                $('#modaladdmodule #modal_add_module_alert').html(alert);

                $('#' + form)[0].reset();

            }
        });
    }
</script>

@endpush 

@endsection