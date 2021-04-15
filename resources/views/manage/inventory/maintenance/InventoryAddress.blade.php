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
                        <input type="text" class="form-control" name="search" autocomplete="search-address" placeholder="Search Address" value="{{ request()->get('search') }}">
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer text-right">
            <button type="button" class="btn btn-warning btn-flat" onclick="$('#form-search').submit()"><i class="fa fa-search"></i> Search </button>
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modaladdaddress"><i class="fa fa-plus"></i> Create </button>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body no-padding">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-gray-light" style="height: 50px;">
                        <th class="text-center v-align-middle">Building No.</th>
                        <th class="text-center v-align-middle">Street</th>
                        <th class="text-center v-align-middle">Barangay</th>
                        <th class="text-center v-align-middle">City</th>
                        <th class="text-center v-align-middle">Contact</th>
                        <th class="text-center v-align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($address as $key => $value)
                    <tr>
                        <td class="v-align-middle">{{ $value->address_number }}</td>
                        <td class="v-align-middle">{{ $value->address_street }}</td>
                        <td class="v-align-middle">{{ $value->address_barangay }}</td>
                        <td class="v-align-middle">{{ $value->address_city }}</td>
                        <td class="v-align-middle text-center">
                            <button class="btn btn-info btn-flat modal-show-contact" data-contact="{{ $value->addressContact }}"><i class="fa fa-eye"></i></button>
                        </td>
                        <td class="v-align-middle text-center">
                            <button type="button" class="btn btn-primary btn-flat modal-edit-address" data-id="{{ $value->address_id }}"><i class="fa fa-edit"></i></button>
                            <a href="{{ route('inventory.route',['path' => $path, 'action' => 'delete-address', 'id' => encrypt($value->address_id)]) }}" class="btn btn-danger btn-flat btn-del-validate"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="6"> No result's found </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $address->links('vendor.pagination.m_custom_pagination') }}
        </div>
    </div>

</section>

@include('manage.inventory.maintenance.modal.modaladdaddress')

@include('manage.inventory.maintenance.modal.modaleditaddress')

@include('manage.inventory.maintenance.modal.modalshowcontact')

@include('manage.system.accounts.scripts.UsersDashboardScript')

@push('scripts')

<script type="text/javascript">

    $(function(){

        $('.btn-del-validate').on('click', function(event){
            if(!confirm('Are you sure you want to delete this row?')) {
                event.preventDefault();
            }
        });

        $('.modal-edit-address').on('click', function(){
            var id = $(this).data('id');
            $('#modaleditaddress').modal('show');
            $.ajax({
                url : "{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-address', 'id' => encrypt(1)]) }}",
                type : 'get',
                data : {id:id},
                success : function (data){
                    $('#address_id').val(data.address_id);
                    $('#address_number').val(data.address_number);
                    $('#address_street').val(data.address_street);
                    $('#address_barangay').val(data.address_barangay);
                    $('#address_city').val(data.address_city);
                    $('#address_zip').val(data.address_zip);
                    $('#contact_id').val(data.address_contact.contact_id);
                    $('#contact_description').val(data.address_contact.contact_description);
                    $('#contact_number').val(data.address_contact.contact_number);
                    $('#contact_email').val(data.address_contact.contact_email);
                    $('#contact_position').val(data.address_contact.contact_position);
                }
            });
        });

        $('.modal-show-contact').on('click', function(){
            var data_contact = $(this).data('contact');
            $('#modalshowcontact').modal('show');
            $('#show_contact_description').val(data_contact.contact_description);
            $('#show_contact_number').val(data_contact.contact_number);
            $('#show_contact_email').val(data_contact.contact_email);
            $('#show_contact_position').val(data_contact.contact_position);
        });
        
        var countStart = 1;

        $(document).on('click','.add-group-option',function(){
            
            var count = countStart++; 

            var uniqid = Math.round(Math.random()*100000000000000);

            var input1 = $('<label>Code</label> <span class="text-red">*</span>');
            var input2 = $('<input type="text" class="form-control" name="address[' + count + '][code]" autocomplete="unit-code" maxlength="50" value="' + uniqid + '" required>');
            var input3 = $('<label>Description</label> <span class="text-red">*</span>');
            var input4 = $('<input type="text" class="form-control" name="address[' + count + '][description]" autocomplete="unit-description" maxlength="100" required>');
            var html1 = $('<div></div>').attr('class','form-group').append(input1,input2);
            var html2 = $('<div></div>').attr('class','form-group').append(input3,input4,'<hr>');

            $('#groupoptions').append(html1,html2);

        });

    });
</script>

@endpush

@endsection