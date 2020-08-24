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
                            <li class="active"><a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL MODULE </b></a></li>
                            <li><a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD MODULE </b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="list">
                            @include('manage.system.settings.includes.TableSystemModule')
                        </div>
                        <div class="tab-pane fade" id="add">
                            @include('manage.system.settings.forms.FormCreateModule')
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

@include('manage.system.settings.scripts.SystemModuleScript')

@endsection
