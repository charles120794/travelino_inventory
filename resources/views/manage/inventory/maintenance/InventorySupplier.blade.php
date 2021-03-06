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
                        <input type="text" class="form-control" name="search" autocomplete="search-supplier" placeholder="Search Supplier" value="{{ request()->get('search') }}">
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer text-right">
            <button type="button" class="btn btn-warning btn-flat" onclick="$('#form-search').submit()"><i class="fa fa-search"></i> Search </button>
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modaladdsupplier"><i class="fa fa-plus"></i> Create </button>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body no-padding">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-gray-light" style="height: 50px;">
                        <th class="v-align-middle text-center">Code</th>
                        <th class="v-align-middle text-center">Supplier Name</th>
                        <th class="v-align-middle text-center">E-mail</th>
                        <th class="v-align-middle text-center">Contact</th>
                        <th class="v-align-middle text-center">Address</th>
                        <th class="v-align-middle text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($supplier as $key => $value)
                    <tr>
                        <td class="v-align-middle">{{ $value->supplier_code }}</td>
                        <td class="v-align-middle">{{ $value->supplier_description }}</td>
                        <td class="v-align-middle">{{ $value->supplierContact['contact_email'] }}</td>
                        <td class="v-align-middle text-center">
                            <button class="btn btn-info btn-flat modal-show-contact" data-contact="{{ $value->supplierContact }}"><i class="fa fa-eye"></i></button>
                        </td>
                        <td class="v-align-middle text-center">
                            <button class="btn btn-info btn-flat modal-show-address" data-address="{{ $value->supplierAddress }}"><i class="fa fa-eye"></i></button>
                        </td>
                        <td class="v-align-middle text-center">
                            <button type="button" class="btn btn-primary btn-flat modal-edit-supplier" data-id="{{ $value->supplier_id }}"><i class="fa fa-edit"></i></button>
                            <a href="{{ route('inventory.route',['path' => $path, 'action' => 'delete-supplier', 'id' => encrypt($value->supplier_id)]) }}" class="btn btn-danger btn-flat btn-del-validate"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="6"> No result's found </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $supplier->links('vendor.pagination.m_custom_pagination') }}
        </div>
    </div>

</section>

@include('manage.inventory.maintenance.modal.modaladdsupplier')

@include('manage.inventory.maintenance.modal.modaleditsupplier')

@include('manage.inventory.maintenance.modal.modalshowaddress')

@include('manage.inventory.maintenance.modal.modalshowcontact')

@include('manage.system.accounts.scripts.UsersDashboardScript')

@push('scripts')

