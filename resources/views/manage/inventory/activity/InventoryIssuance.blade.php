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

    <form action="{{ route('inventory.route',['path' => $path, 'action' => 'create-issuance', 'id' => encrypt(1) ]) }}"> @csrf

    <div class="row">
        <div class="col-md-9">
            <div class="box box-solid">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Issuance No. </label> <span class="text-red">*</span>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Issue By </label> <span class="text-red">*</span>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-flat search-modal-contact" data-input="#issue_by" data-inputid="#issue_by_id" data-target="#modalsearchcontact" data-toggle="modal"><i class="fa fa-search"></i></button>
                                    </div>
                                    <input type="text" class="form-control" name="issue_by" id="issue_by" value="{{ old('issue_by') }}" required>
                                    <input type="hidden" name="issue_by_id" id="issue_by_id">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Issue To </label> <span class="text-red">*</span>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-flat search-modal-contact" data-input="#issue_to" data-inputid="#issue_to_id" data-target="#modalsearchcontact" data-toggle="modal"><i class="fa fa-search"></i></button>
                                    </div>
                                    <input type="text" class="form-control" name="issue_to" id="issue_to" value="{{ old('issue_to') }}" required>
                                    <input type="hidden" name="issue_to_id" id="issue_to_id">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Department </label> <span class="text-red">*</span>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-flat search-modal-department" data-input="#issue_department" data-inputid="#issue_department_id" data-target="#modalsearchdepartment" data-toggle="modal"><i class="fa fa-search"></i></button>
                                    </div>
                                    <input type="text" class="form-control" name="issue_department" id="issue_department" required>
                                    <input type="hidden" name="issue_department_id" id="issue_department_id">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Particulars</label>
                                <textarea class="form-control" name="issue_particulars" style="resize: vertical;"></textarea>
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
                        <label> Status </label>
                        <input type="text" class="form-control bg-white" name="issue_status" value="New" disabled>
                    </div>
                    <div class="form-group">
                        <label> Reference No. </label>
                        <input type="text" class="form-control" name="issue_reference">
                    </div>
                    <div class="form-group">
                        <label> Total Price </label>
                        <input type="text" class="form-control bg-white text-right input-currency" name="issue_total_price" id="issue_total_price" value="0.00" required readonly>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title"> Product Details </h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-warning btn-flat btn-add-product"><i class="fa fa-plus"></i> Product Item </button>
                    </div>
                </div>
                <div class="box-body product-item-list">
                    <div class="row first-item">
                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <label> Product Item </label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-flat search-modal-product" data-input="#product_description0" data-inputid="#product_id0"><i class="fa fa-search"></i></button>
                                    </div>
                                    <input type="text" class="form-control" name="product[0][product_description]" id="product_description0" required readonly>
                                    <input type="hidden" name="product[0][product_id]" id="product_id0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                             <div class="form-group text-center">
                                <label> Variant </label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                                    </div>
                                    <input type="text" class="form-control" name="product[0][product_variant]" id="product_variant0" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group text-center">
                                <label> Unit </label>
                                <input type="text" class="form-control" name="product[0][product_unit]" id="product_unit0" required readonly>
                                <input type="hidden" class="form-control" name="product[0][product_unit_id]" id="product_unitid0">
                            </div>
                        </div>
                        <div class="col-md-2">
                             <div class="form-group text-center">
                                <label> Quantity </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="item_quantity0">0</span>
                                    <input type="text" class="form-control text-right input-number input-quantity" name="product[0][product_quantity]" id="product_quantity0" required>
                                    <input type="hidden" class="input-price" name="product[0][product_price]" id="item_price0" value="0.00">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                             <div class="form-group text-center">
                                <label class="text-center"> Total Price </label>
                                <input type="text" class="form-control text-right total-row-price input-currency" name="product[0][total_price]" id="product_total_price0" value="0.00" required readonly>
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

@include('manage.inventory.activity.modal.modalsearchcontact')

@include('manage.inventory.activity.modal.modalsearchdepartment')

@include('manage.inventory.activity.modal.modalsearchproduct')

@push('scripts')

