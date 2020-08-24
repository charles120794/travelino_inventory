@extends('layouts.layout')

@section('title', 'Dashboard | Settings')

@section('content')

<section class="content-header">
	<h1>
		<i class="fa fa-dashboard fa-fw"></i> Application Manager
		<small> Control panel </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="/settings/home"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-dashboard fa-fw"></i> Setting Dashboard </li>
	</ol>
</section>

<div class="content">
	@include('layouts.alerts.errors.alerts')
</div>

@endsection