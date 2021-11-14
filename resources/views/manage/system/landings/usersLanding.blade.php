@extends('layouts.layout')

@section('title', 'Users Landing Page')

@section('content')

<section class="content-header">
    <h1> <small><b><i class="fa fa-television"></i> Landing | Users Landing Page </b></small> </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-home"></i> {{ $activeCompany->company_code }} | {{ $activeCompany->company_description }} </li>
    </ol>
</section>

<section class="content">

    @include('layouts.alerts.errors.alerts')

    <div class="box box-primary">
        <div class="box-body" style="min-height: 75vh;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix bg-white">
                            <h3 class="panel-title pull-left">
                                <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper('Users Module') }}</b>  
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($usersModule as $module)
                    @if($module->module_prefix != $activeModule->module_prefix)
                    <div class="col-md-3">
                        <div class="panel panel-info">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title text-left">
                                    <b>{{ $module->module_name }}</b>
                                </h3>
                            </div>
                            <div class="panel-body">
                                {{-- <p>{{ $module->module_description }}</p> --}}
                            </div>
                            <div class="panel-footer text-right">
                                <a href="/{{ $module->module_prefix }}/home" class="btn btn-default"> Proceed </a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection