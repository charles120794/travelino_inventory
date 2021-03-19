@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<input type="hidden" id="input_id">
<input type="hidden" id="input_name">

<section class="content">

    @include('layouts.alerts.errors.alerts')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h3 class="panel-title pull-left">
                        <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('inventory.route',['path' => $path, 'action' => 'create-cashier-receipt', 'id' => encrypt(1) ]) }}"> @csrf

    <div class="row">
        <div class="col-md-9">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> OR No. </label> <span class="text-red">*</span>
                                <input type="text" class="form-control" name="issue_code" value="{{ (old('issue_code')) ? old('issue_code') : strtoupper(uniqid()) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Date </label> <span class="text-red">*</span>
                                <input type="date" class="form-control" name="issue_date" value="{{ (old('issue_date')) ? old('issue_date') : date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Customer Name </label> <span class="text-red">*</span>
                                <div class="input-group">
                                    <div class="input-group-btn btn-modal-contact">
                                        <button type="button" class="btn btn-primary btn-flat search-modal-customer" data-toggle="modal" data-target="#modalsearchcustomer">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" name="customer_description" readonly required>
                                    <input type="hidden" name="customer_id">
                                    <?php $code = strtoupper(uniqid()); ?>
                                    <input type="hidden" name="customer_code" value="{{ $code }}" required>
                                    <span class="input-group-addon">
                                        <input type="checkbox" class="checkbox-new-customer" style="height: 16px; width: 16px;" data-toggle="tooltip" title="Check if New Customer">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header no-padding customer-details hide">
                        <h3 class="box-title pro-pb-2"><i class="fa fa-phone"></i> Contact </h3>
                    </div>
                    <div class="box-body no-padding customer-details hide">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Person</label> <span class="text-red">*</span>
                                    <input type="hidden" name="contact[0][code]" value="{{ $code }}">
                                    <input type="text" class="form-control" name="contact[0][description]" id="contact_description" autocomplete="contact-description" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Position</label>
                                    <input type="text" class="form-control" name="contact[0][position]" id="contact_position" autocomplete="contact-position" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Number</label> <span class="text-red">*</span>
                                    <input type="text" class="form-control input-number" name="contact[0][number]" id="contact_number" autocomplete="contact-number" maxlength="15">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact E-mail</label> <span class="text-red">*</span>
                                    <input type="email" class="form-control" name="contact[0][email]" id="cpntact_email" autocomplete="contact-email" maxlength="30">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header no-padding customer-details hide">
                        <h3 class="box-title pro-pb-2"><i class="fa fa-home"></i> Address </h3>
                    </div>
                    <div class="box-body no-padding customer-details hide">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Building No.</label> <span class="text-red">*</span>
                                    <input type="hidden" name="address[0][code]" value="{{ $code }}">
                                    <input type="text" class="form-control" name="address[0][number]" id="address_number" autocomplete="address-building" maxlength="30">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Street</label> <span class="text-red">*</span>
                                    <input type="text" class="form-control" name="address[0][street]" id="address_street" autocomplete="address-street" maxlength="30">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Barangay</label> <span class="text-red">*</span>
                                    <input type="text" class="form-control" name="address[0][barangay]" id="address_barangay" autocomplete="address-barangay" maxlength="30">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label> <span class="text-red">*</span>
                                    <input type="text" class="form-control" name="address[0][city]" id="address_city" autocomplete="address-city" maxlength="30">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ZIP Code</label>
                                    <input type="text" class="form-control" name="address[0][zip]" id="address_zip" autocomplete="address-zip" maxlength="30">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Particulars</label>
                                <textarea class="form-control" name="issue_particulars" style="resize: vertical; height: 59px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-solid">
                 <div class="box-body">
                    <div class="form-group">
                        <label> Total Price </label>
                        <h1 class="text-right" id="total_price">0.00</h1>
                    </div>
                    <div class="form-group">
                        <label> Cash </label>
                        <input type="text" class="form-control text-right input-currency" name="total_cash" value="0.00" required>
                    </div>
                    <div class="form-group">
                        <label> Change </label>
                        <input type="text" class="form-control bg-white text-right input-currency" name="total_change" value="0.00" required readonly>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Product / Item </label>
                                <div class="input-group">
                                    <input type="text" class="form-control input-item-product" name="input_item_product" placeholder="Scan Bar Code Here!">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-warning btn-flat btn-search-item" data-toggle="modal" data-target="#modalsearchproduct"><i class="fa fa-search"></i> Search </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body product-item-list">
                    <div class="row item-headers">
                        <div class="col-md-6">
                            <div class="form-group text-center bg-gray-light pro-p-1">
                                <label> Item Description </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group text-center bg-gray-light pro-p-1">
                                <label> Unit </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                             <div class="form-group text-center bg-gray-light pro-p-1">
                                <label> Quantity </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                             <div class="form-group text-center bg-gray-light pro-p-1">
                                <label> Price </label>
                            </div>
                        </div>
                    </div>
                    <div class="row no-item-selected">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <label> No item selected </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
        </div>   
    </div>
    
    </form>

