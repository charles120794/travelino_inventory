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
                    <h3 class="panel-title pull-left">
                        <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
                    </h3>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary btn-modal-recent"><i class="fa fa-list"></i> &nbsp; Recent Transaction </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'cashier-create-receipt', 'id' => encrypt(1) ]) }}" id="form_create_cashier"> @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Reference No. </label> <span class="text-red">*</span>
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
                            <input type="text" class="form-control text-right text-bold text-blue input-currency input-cash" name="total_cash" value="0.00" disabled required>
                        </div>
                        <div class="form-group">
                            <label> Change </label>
                            <input type="text" class="form-control bg-white text-right text-bold" name="total_change" value="0.00" required readonly>
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
                                    <label> Product / Item </label> <small>(Press <b>Ctrl + F</b> key to focus on Barcode Search)</small>
                                    <div class="input-group">
                                        <div class="autocomplete">
                                            <input type="text" class="form-control input-item-product" name="input_item_product" id="input_item_product" placeholder="Search Barcode Here!">
                                        </div>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-warning btn-flat btn-search-item"><i class="fa fa-search"></i> Search </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row item-headers">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <th class="text-center" style="width: 41%;">Item Description</th>
                                        <th class="text-center" style="width: 18%;">Unit</th>
                                        <th class="text-center" style="width: 18%;">Quantity(<span class="text-total-quantity">0</span>)</th>
                                        <th class="text-center" style="width: 18%;">Price</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="text-center bg-gray-light">
                                    <label> Item Description </label>
                                </div>
                            </div>
                            <div class="col-md-2 bg-gray-light">
                                <div class="form-group text-center bg-gray-light pro-p-1">
                                    <label> Unit </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                 <div class="form-group text-center bg-gray-light pro-p-1">
                                    <label> Quantity </label>(<span class="text-total-quantity">0</span>)
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
                        <div class="product-item-list"></div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-primary pull-right btn-submit" disabled><i class="fa fa-check"></i> Submit </button>
                    </div>
                </div>
            </div>   
        </div>
    </form>
</section>

@include('manage.system.accounts.scripts.UsersDashboardScript')

@include('manage.inventory.activity.modal.modalshowrecentcashier')

@include('manage.inventory.activity.modal.modalsearchcustomer')

@include('manage.inventory.activity.modal.modalsearchproduct')

@include('manage.inventory.maintenance.modal.modaladdcustomer')

@push('scripts')

<script type="text/javascript" src="{{ asset('inventory/dataTableServerSide.js') }}"></script>

