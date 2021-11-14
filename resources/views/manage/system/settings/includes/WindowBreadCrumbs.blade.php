<section class="content-header">
    <h1> <small><b><i class="{{ $windowIcon }}"></i> {{ strtoupper($activeModule->module_prefix) }} | {{ strtoupper($windowName) }} </b></small> </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('actions.route',['path' => $activeModule->module_route]) }}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
        <li class="active"><i class="{{ $windowIcon }}"></i> {{ $windowName }} </li>
    </ol>
</section>