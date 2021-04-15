@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<section class="content">

    @include('layouts.alerts.errors.alerts')

    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title pull-left">
                <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
            </h3>
        </div>
    </div>

    <div class="box box-solid">
        <div class="box-body">
            <form class="form-horizontal" method="get" id="form-search">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="search" autocomplete="search-department" placeholder="Search Department" value="{{ request()->get('search') }}">
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer text-right">
            <button type="button" class="btn btn-warning btn-flat" onclick="$('#form-search').submit()"><i class="fa fa-search"></i> Search </button>
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modaladddepartment"><i class="fa fa-plus"></i> Create </button>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body no-padding">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-gray-light" style="height: 50px;">
                        <th class="v-align-middle text-center" style="width: 20%;">Code</th>
                        <th class="v-align-middle text-center">Description</th>
                        <th class="v-align-middle text-center" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($department as $key => $value)
                    <tr>
                        <td class="v-align-middle">{{ $value->department_code }}</td>
                        <td class="v-align-middle">{{ $value->department_description }}</td>
                        <td class="v-align-middle" class="text-center">
                            <button type="button" class="btn btn-primary btn-flat modal-edit-department" data-id="{{ $value->department_id }}"><i class="fa fa-edit"></i></button>
                            <a href="{{ route('inventory.route',['path' => $path, 'action' => 'delete-department', 'id' => encrypt($value->department_id)]) }}" class="btn btn-danger btn-flat btn-del-validate"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="3"> No result's found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $department->links('vendor.pagination.m_custom_pagination') }}
        </div>
    </div>

</section>

@include('manage.inventory.maintenance.modal.modaladddepartment')

@include('manage.inventory.maintenance.modal.modaleditdepartment')

@include('manage.system.accounts.scripts.UsersDashboardScript')

@push('scripts')

<script type="text/javascript">

    $(function(){

        $('.btn-del-validate').on('click', function(event){
            if(!confirm('Are you sure you want to delete this row?')) {
                event.preventDefault();
            }
        });

        $('.modal-edit-department').on('click', function(){
            var id = $(this).data('id');
            var description = $(this).parent('td').prev().html();
            $('#modaleditdepartment').modal('show');
            $('#department_id').val(id);
            $('#department_description').val(description);
        });
        
        var countStart = 1;

        $(document).on('click','.add-group-option',function(){
            
            var count = countStart++; 

            var uniqid = Math.round(Math.random()*100000000000000);

            var input1 = $('<label>Code</label> <span class="text-red">*</span>');
            var input2 = $('<input type="text" class="form-control" name="option[' + count + '][code]" autocomplete="department-code" maxlength="50" value="' + uniqid + '" required>');
            var input3 = $('<label>Description</label> <span class="text-red">*</span>');
            var input4 = $('<input type="text" class="form-control" name="option[' + count + '][description]" autocomplete="department-description" maxlength="100" required>');
            var html1 = $('<div></div>').attr('class','form-group').append(input1,input2);
            var html2 = $('<div></div>').attr('class','form-group').append(input3,input4,'<hr>');

            $('#groupoptions').append(html1,html2);

        });

    });
</script>
@endpush

@endsection