<script type="text/javascript">
    
    $(function(){

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

        $('.selected-contact').on('click',function(){
            $($('#input_id').val()).val($(this).data('contact'));
            $($('#input_name').val()).val($(this).data('description'));
            $('.selected-contact').each(function(){
                $(this).attr('disabled',false);
            });
            $(this).attr('disabled',true)
            $('#modalsearchcontact').modal('hide');
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

        var countStart = 1;

        $('.btn-add-product').on('click', function(){
            count = countStart++;
            var div = $("<div></div>").attr('class','row').append(
                        $('<div></div>').attr('class','col-md-4').html(
                            $('<div></div>').attr('class','form-group text-center').append(
                                $('<div></div>').attr('class','input-group').append(
                                    $('<div></div>').attr('class','input-group-btn').html(
                                        '<button type="button" class="btn btn-primary btn-flat search-modal-product" data-input="#product_description' + count + '" data-inputid="#product_id' + count + '"><i class="fa fa-search"></i></button>'
                                    ),
                                    $('<input>').attr('type','text')
                                                .attr('id','product_description' + count)
                                                .attr('class','form-control')
                                                .attr('name','product[' + count + '][product_description]')
                                                .attr('required',true)
                                                .attr('readonly',true),
                                    $('<input>').attr('type','hidden')
                                                .attr('id','product_id' + count)
                                                .attr('name','product[' + count + '][product_id]'),
                                )
                            ),
                        ),
                        $('<div></div>').attr('class','col-md-2').html(
                            $('<div></div>').attr('class','form-group text-center').html(
                                $('<div></div>').attr('class','input-group').append(
                                    $('<div></div>').attr('class','input-group-btn').html(
                                        $('<button></button>').attr('class','btn btn-primary btn-flat').html('<i class="fa fa-search"></i>')
                                    ),
                                    $('<input>').attr('type','text')
                                                .attr('class','form-control')
                                                .attr('id','product_variant' + count)
                                                .attr('name','product[' + count + '][product_variant]')
                                                .attr('required',true)
                                                .attr('readonly',true),
                                )
                            )
                        ),
                        $('<div></div>').attr('class','col-md-2').html(
                            $('<div></div>').attr('class','form-group text-center').html(
                                $('<input>').attr('type','text')
                                                .attr('class','form-control')
                                                .attr('id','product_unit' + count)
                                                .attr('name','product[' + count + '][product_unit]')
                                                .attr('required',true)
                                                .attr('readonly',true),
                            )
                        ),
                        $('<div></div>').attr('class','col-md-2').html(
                            $('<div></div>').attr('class','form-group text-center').html(
                                $('<div></div>').attr('class','input-group').append(
                                    $('<span></span>').attr('class','input-group-addon').attr('id','item_quantity' + count).text(0),
                                    $('<input>').attr('type','text')
                                                .attr('class','form-control text-right input-number input-quantity')
                                                .attr('id','product_quantity' + count)
                                                .attr('name','product[' + count + '][product_quantity]')
                                                .attr('required',true),
                                    $('<input>').attr('type','hidden')
                                                .attr('class','input-price')
                                                .attr('id','item_price' + count)
                                                .attr('name','product[' + count + '][product_price]')
                                                .val('0.00'),

                                )
                            )
                        ),
                        $('<div></div>').attr('class','col-md-2').html(
                            $('<div></div>').attr('class','form-group text-center').html(
                                $('<input>').attr('type','text')
                                                .attr('class','form-control text-right total-row-price input-currency')
                                                .attr('id','product_total_price' + count)
                                                .attr('name','product[' + count + '][total_price]')
                                                .attr('required',true)
                                                .attr('readonly',true)
                                                .val('0.00'),
                            )
                        ),
                      );

            $('.product-item-list').append(div);

        });

    });

    function computeTotalPrice()
    {
        var totalPrice = 0.00;
        $('.total-row-price').each(function(key, value) {
            totalPrice += parseInt($(this).val().replace(/,/g, ""));
        });
        $('#issue_total_price').val(totalPrice.toFixed(2));
        formatCurrency($('#issue_total_price'));
    }

    function updateInput(event) {
        $('#' + event).val("");
    }
</script>

@endpush

@endsection