@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<section class="content">

    @include('layouts.alerts.errors.alerts')

    <div class="box box-solid">
        <div class="box-header bg-gray-light">
            <h3 class="box-title pull-left">
                <span class="fa fa-angle-double-right fa-fw"></span><b> Activity </b>  
            </h3>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> &#8369;{{ number_format($total_income, 2) }} <small>Total Income</small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            {{-- <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button> --}}
		            <a href="{{ route('inventory.route',['path' => $path, 'action' => 'print-preview-cashier','id' => encrypt(1)]) }}" class="btn btn-primary btn-flat" target="_blank"><i class="fa fa-print"></i> Print Preview </a>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> &#8369;{{ number_format($total_expense, 2) }} <small>Total Expense</small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
	</div>

	<div class="box box-solid">
	    <div class="box-header bg-gray-light">
	        <h3 class="box-title pull-left">
	            <span class="fa fa-angle-double-right fa-fw"></span><b> Analysis </b>  
	        </h3>
	    </div>
	</div>

    <div class="row">
    	<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Stock On hand </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Stock Below Minimum </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Slow Moving Item </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Fast Moving Item </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
	</div>

	<div class="box box-solid">
	    <div class="box-header bg-gray-light">
	        <h3 class="box-title pull-left">
	            <span class="fa fa-angle-double-right fa-fw"></span><b> Listing </b>  
	        </h3>
	    </div>
	</div>

	<div class="row">
    	<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Item List </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Supplier List </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Customer List </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Contact List </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
		    <div class="box box-solid">
		        <div class="box-body">
		        	<h1> <small> Unit of Measure List </small> </h1> 
		        </div>
		        <div class="box-footer text-right">
		            <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Print Preview </button>
		        </div>
		    </div>
		</div>
	</div>

</section>

@endsection