@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

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

                            <li class="@if(request()->get('tab') == 'all-account') active @endif @if(!request()->has('tab')) active @endif btn-users-tab">
                                <a href="#list" data-toggle="tab"><b> <i class="fa fa-list"></i> ALL USER ACCOUNT </b></a>
                            </li>

                            <li class="@if(request()->get('tab') == 'add-account') active @endif btn-users-tab">
                                <a href="#add" data-toggle="tab"><b> <i class="fa fa-plus"></i> ADD USER ACCOUNT </b></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        
                        <div class="tab-pane fade @if(request()->get('tab') == 'all-account') active in @endif @if(!request()->has('tab')) active in @endif" id="list">

                        	@include('manage.system.accounts.forms.FormSearchUsersAccount')

                        	<div id="form_company_users">
                            	@include('manage.system.accounts.includes.TableUsersAccount')
                        	</div>

                        </div>

                        <div class="tab-pane fade @if(request()->get('tab') == 'add-account') active in @endif" id="add">

                            @include('manage.system.accounts.forms.FormCreateUsersAccount')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('manage.system.accounts.scripts.UsersScript')

@endsection

