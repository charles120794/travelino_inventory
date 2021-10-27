@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<input type="hidden" id="input_id">
<input type="hidden" id="input_name">

<style type="text/css">

    .autocomplete {
        /*the container must be positioned relative:*/
        position: relative;
        /*display: inline-block;*/
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /* position the autocomplete items to be the same width as the container: */
        top: 35px;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 8px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9;
    }

    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important;
        color: #ffffff;
    }

    .no-item-result {
        background-color: #FF0000 !important;;
    }

    .no-item-result strong {
        color: #FFFFFF;
    }

</style>

<section class="content">
    @include('layouts.alerts.errors.alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h3 class="panel-title pull-left" style="margin-top: 8px;">
                        <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
                    </h3>
                    <div class="pull-right">
                        <button type="button" class="btn btn-default btn-modal-pending"><i class="fa fa-list"></i> &nbsp; Pending Orders <span class="badge" id="pending_order_count">0</span></button>
                        <button type="button" class="btn btn-default btn-modal-recent"><i class="fa fa-list"></i> &nbsp; Recent Orders <span class="badge" id="history_order_count">0</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'create-customer-order-receipt', 'id' => encrypt(1) ]) }}" id="form_create_order"> @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Order No. </label> <span class="text-red">*</span>
                                    <input type="text" class="form-control" name="order_code" value="{{ (old('order_code')) ? old('order_code') : strtoupper(uniqid()) }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Reference No. </label>
                                    <input type="text" class="form-control" name="order_reference_no">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Date </label> <span class="text-red">*</span>
                                    <input type="date" class="form-control" name="order_date" value="{{ (old('order_date')) ? old('order_date') : date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Due Date </label>
                                    <input type="date" class="form-control" name="order_due_date" value="{{ (old('order_date')) ? old('order_date') : date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Customer Name </label> <span class="text-red">*</span>
                                    <div class="input-group">
                                        <div class="input-group-btn btn-modal-contact">
                                            <button type="button" class="btn btn-primary btn-flat search-modal-customer">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>

                                        <input type="text" class="form-control bg-white cursor-pointer change-customer-name" name="customer_description" readonly required>
                                        <input type="hidden" name="customer_id">
                                        <?php $code = strtoupper(uniqid()); ?>
                                        <input type="hidden" name="customer_code" value="{{ $code }}" required>

                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modaladdcustomer">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Particulars</label>
                                    <textarea class="form-control" name="issue_particulars" style="resize: vertical; height: 60px;"></textarea>
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
                            <label> Order Total Amount </label>
                            <h1 class="text-right" id="total_price"> 0.00 </h1>
                            <input type="hidden" class="form-control text-right text-bold text-blue input-currency input-cash" name="total_cash">
                            <input type="hidden" class="form-control text-right" name="total_change">
                        </div>
                        <div class="form-group">
                            <label> Vat <small>(12%)</small> </label>
                            <input type="text" class="form-control bg-white text-right text-bold" value="0.00" disabled>
                        </div>
                        <div class="form-group">
                            <label> Vatable </label>
                            <input type="text" class="form-control bg-white text-right text-bold" value="0.00" disabled>
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
                                        <div class="autocomplete">
                                            <input type="text" class="form-control" name="input_item_product" disabled>
                                        </div>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-warning btn-flat btn-search-item"><i class="fa fa-plus"></i> Add Product </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <th class="text-center" style="width: 41%;">Item Description</th>
                                        <th class="text-center" style="width: 18%;">Unit</th>
                                        <th class="text-center" style="width: 18%;">Quantity(<span id="total_quantity">0</span>)</th>
                                        <th class="text-center" style="width: 18%;">Price</th>
                                    </thead>
                                    <tbody id="table_cuctomer_basket"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row no-item-selected">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <label> No item selected </label>
                                </div>
                            </div>
                        </div>
                        <div class="product-item-list"></div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-primary pull-right btn-order-submit"><i class="fa fa-check"></i> Submit </button>
                    </div>
                </div>
            </div>   
        </div>
    </form>
</section>

@include('manage.inventory.activity.modal.modalsearchcustomer')

@include('manage.inventory.activity.modal.modalsearchproduct')

@include('manage.inventory.maintenance.modal.modaladdcustomer')

@include('manage.inventory.activity.pagination.modalRetrieveOrderPending')

@include('manage.inventory.activity.pagination.modalRetrieveOrderHistory')

@push('scripts')

