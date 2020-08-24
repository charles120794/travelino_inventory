@extends('layouts.layout')

@section('title', 'Database Backup Setting')

@section('content')

<section class="content-header">
	<h1>
		<i class="fa fa-dashboard fa-fw"></i> Database Backup Setting
		<small> Control panel </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li class="active"> <i class="fa fa-dashboard fa-fw"></i> Database Backup Setting </li>
	</ol>
</section>

<div class="content">
	@include('layouts.alerts.errors.alerts')
</div>

@endsection