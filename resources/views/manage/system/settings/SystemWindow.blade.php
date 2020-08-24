@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.settings.includes.WindowBreadCrumbs')

<section class="content">

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
                            <li class="active"><a href="#list" data-toggle="tab" onclick="return showButtons()"><b> <i class="fa fa-list"></i> ALL WINDOW </b></a></li>
                            <li><a href="#add" data-toggle="tab" onclick="return hideButtons()"><b> <i class="fa fa-plus"></i> ADD WINDOW </b></a></li>
                        </ul>
                    </div>

                    <div class="tab-content">

                        @include('manage.system.settings.forms.FormSearchSystemWindow')
                        
                        <div class="tab-pane active fade in" id="list">

                            <div id="form_system_window"></div>

                        </div>

                        <div class="tab-pane fade" id="add">

                            @include('manage.system.settings.forms.FormCreateWindow')

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@include('manage.system.settings.scripts.SystemWindowScript')

@endsection