<script type="text/javascript">
    
    $(function(){

        /**
         *  Step 1
         *  View the table of Customer List
         *  Inititated via Datatables
         */
        $('.search-modal-customer').on('click', function(){
            if($('input[name="customer_description"]').attr('readonly')) {
                $('#modalsearchcustomer').modal('show');
            }
        });

        /**
         * Step 2
         * Select or Choose a customer from the customer table list 
         */
        $(document).on('click', '.btn-selected-customer', function(){

            /* Load the selected customer into the input text  */
            $('input[name="customer_description"]')
                .val($($(this).parents('tr').children()[0]).html())
                .attr('readonly', true);

            /* Disabled all button  */
            $('.btn-selected-customer').each(function(){
                $(this).attr('disabled', false);
            });

            /* Disabled all button Except the selected button  */
            $(this).attr('disabled', true);

            /* Hide the modal */
            $('#modalsearchcustomer').modal('hide');

            $('input[name="customer_id').val($(this).data('customer'));

            localStorage.setItem('customer_selected', $(this).data('customer'));
            /* Load the selected customer if any available item or product from the basket table  */
            retrieve_customer_basket($(this).data('customer'));

        });

        /**
         * After Selecting Customer, You are now choose which item or product 
         */
        $('.btn-search-item').on('click', function(event){
            if($.trim($('input[name="customer_description"]').val()) == "" && $.trim($('input[name="customer_id"]').val()) == "") {
                alert('Please select a customer');
            } else {
                $('#modalsearchproduct').modal('show');
                $('.cashier-product_datatable').DataTable().ajax.reload();
            }
        }); 

        /**
         *  Confirm Submittion of Form
         */
        $('#form_create_cashier').on('submit', function(event){
            if(!confirm('Are you sure you want to submit this form?')) {
                event.preventDefault();
            }
        });  

        $('input[name="customer_description"]').on('click', function(){
            if($(this).attr('readonly')) {
                $('#modalsearchcustomer').modal('show');
            }
        });

        /**
         *  Hit Ctrl + F to foucs on Barcode scanner 
         */
        $(document).keydown(function(event){
            if(event.ctrlKey && event.which === 70) {
                $('input[name="input_item_product"]').focus();
                event.preventDefault();
            }
        });

        $(document).on('keypress', '.input-item-product', function(e){
            if(e.which == 13){
                var inputVal = $(this).val();
                alert("You've entered: " + inputVal);
                e.preventDefault();
            }
        });

        // $(document).on('change', 'input[name="search_modal_customer"]', function(event){
        //     ajax_call_customers(1);
        // });

        $('.change-customer-name').on('change', function() {
            $('input[name="contact[0][description]"]').val($(this).val());
            $('#contact_description').val($(this).val())
        });

        // Search Modal Department
        $('.search-modal-department').on('click', function(event){
            $('#input_id').val($(this).data('inputid'));
            $('#input_name').val($(this).data('input'));
        });

        // Selecte Department
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

        $('.input-cash').on('input', function (event){
            compute_total_change(); validate_submit_button();
        });

        $('.btn-modal-pending').on('click', function() {
            $('#modalorderpending').modal('show');
        });

        $('.btn-modal-recent').on('click', function() {
            $('#modalorderhistory').modal('show');
        });

        $(document).on('click','.item-les-qty', function(){

            var key = $(this).data('key'); 

            if($('#item_quantity' + key).val() <= 1) {
                $('#item-add-qty' + key).attr('disabled', false);
                $(this).attr('disabled',true);
            } else {
                $('#item-add-qty' + key).attr('disabled', false);
                $('#item_quantity' + key).val(function(i, old){
                    return parseInt(old) - 1;
                });

                update_basket_quantity_button(key, true);

                update_basket_quantity(key);
            }
        });

        $(document).on('click','.item-add-qty',function(){

            var key = $(this).data('key'); 

            if(parseInt($('#item_quantity' + key).val()) >= parseInt($('#item_quantity_old' + key).val())) {
                alert('Not enough stock is available');
                $('#item-les-qty' + key).attr('disabled', false);
                $(this).attr('disabled',true);
            } else {
                $('#item-les-qty' + key).attr('disabled', false);
                $('#item_quantity' + key).val(function(i, old){
                    return parseInt(old) + 1;
                });

                update_basket_quantity_button(key, true);

                update_basket_quantity(key);
            }
        });

        $(document).on('blur','.input-quantity', function(){
            validate_form_input_qty($(this));
        });

        $(document).on('click', '.btn-order-submit', function(event){
            if(compute_total_all_details_price() <= 0.00) {
                alert('Please add 1 or more item.');
                event.preventDefault();
            } else {
                $('#form_create_order').submit();
            }
        });

    });

    autocomplete($('#input_item_product'));

</script>

@endpush

@include('manage.inventory.activity.scripts.InventoryInputProductJS')

@include('manage.inventory.activity.scripts.InventoryFunctionJS')

@include('manage.inventory.activity.scripts.InventoryComputationJS')

@include('manage.inventory.activity.scripts.InventoryValidatetorJS')

@endsection