<script type="text/javascript">

    $(function(){

        $('.modal-edit-supplier').on('click', function(){
            var id = $(this).data('id');
            $('#modaleditsupplier').modal('show');
            $.ajax({
                url : "{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-supplier', 'id' => encrypt(1)]) }}",
                type : 'get',
                data : {id:id},
                success : function (data){
                    $('input[name="supplier_id"]').val(data.supplier_id);
                    $('input[name="supplier_description"]').val(data.supplier_description);
                    $('input[name="supplier_tin"]').val(data.supplier_tin);
                    $('input[name="supplier_business_style"]').val(data.supplier_business_style);
                    $('input[name="supplier_tax"]').val(data.supplier_tax);

                    $('input[name="contact_id"]').val(data.supplier_contact.contact_id);
                    $('input[name="contact_description"]').val(data.supplier_contact.contact_description);
                    $('input[name="contact_number"]').val(data.supplier_contact.contact_number);
                    $('input[name="contact_email"]').val(data.supplier_contact.contact_email);
                    $('input[name="contact_position"]').val(data.supplier_contact.contact_position);

                    $('input[name="address_id"]').val(data.supplier_address.address_id);
                    $('input[name="address_number"]').val(data.supplier_address.address_number);
                    $('input[name="address_street"]').val(data.supplier_address.address_street);
                    $('input[name="address_barangay"]').val(data.supplier_address.address_barangay);
                    $('input[name="address_city"]').val(data.supplier_address.address_city);
                    $('input[name="address_zip"]').val(data.supplier_address.address_zip);
                }
            });
        });

        $('.btn-del-validate').on('click', function(event){
            if(!confirm('Are you sure you want to delete this row?')) {
                event.preventDefault();
            }
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

        $('.modal-show-contact').on('click', function(){
            var data_contact = $(this).data('contact');
            $('#modalshowcontact').modal('show');
            $('#show_contact_description').val(data_contact.contact_description);
            $('#show_contact_number').val(data_contact.contact_number);
            $('#show_contact_email').val(data_contact.contact_email);
            $('#show_contact_position').val(data_contact.contact_position);
        });

        $('#search-currency').on('input', function(){
            var inputSearch = $.trim($(this).val().toUpperCase().replace(/ /g,''));
            var selectedCurrency = $('.selected-currency').length;
            var displayNovalue = [];
            $('.selected-currency').each(function(){
                var searchString = $.trim($(this).text().toUpperCase().replace(/ /g,''));
                if(searchString.search(inputSearch) >= 0) {
                    $(this).removeClass('hide');
                } else {
                    $(this).addClass('hide');
                    displayNovalue.push(1);
                }
            });
            if(displayNovalue.length === selectedCurrency) {
                $('.no-selected-currency').removeClass('hide');
            }
        });

        $('#search-contact').on('input', function(){
            var inputSearch = $.trim($(this).val().toUpperCase().replace(/ /g,''));
            var selectedContact = $('.selected-contact').length;
            var displayNovalue = [];
            $('.selected-contact').each(function(){
                var searchString = $.trim($(this).text().toUpperCase().replace(/ /g,''));
                if(searchString.search(inputSearch) >= 0) {
                    $(this).removeClass('hide');
                } else {
                    $(this).addClass('hide');
                    displayNovalue.push(1);
                }
            });
            if(displayNovalue.length === selectedContact) {
                $('.no-selected-contact').removeClass('hide');
            }
        });

        $('#search-address').on('input', function(){
            var inputSearch = $.trim($(this).val().toUpperCase().replace(/ /g,''));
            var selectedAddress = $('.selected-address').length;
            var displayNovalue = [];
            $('.selected-address').each(function(){
                var searchString = $.trim($(this).text().toUpperCase().replace(/ /g,''));
                if(searchString.search(inputSearch) >= 0) {
                    $(this).removeClass('hide');
                } else {
                    $(this).addClass('hide');
                    displayNovalue.push(1);
                }
            });
            if(displayNovalue.length === selectedAddress) {
                $('.no-selected-address').removeClass('hide');
            }
        });

        $('.selected-currency').on('click', function(event){

            var objectData = $(this).data('object');
            
            if(Object.keys(objectData).length > 0) {
                $('#currency_id').val(objectData['currency_id']);
                $('#currency_name').val(objectData['currency_description']).attr('readonly', true);
            } else {
                $('#currency_id').val("");
                $('#currency_name').val("").attr('readonly', true);
            }
           
            event.preventDefault();
        });

        $('.selected-contact').on('click', function(event){

            var objectData = $(this).data('object');
            
            if(Object.keys(objectData).length > 0) {
                $('#contact_id').val(objectData['contact_id']);
                $('#contact_person').val(objectData['contact_description']).attr('readonly', true);
                $('#position').val(objectData['contact_position']).attr('readonly', true);
                $('#number').val(objectData['contact_number']).attr('readonly', true);
                $('#email').val(objectData['contact_email']).attr('readonly', true);
            } else {
                $('#contact_id').val("");
                $('#contact_person').val("").attr('readonly', false);
                $('#position').val("").attr('readonly', false);
                $('#number').val("").attr('readonly', false);
                $('#email').val("").attr('readonly', false);
            }
           
            event.preventDefault();
        });

        $('.selected-address').on('click', function(event){

            var objectData = $(this).data('object');

            if(Object.keys(objectData).length > 0) {
                $('#address_id').val(objectData['address_id']);
                $('#building_no').val(objectData['address_number']).attr('readonly', true);
                $('#street').val(objectData['address_street']).attr('readonly', true);
                $('#barangay').val(objectData['address_barangay']).attr('readonly', true);
                $('#city').val(objectData['address_city']).attr('readonly', true);
                $('#zip').val(objectData['address_zip']).attr('readonly', true);
            } else {
                $('#address_id').val("");
                $('#building_no').val("").attr('readonly', false);
                $('#street').val("").attr('readonly', false);
                $('#barangay').val("").attr('readonly', false);
                $('#city').val("").attr('readonly', false);
                $('#zip').val("").attr('readonly', false);
            }
           
            event.preventDefault();
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