</section>

@include('manage.system.accounts.scripts.UsersDashboardScript')

@include('manage.inventory.activity.modal.modalsearchcustomer')

@include('manage.inventory.activity.modal.modalsearchproduct')

@push('scripts')

<script type="text/javascript">
    
    $(function(){

        $(document).on('keypress', '.input-item-product', function(e){
            if(e.which == 13){
                var inputVal = $(this).val();
                alert("You've entered: " + inputVal);
                e.preventDefault();
            }
        });

        $('input[name="customer_description"]').on('click', function(){
            if($(this).attr('readonly')) {
                $('#modalsearchcustomer').modal('show');
            }
        });

        $('.checkbox-new-customer').on('click', function(){
            if($(this).prop('checked')) {
                $('.btn-modal-contact').addClass('hide');
                $('input[name="customer_description"]').val('').attr('readonly', false);
                $('input[name="customer_id"]').val('');
                $('.customer-details').removeClass('hide');
                $('.btn-selected-customer').each(function(){
                    $(this).attr('disabled', false);
                });
            } else {
                $('.btn-modal-contact').removeClass('hide');
                $('input[name="customer_description"]').val('').attr('readonly', true);
                $('input[name="customer_id"]').val('');
                $('.customer-details').addClass('hide');
            }
        });

        $('.product-item-list').on('input', '.input-quantity', function(event){
            if($(this).val() > parseInt($(this).prev().text())) {
                alert('Inputing quantity greater than item quantity in not allowed.');
                $(this).val(0);
                $(this).closest('.col-md-2').next().find(':input').val('0.00');
                computeTotalPrice();
            } else {
                var parseFloatTotal = parseFloat($(this).next().val() * $(this).val()).toFixed(2);
                $(this).closest('.col-md-2').next().find(':input').val(parseFloatTotal);
                $(this).closest('.col-md-2').next().find(':input')
                computeTotalPrice();
                formatCurrency($(this).closest('.col-md-2').next().find(':input'));
            }
        });

        $('.search-modal-contact').on('click', function(event){
            $('#input_id').val($(this).data('inputid'));
            $('#input_name').val($(this).data('input'));
        });

        $('.btn-selected-customer').on('click',function(){
            $('input[name="customer_description"]').val($(this).data('description'));
            $('input[name="customer_id"]').val($(this).data('id'));
            $('.btn-selected-customer').each(function(){
                $(this).attr('disabled', false);
            });
            $(this).attr('disabled', true)
            $('#modalsearchcustomer').modal('hide');
            $('input[name="customer_description"]').attr('readonly', true);
        });

        $('.search-modal-department').on('click', function(event){
            $('#input_id').val($(this).data('inputid'));
            $('#input_name').val($(this).data('input'));
        });

        $('.selected-department').on('click',function(){
            $($('#input_id').val()).val($(this).data('contact'));
            $($('#input_name').val()).val($(this).data('description'));
            $('#modalsearchdepartment').modal('hide');
        });

        $('.select-address').on('click', function(event){
            event.preventDefault();
            let targetInput = $(this).attr('href');
            let targetAddress = $(this).data('target');
            let addressid = $(this).data('id');
            let addresscomplete = $(this).data('address');
            $(targetInput).val(addressid);
            $('#' + targetAddress).val(addresscomplete);
        });

    });

    function computeTotalPrice()
    {
        var totalPrice = 0.00;
        $('.total-row-price').each(function(key, value) {
            totalPrice += parseFloat($(this).val().replace(/,/g, ""));
            formatCurrency($('#' + $(this).attr('id')));
        });
        $('#total_price').text(formatMoney(totalPrice));
    }

    function formatMoney(amount)
    {
        return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
    }

    function updateInput(event) {
        $('#' + event).val("");
    }
</script>

@endpush

@endsection