<script type="text/javascript">
    
    $(function(){

        $('#form_create_cashier').on('submit', function(event){
            if(!confirm('Are you sure you want to submit this form?')) {
                event.preventDefault();
            }
        });  

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

        $(document).on('change', 'input[name="search_modal_customer"]', function(event){
            ajax_call_customers(1);
        });

        $('.change-customer-name').on('change', function() {
            $('input[name="contact[0][description]"]').val($(this).val());
            $('#contact_description').val($(this).val())
        });

        $('.search-modal-customer').on('click', function(){
            if($('input[name="customer_description"]').attr('readonly')) {
                $('#modalsearchcustomer').modal('show');
                ajax_call_customers(1);
            }
        });

        $('input[name="customer_description"]').on('click', function(){
            if($(this).attr('readonly')) {
                $('#modalsearchcustomer').modal('show');
                ajax_call_customers(1);
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

        $(document).on('click', '.btn-selected-customer', function(){

            ajax_call_customers_by_id($(this).data('customer'));

            $('.btn-selected-customer').each(function(){
                $(this).attr('disabled', false);
            });

            modal_loader_spiner(true);
            
            $(this).attr('disabled', true);

            setTimeout(function(){

                var customer_id   = localStorage.getItem('customer_id');
                var customer_name = localStorage.getItem('customer_name');

                $('input[name="customer_id"]').val(customer_id);
                $('input[name="customer_description"]').val(customer_name).attr('readonly', true);

                $('#modalsearchcustomer').modal('hide');

                modal_loader_spiner(false);

                append_selected_customer_item();

            }, 600);
            
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

        $('.input-cash').on('input', function (event){
            computeTotalChange();
            validate_btn_submit();
        });

        $('.btn-search-item').on('click', function(event){
            if($.trim($('input[name="customer_description"]').val()) == "" && $.trim($('input[name="customer_id"]').val()) == "") {
                alert('Please select a valid customer');
            } else {
                $('#modalsearchproduct').modal('show');
                retrieve_item_per_page(1);
            }
        }); 

        $('.btn-modal-recent').on('click', function(){

            $('#modalshowrecentcashier').modal('show');

            retrieve_recent_cashier();
        });

    });


    function validate_btn_submit(errors = 0)
    {
        /* IF Input Cash is Greater Than Total Price*/
        if(parseFloat($('.input-cash').val().replace(/,/g, "")) < parseFloat(get_total_price().toFixed(2))) {
            errors++;
        }
        /* IF Total Price not equal to Zero*/
        if(get_total_price() == 0.00) {
            errors++;
        }
        /* If no Errors found Enable Submit Button */
        if(errors == 0) {
            $('.btn-submit').attr('type','submit').attr('disabled',false);
        } else {
            $('.btn-submit').attr('type','button').attr('disabled',true);
        }
    }

    function get_total_price(totalPrice = 0.00)
    {
        $('.total-row-price').each(function(key, value) {
            totalPrice += parseFloat($(this).val().replace(/,/g, ""));
            formatCurrency($('#' + $(this).attr('id')));
        }); return totalPrice;
    }

    /* AJAX CALLBACK */
    function retrieve_recent_cashier(page = 1)
    {
        modal_loader_spiner(true);
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'cashier-retrieve-receipt-history', 'id' => str_random(30)]) }}',
            data : {'cashier-history-page': page},
            dataType : 'html',
            success : function(data) {
                $('#modal_load_recent_cashier').html(data);
                modal_loader_spiner(false);
            }
        });
    }

    function ajax_call_customers_by_id(id)
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'inventory-retrieve-customer-json-id', 'id' => str_random(30)]) }}',
            data : { customer: id },
            success : function(data) {
                localStorage.setItem('customer_id', data.customer_id);
                localStorage.setItem('customer_name', data.customer_name);
            }
        });
    }

    function ajax_call_customers(page)
    {
        modal_loader_spiner(true);
        var search = $('input[name="search_modal_customer"]').val();
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'inventory-retrieve-customer-cashier-modal', 'id' => str_random(30)]) }}',
            data : {page: page, search: search},
            success : function(data) {
                $('#modal_load_customers').html(data);
                $('.cashier-customer-datatable').DataTable();
                modal_loader_spiner(false);
            }
        });
    }

    function ajax_call_customers_json(page, search = null)
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.collect.customer.json') }}',
            data : {page: page, search: search},
            success : function(data) { 

            }
        });
    }

    function validate_customer_data() 
    {
        if ($('input[name="customer_description"]').val().trim() == "") {
            return true;
        }
    }

    function computeTotalPrice()
    {
        $('#total_price').text(formatMoney(get_total_price()));
    }

    function computeTotalChange()
    {
        if(get_total_price().toFixed(2) > 0.00) {
            var inputCash = $('input[name="total_cash"]').val().replace(/,/g, "");
            var totalChange = parseFloat(inputCash).toFixed(2) - get_total_price().toFixed(2); 
            if(parseFloat(inputCash).toFixed(2) > 0.00) {
                $('input[name="total_change"]').val(formatMoney(totalChange));
            } else {
                $('input[name="total_change"]').val('0.00');
            }
        }
    }

    function computeTotalQuantity(total = 0)
    {
        $('.basket-quantity').each(function(key, value){
            total += parseInt(value.value);
        });
        $('.text-total-quantity').text(total);
    }

    function formatMoney(amount)
    {
        return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
    }

    function autocomplete(inp) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.on('input', function(e) {

            if(validate_customer_data()) {
                alert('Please select a valid customer');
                $(this).val("")
                return e.preventDefault(); 
            }

            var a, b, i, val = $(this).val();
            /*close any already open lists of autocompleted values*/
            closeAllLists();

            if (!val) { 
                return e.preventDefault(); 
            }

            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute('id', this.id + '_autocomplete_list');
            a.setAttribute('class', 'autocomplete-items');
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);

            /*for each item in the array...*/
            $.ajax({
                type : 'get',
                url : '{{ route('inventory.route',['path' => $path, 'action' => 'cashier-retrieve-product-json', 'id' => str_random(30)]) }}',
                data : {page: 1, search : inp.val()},
                dataType : 'json',
                success : function(data){

                    for (i = 0; i < data.length; i++) {
                        
                        /*check if the item starts with the same letters as the text field value:*/
                        let text_code = data[i].item_code;
                        let text_desc = data[i].item_description;
                            
                        let matched_searc = new RegExp(inp.val(),'i');

                        let matching_code = text_code.match(matched_searc); 
                        let matching_desc = text_desc.match(matched_searc); 
                            
                        let searched_code = text_code.replace(matching_code, '<span style="background-color: yellow;">' + matching_code + '</span>');
                        let searched_desc = text_desc.replace(matching_desc, '<span style="background-color: yellow;">' + matching_desc + '</span>');
                            
                        // var searched_word = searched_code + ' ' + searched_desc;

                        // console.log(searched_code + ' ' + searched_desc);

                        // var searched_start = searched_word.search(inp.val().toUpperCase());

                        b = document.createElement("DIV");

                        // b.innerHTML  = searched_word.substr(0,searched_start);
                        b.innerHTML  = searched_code + ' ' + searched_desc;
                        // b.innerHTML += "<strong>" + searched_word.substr(searched_start, val.length) + "</strong>";
                        // b.innerHTML += 'Hello';

                        // b.innerHTML += searched_word.substr((searched_start + val.length));
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' name='input_selected_item' value='" + searched_code + ' ' + searched_desc + "'>";
                        b.innerHTML += "<input type='hidden' name='input_selected_item_code' value='" + data[i].item_code + "'>";
                      
                        b.setAttribute('class','input-item-result');

                        b.setAttribute('onclick','return append_inputed_item(' + data[i].item_id + ')');
                        // execute a function when someone clicks on the item value (DIV element):
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            // console.log()
                            inp.val(text_code + ' ' + text_desc);

                            inp.focus().select();
                            // inp.value = this.getElementsByTagName("input")[0].value;
                            // close the list of autocompleted values,
                            // (or any other open lists of autocompleted values:
                            closeAllLists();

                        });

                        a.appendChild(b);

                    }

                    if(data.length == 1) {
                        var inputed = inp.val();
                        var searche = $('input[name="input_selected_item_code"]').val();
                        if(inputed.length === searche.length) {
                            $('.input-item-result')[0].click();
                        }
                    }

                    if(data.length == 0) {

                        b = document.createElement("DIV");

                        b.setAttribute('class','no-item-result')

                        b.innerHTML += '<strong class="no-item-result-text"> No result\'s found! </strong>';

                        a.appendChild(b);

                        // inp.focus().select();

                    }

                }

            });
                
        });

        /* execute a function presses a key on the keyboard:*/
        inp.on('keydown', function(e) {

            var x = $('#input_item_product_autocomplete_list div');

            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                divecrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                
                if (currentFocus > -1) {
                    // input_selected_item();
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();

                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add('autocomplete-active');
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove('autocomplete-active');
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var div = $('.autocomplete-items');
            
            for (var i = 0; i < div.length; i++) {
                if (div[i] != elmnt) {
                    $(div[i]).remove();
                }
                // if (elmnt != x[i] && elmnt != inp) {
                //     x[i].parentNode.removeChild(x[i]);
                // }
            }
        }
        /*execute a function when someone clicks in the document:*/
        $(document).on('click', function (e) {
            closeAllLists();
        });
    }

    autocomplete($('#input_item_product'));

    function input_selected_item(data)
    {
        append_selected_item(data);
    }

    function remove_item_row(row) {
        if(confirm('Are you sure you want to remove this row?')) {
            $('.item-row-' + row).fadeOut(1000);
            remove_customer_basket_item(row);
        }
    }

</script>

@endpush

@endsection