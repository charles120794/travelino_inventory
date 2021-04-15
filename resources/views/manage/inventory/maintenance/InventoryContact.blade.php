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
                        <input type="text" class="form-control" name="search" autocomplete="search-contact" placeholder="Search Contacts" value="{{ request()->get('search') }}">
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer text-right">
            <button type="button" class="btn btn-warning btn-flat" onclick="$('#form-search').submit()"><i class="fa fa-search"></i> Search </button>
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modaladdcontact"><i class="fa fa-plus"></i> Create </button>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body no-padding">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-gray-light" style="height: 50px;">
                        <th class="text-center" style="vertical-align: middle;">Code</th>
                        <th class="text-center" style="vertical-align: middle;">Name</th>
                        <th class="text-center" style="vertical-align: middle;">Contact</th>
                        <th class="text-center" style="vertical-align: middle;">Position</th>
                        <th class="text-center" style="vertical-align: middle;">E-mail</th>
                        <th class="text-center" style="vertical-align: middle;">Address</th>
                        <th class="text-center" style="vertical-align: middle;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contact as $key => $value)
                    <tr>
                        <td style="vertical-align: middle;">{{ $value->contact_code }}</td>
                        <td style="vertical-align: middle;">{{ $value->contact_description }}</td>
                        <td style="vertical-align: middle;">{{ $value->contact_number }}</td>
                        <td style="vertical-align: middle;">{{ $value->contact_position }}</td>
                        <td style="vertical-align: middle;">{{ $value->contact_email }}</td>
                        <td style="vertical-align: middle;" class="text-center">
                            <button class="btn btn-info btn-flat modal-show-address" data-address="{{ $value->contactAddress }}"><i class="fa fa-eye"></i></button>
                        </td>
                        <td style="vertical-align: middle;" class="text-center">
                            <button type="button" class="btn btn-primary btn-flat modal-edit-contact" data-id="{{ $value->contact_id }}"><i class="fa fa-edit"></i></button>
                            <a href="{{ route('inventory.route',['path' => $path, 'action' => 'delete-contact', 'id' => encrypt($value->contact_id)]) }}" class="btn btn-danger btn-flat btn-del-validate"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="6"> No result's found </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $contact->links('vendor.pagination.m_custom_pagination') }}
        </div>
    </div>

</section>

@include('manage.inventory.maintenance.modal.modaladdcontact')

@include('manage.inventory.maintenance.modal.modaleditcontact')

@include('manage.inventory.maintenance.modal.modalshowaddress')

@include('manage.system.accounts.scripts.UsersDashboardScript')

@push('scripts')

<script type="text/javascript">

    $(function(){

        $('.btn-del-validate').on('click', function(event){
            if(!confirm('Are you sure you want to delete this row?')) {
                event.preventDefault();
            }
        });

        $('.modal-edit-contact').on('click', function(){
            var id = $(this).data('id');
            $('#modaleditcontact').modal('show');
            $.ajax({
                url : "{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-contact', 'id' => encrypt(1)]) }}",
                type : 'get',
                data : {id:id},
                success : function (data){
                    $('input[name="contact_id"]').val(data.contact_id);
                    $('input[name="contact_description"]').val(data.contact_description);
                    $('input[name="contact_number"]').val(data.contact_number);
                    $('input[name="contact_email"]').val(data.contact_email);
                    $('input[name="contact_position"]').val(data.contact_position);
                    $('input[name="address_id"]').val(data.contact_address.address_id);
                    $('input[name="address_number"]').val(data.contact_address.address_number);
                    $('input[name="address_street"]').val(data.contact_address.address_street);
                    $('input[name="address_barangay"]').val(data.contact_address.address_barangay);
                    $('input[name="address_city"]').val(data.contact_address.address_city);
                    $('input[name="address_zip"]').val(data.contact_address.address_zip);
                }
            });
        });

        $('.modal-show-address').on('click', function(){
            var data_address = $(this).data('address');
            $('#modalshowaddress').modal('show');
            $('input[name="address_number"]').val(data_address.address_number);
            $('input[name="address_street"]').val(data_address.address_street);
            $('input[name="address_barangay"]').val(data_address.address_barangay);
            $('input[name="address_city"]').val(data_address.address_city);
            $('input[name="address_zip"]').val(data_address.address_zip);
        });
        
        var countStart = 1;

        $(document).on('click','.add-group-option',function(){
            
            var count = countStart++; 

            var uniqid = Math.round(Math.random()*100000000000000);

            var input1 = $('<label>Code</label> <span class="text-red">*</span>');
            var input2 = $('<input type="text" class="form-control" name="option[' + count + '][code]" autocomplete="unit-code" maxlength="50" value="' + uniqid + '" required>');
            var input3 = $('<label>Description</label> <span class="text-red">*</span>');
            var input4 = $('<input type="text" class="form-control" name="option[' + count + '][description]" autocomplete="unit-description" maxlength="100" required>');
            var html1 = $('<div></div>').attr('class','form-group').append(input1,input2);
            var html2 = $('<div></div>').attr('class','form-group').append(input3,input4,'<hr>');

            $('#groupoptions').append(html1,html2);

        });

    });
</script>

@endpush

@endsection