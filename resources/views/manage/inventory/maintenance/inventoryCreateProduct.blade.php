@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<section class="content">

    @include('layouts.alerts.errors.alerts')

    <div class="box box-solid bg-gray-light">
        <div class="box-body">
            <h3 class="panel-title pull-left">
                <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
                <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper('Create Product') }}</b>  
            </h3>
        </div>
    </div>

    <form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-product', 'id' => encrypt(1) ]) }}" id="form-create-product"> @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Group / Category </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Group / Category </label> <span class="text-red">*</span>
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-white" id="item_group_name" required readonly>
                                                <input type="hidden" name="item_group" id="selected_group">
                                                <span class="input-group-btn">
                                                    <button type="button" data-toggle="modal" data-target="#modalselectproductgroup" class="btn btn-info btn-flat"><i class="fa fa-search fa-fw"></i> Select Group</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Product </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Code </label>
                                            <input type="text" class="form-control" name="item_code" value="{{ strtoupper(uniqid()) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Type </label>
                                            <select class="form-control" name="item_type">
                                                <option value="sales" selected>Sales</option>
                                                {{-- <option value="inventory">Inventory</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Display Name <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="item_description" minlength="8" maxlength="100" autocomplete="display-name" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Full Description </label> 
                                            <textarea class="form-control" name="item_long_description" style="min-height: 150px; resize: vertical;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Location </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Supplier </label> <span class="text-red">*</span>
                                            <select class="form-control" name="item_supplier" required>
                                                <option value="">-- Select Supplier --</option>
                                                @foreach($supplier_data as $supplier)
                                                <option value="{{ $supplier->supplier_id }}" @if($supplier->supplier_default == 'Y') selected @endif>{{ $supplier->supplier_code }} - {{ $supplier->supplier_description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Warehouse </label> <span class="text-red">*</span>
                                            <select class="form-control" name="item_warehouse" required>
                                                <option value="">-- Select Warehouse --</option>
                                                @foreach($warehouse_data as $warehouse)
                                                <option value="{{ $warehouse->warehouse_id }}" @if($warehouse->warehouse_default == 'Y') selected @endif>{{ $warehouse->warehouse_code }} - {{ $warehouse->warehouse_description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Sales </h3>
                    </div>
                    <div class="box-body">
                        <div class="row pro-pt-3">
                            <div class="col-md-12">
                                <div class="row pro-pb-2 hide" id="variation-1-display">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Variation 1 </h3>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label>Description <span class="text-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="variant_name_1" id="variant_name_1" autocomplete="variant-name" placeholder="Colors, Sizes, Dimensions, Flavors, etc.">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-info btn-flat btn-append-option" data-variant="1" data-target="#append-variation-1"><i class="fa fa-plus"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <table class="table table-bordered table-condensed">
                                                    <thead>
                                                        <tr class="bg-gray-light">
                                                            <th class="text-center col-sm-12" colspan="2">Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="append-variation-1">
                                                        <tr class="variant1-option">
                                                            <td class="no-padding col-sm-12">
                                                                <input type="text" class="form-control" name="option1[0][option]" autocomplete="option-name">
                                                            </td>
                                                            <td class="no-padding">
                                                                <button class="btn btn-default btn-flat" disabled><i class="fa fa-remove"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pro-pb-2" id="variation-2-display"></div>
                                <div class="row pro-pb-2 hide" id="variation-button">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel panel-default pro-p-2">
                                            <button type="button" class="btn btn-info btn-block" id="add-variation-button"><i class="fa fa-plus"></i> Add Variation </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pro-pb-2">
                                    <div class="col-md-12">
                                        <div class="panel panel-default pro-p-2">
                                            <table class="table table-bordered table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            Purchase Price
                                                        </th>
                                                        <th class="text-center">
                                                            Seling Price
                                                        </th>
                                                        <th class="text-center">
                                                            Quantity
                                                        </th>
                                                        <th class="text-center">
                                                            Unit
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="no-padding">
                                                            <input type="text" class="form-control text-center input-currency" id="total_purchase" name="total_purchase" value="0.00">
                                                        </td>
                                                        <td class="no-padding">
                                                            <input type="text" class="form-control text-center input-currency" id="total_sales" name="total_sales" value="0.00">
                                                        </td>
                                                        <td class="no-padding">
                                                            <input type="text" class="form-control text-center input-number" id="total_quantity" name="total_quantity" value="0">
                                                        </td>
                                                        <td class="no-padding">
                                                            <select class="form-control" name="item_unit" required>
                                                                <option value="">-- Select Unit --</option>
                                                                @foreach($units as $unit)
                                                                <option value="{{ $unit->unit_id }}">{{ $unit->unit_code }} - {{ $unit->unit_description }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pro-pb-2 hide">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel panel-default pro-p-2">
                                            <button type="button" class="btn btn-info btn-block" id="enable-variation-button"> Enable Variation </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Media </h3>
                        <div class="pull-right hide">
                            <button type="button" class="btn btn-info" onclick="appendMediaTable()"><i class="fa fa-plus"></i> Add Image </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            @include('manage.inventory.maintenance.includes.productimage')
                            <div class="col-md-12 hide">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="append-product-image"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Shipping </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Length </label> 
                                            <input type="text" class="form-control" name="item_length">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Width </label>
                                            <input type="text" class="form-control" name="item_width">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Weight </label> 
                                            <input type="text" class="form-control" name="item_weight">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Others </label> <small>(Other Item Reference)</small>
                                            <input type="text" class="form-control" name="item_other_reference">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Other </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Purchase Date </label>
                                            <input type="date" class="form-control" name="item_purchase_date" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Expiration Date </label> <small>(Optional)</small>
                                            <input type="date" class="form-control" name="item_expiry_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Minimum Stock </label>
                                            <input type="text" class="form-control text-right input-number" name="item_min_quantity" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Item Condition </label>
                                            <input type="text" class="form-control" name="item_condition">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-tools text-right pro-pb-2 pro-pt-2 pro-pr-2">
                        {{-- <button type="submit" class="btn btn-flat btn-default" value="pending"><i class="fa fa-download"></i> Save to Drafts </button> --}}
                        <button type="submit" class="btn btn-flat btn-primary" value="approval"><i class="fa fa-check"></i> Submit </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('manage.inventory.maintenance.includes.productvariation')
            
</section>

{{-- @include('manage.common.modal.ModalImageUpload') --}}

@include('manage.inventory.maintenance.modal.modalselectproductgroup')

@include('manage.inventory.maintenance.modal.modaladdproductgroup')

@include('manage.system.accounts.scripts.UsersDashboardScript')

@push('scripts')

<script type="text/javascript">

    function openMediaModal(event)
    {
        localStorage.setItem("media_key", $(event).data('key'));
        $('#addimageupload').modal('show');
    }

    function submitModalImageUpload(event)
    {
        var mediaPath = $('#media_image_path').val();

        $('#media_product_image_' + localStorage.getItem("media_key")).attr('src','/storage/' + mediaPath);

        $('#media_product_image_path_' + localStorage.getItem("media_key")).val(mediaPath);

        $('#addimageupload').modal('hide');
    }

    function computeTotalPrice()
    {
        var totalPrice = parseFloat(0.00);

        $('.input-price').each(function(key,value){
            if($.trim($(this).val()) != "") {
                totalPrice += parseFloat($(this).val().replace(/,/g,''));
            }
        });

        var total_quantity = (totalPrice * $('#total_quantity').val());

        $('#total_sales').val(parseFloat(total_quantity).toFixed(2));

        formatCurrency($('#total_sales'));
        computeUnitCost();
    }

    function computeTotalQuantity()
    {
        var totalQuantity = parseInt(0);

        $('.input-quantity').each(function(key,value){
            if($.trim($(this).val()) != "") {
                totalQuantity += parseInt($(this).val());
            }
        });

        $('#total_quantity').val(parseInt(totalQuantity));

        computeTotalPrice();
        computeUnitCost();
    }

    var countStart = 1;

    function appendOption(event, )
    {
        var counter = countStart++;

        var dataVariant = $(event).data('variant');

        var tableInp1 = $('<input>').attr('class','form-control')
                                    .attr('name','option' + dataVariant + '[' + counter  + '][option]')
                                    .attr('autocomplete','option-name');

        var tableInp2 = $('<input>').attr('class','form-control text-center input-currency input-price')
                                    .attr('name','option' + dataVariant + '[' + counter  + '][selling_price]')
                                    .attr('oninput','formatCurrency($(this)),computeTotalPrice($(this))')
                                    .attr('onblur','formatCurrency($(this),\'blur\')')
                                    .attr('autocomplete','option-price')
                                    .attr('value','0.00');

        var tableInp3 = $('<input>').attr('class','form-control text-center input-number input-quantity')
                                    .attr('name','option' + dataVariant + '[' + counter  + '][quantity]')
                                    .attr('oninput','inputNumberFormat(this),computeTotalQuantity($(this))')
                                    .attr('placeholder','Qty')
                                    .attr('autocomplete','option-quantity');

        var tableInp4 = $('<input>').attr('class','form-control text-center')
                                    .attr('name','option' + dataVariant + '[' + counter  + '][unit]')
                                    .attr('placeholder','Unit')
                                    .attr('autocomplete','option-unit');

        var tableInp5 = $('<button></button>').attr('class','btn btn-default btn-flat')
                                              .attr('onclick','$(this).closest(\'tr\').remove(), computeTotalPrice(), computeTotalQuantity()')
                                              .html('<i class="fa fa-remove"></i>');

        var tableCol1 = $('<td></td>').attr('class','no-padding').html(tableInp1);
        var tableCol2 = $('<td></td>').attr('class','no-padding').html(tableInp2);
        var tableCol3 = $('<td></td>').attr('class','no-padding').html(tableInp3);
        var tableCol4 = $('<td></td>').attr('class','no-padding').html(tableInp4);
        var tableCol5 = $('<td></td>').attr('class','no-padding').html(tableInp5);

        // var tableRow = $('<tr></tr>').append(tableCol1,tableCol2,tableCol3,tableCol4,tableCol5);
        var tableRow = $('<tr></tr>').append(tableCol1,tableInp5);

        $($(event).data('target')).append(tableRow);
    }

    function appendMediaTable()
    {
        var counter = countStart++;

        var input1 = $('<img>').attr('src','').attr('class','img-thumbnail').attr('id','media_product_image_' + counter).css('width','200px');
        var input2 = $('<input>').attr('type','hidden').attr('name','media[' + counter + '][product_image]').attr('id','media_product_image_path_' + counter);

        var buttonIcon1 = $('<i></i<').attr('class','fa fa-photo');
        var buttonIcon2 = $('<i></i<').attr('class','fa fa-remove');

        var input3 = $('<button></button>').attr('type','button').attr('class','btn btn-primary btn-flat pro-mr-1').attr('data-key', counter).attr('onclick','openMediaModal(this)').html(buttonIcon1);
        var input4 = $('<button></button>').attr('type','button').attr('class','btn btn-danger btn-flat').attr('onclick','$(this).closest(\'tr\').remove()').html(buttonIcon2)

        var tableCol1 = $('<td></td>').attr('class','text-center').css('vertical-align','middle').append(input1, input2);
        var tableCol2 = $('<td></td>').attr('class','text-center').css('vertical-align','middle').append(input3, input4);
        
        var tableRow = $('<tr></tr>').append(tableCol1, tableCol2);

        $('#append-product-image').append(tableRow);
    }

    function computeUnitCost()
    {
        var totalSales = parseFloat($('#total_sales').val().replace(/,/g,''));
        var totalQuantity = parseFloat($('#total_quantity').val().replace(/,/g,''));
        $('#total_unit_cost').val((totalSales * totalQuantity).toFixed(2));
        formatCurrency($('#total_unit_cost'));
    }
    
    $(function(){

        $('#total_sales').on('input', function(){
            computeUnitCost();
        });

        $('#total_quantity').on('input', function(){
            computeUnitCost();
        });

        $('#enable-variation-button').on('click', function(){
            /* Variant 1 Display Show */
            $('#variation-1-display').removeClass('hide');
            /* Set Variant 1 as Reuired Field */
            $('#variant_name_1').attr('required',true)
            /* Button for Variant to Display Show */
            $('#variation-button').removeClass('hide');
            /* Validate Ipputs*/
            $('#total_purchase').val('0.00');
            $('#total_sales').val('0.00').attr('readonly', true);
            $('#total_quantity').val(0).attr('readonly', true);
            $(this).closest('.row').addClass('hide');
        });
       
        $('.close-modal-add-group').on('click', function(){
            var productGroup = $('#selected_group').val();
            if($.trim(productGroup).length == 0) {
                alert('Invalid Group, Please select a valid child description');
                $('#item_group').val("");
            } else {
                var breadcrumb = [];
                $('.breadcrumb-item').each(function(key, value){
                    breadcrumb.push($(this).text());
                });
                $('#item_group_name').val(breadcrumb.join('/ '));
                $('#modalselectproductgroup').modal('hide');
            }
        });

        $('#form-create-product').on('submit', function(event){
         
            /* Check Required Fields */
            var productGroup = $('#selected_group').val();

            if($.trim(productGroup).length == 0) {

                alert('Please select Product Group');

                $('#item_group').val("");

                return event.preventDefault();

            }

            $('#item_group').val(productGroup);

        });

        $('#add-variation-button').on('click', function(){
            $('#variation-2-display').html($('#variation-2-hidden').html());
            $(this).closest('.row').addClass('hide');
        });

        $('.btn-append-option').on('click', function(){
            appendOption(this);
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

        $('.append-address').on('click', function(){
    
            $html = $("<textarea>")
                    .attr("type", "text")
                    .attr("name", "billing_address[]")
                    .attr("class", "form-control input-sm")
                    .attr("autocomplete", "billing-address")
                    .css("resize", "vertical");

            $('#billing-address').append($html);

        });

    });

    function updateInput(event) {
        $('#' + event).val("");
    }

</script>

@endpush

@endsection