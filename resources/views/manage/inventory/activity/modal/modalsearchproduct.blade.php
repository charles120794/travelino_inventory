<div class="modal fade" id="modalsearchproduct">
    <div class="modal-dialog" style="width: 1200px;">
        <div class="modal-content">
    		<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-search"></i> Product / Item </h4>
    		</div>
    		<div class="modal-body" id="modal_load_paginationss">
                <table class="table table-bordered table-condensed cashier-product_datatable" style="width: 100%;">
                    <thead>
                        <tr class="bg-gray-light">
                            <th class="v-align-middle text-center" style="width: 10%;"> Code </th>
                            <th class="v-align-middle text-center" style="width: 50%;"> Description </th>
                            <th class="v-align-middle text-center" style="width: 10%;"> Stock </th>
                            <th class="v-align-middle text-center" style="width: 10%;"> Price </th>
                            <th class="v-align-middle text-center" style="width: 10%;"> Quantity </th>
                            <th class="v-align-middle text-center" style="width: 10%;"> Action </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>      
            </div>
    		<div class="modal-footer">
    			<button type="submit" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close </button>
    		</div>
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">

    $('#modalsearchproduct').ready(function(){ 
        var productsTable = $('.cashier-product_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventory.route',['path' => $path, 'action' => 'cashier-retrieve-products', 'id' => str_random(30)]) }}",
            columns: [
                {data: 'item_code', className : 'v-align-middle'},
                {data: 'item_description', className : 'v-align-middle'},
                {data: 'item_quantity_remaining', className : 'v-align-middle text-center'},
                {data: 'item_selling_price', className : 'v-align-middle text-right text-blue text-bold'},
                {data: 'quantity_button', className : 'v-align-middle text-center no-padding'},
                {data: 'selected_product', className : 'v-align-middle text-center no-padding'},
            ],
            columnDefs : [
                { width: '10%' , targets: 0 },
                { width: '50%' , targets: 1 },
                { width: '10%' , targets: 2 },
                { width: '10%' , targets: 3 },
                { width: '10%' , targets: 4 },
                { width: '10%' , targets: 5 }
            ],
            autoWidth: false,
            fixedColumns: true
        }).column( 2 )
        .data()
        .filter( function ( value, index ) {
            alert(value)
            console.log(value)
            return value > 20 ? true : false;
        } );
    });

    $(document).on('keypress', 'input[name="search_modal_item"]', function(event){
        if(event.which == 13){ retrieve_item_per_page(); }
    });

    $(document).on('change', 'input[name="search_modal_item"]', function(event){
        retrieve_item_per_page($(this).data('page'));
    });

    $(document).on('click', '.page-number', function(event){
        retrieve_item_per_page($(this).data('page'));
        ajax_call_customers($(this).data('page'));
        event.preventDefault();
    });

    $(document).on('input', '.modal-item-qty', function(){
        validate_modal_input_qty($(this));
    })

    $(document).on('click', '.modal-btn-les-qty', function(){
        var key = $(this).data('key'); 
        if($('.modal-item-qty' + key).val() <= 1) {
            $('.modal-btn-add-qty' + key).attr('disabled', false);
            $(this).attr('disabled',true);
        } else {
            $('.modal-btn-add-qty' + key).attr('disabled', false);
            $('.modal-item-qty' + key).val(function(i, old){
                return parseInt(old) - 1;
            });
        }
    });

    $(document).on('click', '.modal-btn-add-qty', function(event){
        var key = $(this).data('key'); 
        if($('.modal-item-qty' + key).val() >= parseInt($('#item_max_qty' + key).val())) {
            $('.modal-btn-les-qty' + key).attr('disabled', false);
            $(this).attr('disabled',true);
        } else {
            $('.modal-btn-les-qty' + key).attr('disabled', false);
            $('.modal-item-qty' + key).val(function(i, old){
                return parseInt(old) + 1;
            });
        }
    });
    
    $(document).on('click', '.selected-product', function(event){
        $('.modal-item-qty' + $(this).data('key')).attr('disabled',true);
        $('.modal-btn-les-qty' + $(this).data('key')).attr('disabled',true);
        $('.modal-btn-add-qty' + $(this).data('key')).attr('disabled',true);
        $('.no-item-selected').addClass('hide');
        $(this).attr('disabled',true);
        append_selected_item($(this));
        event.preventDefault();
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
            update_basket_quantity(key);
            compute_qty_price(key);
            computeTotalPrice();
            computeTotalChange();
            computeTotalQuantity();
            validate_btn_submit();
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
            update_basket_quantity(key);
            compute_qty_price(key);
            computeTotalPrice();
            computeTotalChange();
            computeTotalQuantity();
            validate_btn_submit();
        }
    });

    $(document).on('input','.input-quantity', function(){
        var key = $(this).data('key');
        validate_form_input_qty($(this));
        compute_qty_price(key);
        computeTotalPrice();
        computeTotalChange();
        validate_btn_submit();
    });

    function validate_input_cash()
    {
        if(get_total_price() > 0.00) {
            $('.input-cash').attr('disabled', false).attr('readonly', false);
        } else {
            $('.input-cash').attr('disabled', true).attr('readonly', true).val('0.00');
            $('input[name="total_change"]').val('0.00')
        }
    }

    function update_basket_quantity(key)
    {
        var item_customer = $('input[name="customer_id"]').val();
        var item_quantity = $('#item_quantity' + key).val();
        var item_id       = $('#item_id' + key).val();
        $.ajax({
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'update-customer-basket-quantity', 'id' => encrypt(1)]) }}',
            type : 'post',
            data : { 
                cashier_item_id : item_id, 
                cashier_item_quantity: item_quantity,
                cashier_item_customer: item_customer,
            },
            success : function(data) { 

            }
        });
    }

    function validate_modal_input_qty(event)
    {
        if(event.val() > parseInt($('#item_max_qty' + event.data('key')).val())) {
            alert('Not enough stock is available');
            event.val(parseInt($('#item_max_qty' + event.data('key')).val()));
        }
    }

    function validate_form_input_qty(event)
    {
        if(event.val() > parseInt($('#item_quantity_old' + event.data('key')).val())) {
            alert('Not enough stock is available');
            event.val(parseInt($('#item_quantity_old' + event.data('key')).val()));
        }
        if(event.val() <= 0) {
            event.val(1);
        }
    }

    function compute_qty_price(key)
    {
        var totalPrice = parseFloat($('#item_price_old' + key).val()).toFixed(2);
        var totalQuantity = parseInt($('#item_quantity' + key).val());
        $('#item_total_price' + key).val(formatMoney(totalPrice * totalQuantity));
    }

    function append_selected_customer_item()
    {
        $.ajax({
            url : '{{ route('inventory.route', ['path' => active_path(), 'action' => 'retrieve-customer-basket', 'id' => encrypt(1)]) }}',
            type : 'get',
            dataType : 'html',
            data : { 
                cashier_item_customer: $('input[name="customer_id"]').val(),
            },
            success : function(data) {
                $('.product-item-list').html(data); 
                computeTotalPrice(); 
                computeTotalChange();
                computeTotalQuantity();
                validate_input_cash();
                validate_btn_submit();
                hide_no_item_selected();
            }
        });
    }

    function append_inputed_item(item_id = null) {
        var decryptor = '{{ encrypt('now_you_see_me') }}';
        $.ajax({
            url : '{{ route('inventory.route',['path' => active_path(), 'action' => 'create-customer-basket', 'id' => encrypt(1)]) }}',
            type : 'get',
            dataType : 'html',
            data : { 
                cashier_item_quantity: 1,
                cashier_item_id: item_id,
                is_not_encrypted : decryptor,
                cashier_code : $('input[name="issue_code"]').val(), 
                cashier_item_customer: $('input[name="customer_id"]').val(),
            },
            success : function(data) {
                $('.product-item-list').html(data); 
                computeTotalPrice(); 
                computeTotalChange();
                computeTotalQuantity();
                validate_input_cash();
                validate_btn_submit();
                hide_no_item_selected();
            }
        });
    };

    function append_selected_item(event = null) {
        var item_id = event.attr('href') ;
        var item_quantity = $('.modal-item-qty' + event.data('key')).val() ;
        var item_customer = $('input[name="customer_id"]').val() ;
        $.ajax({
            url : '{{ route('inventory.route',['path' => active_path(), 'action' => 'create-customer-basket', 'id' => encrypt(1)]) }}',
            type : 'get',
            dataType : 'html',
            data : { 
                cashier_code : $('input[name="issue_code"]').val(), 
                cashier_item_id: item_id,
                cashier_item_quantity: item_quantity,
                cashier_item_customer: item_customer,
            },
            success : function(data) {
                $('.product-item-list').html(data); 
                computeTotalPrice(); 
                computeTotalChange();
                computeTotalQuantity();
                validate_input_cash();
                validate_btn_submit();
                hide_no_item_selected();
            }
        });
    };

    function remove_customer_basket_item(key)
    {
        var customer_id = $('input[name="customer_id"]').val();
        var item_id = $('#item_id' + key).val();
        $.ajax({
            url : '{{ route('inventory.route',['path' => active_path(), 'action' => 'delete-cashier-customer-basket', 'id' => encrypt(1)]) }}',
            type : 'get',
            dataType : 'html',
            data : { 
                cashier_item_customer: customer_id, 
                cashier_item_id : item_id,
            },
            success : function(data) {
                $('.item-row-' + key).remove();
                computeTotalPrice(); 
                computeTotalChange();
                computeTotalQuantity();
                validate_input_cash();
                validate_btn_submit();
                hide_no_item_selected();
            }
        });
    }

    function retrieve_item_per_page(page = 1)
    {
        // $('.cashier-product_datatable').DataTable().ajax.reload();
    }

    function hide_no_item_selected()
    {
        get_total_price() > 0.00 ? $('.no-item-selected').addClass('hide') : $('.no-item-selected').removeClass('hide') ;
    }

    function modal_search_product_focus()
    {
        if($.trim($("#search_modal_item").val()) != "") {
            var input = $("#search_modal_item");
            var len = input.val().length;
            input[0].focus();
            input[0].setSelectionRange(len, len);
        }
    }

    function modal_loader_spiner(event)
    {
        if(event) {
            $('.modal-loader-overlay').addClass('overlay');
            $('.modal-loader-spin').addClass('fa fa-refresh fa-spin');
        } else {
            $('.modal-loader-overlay').removeClass('overlay');
            $('.modal-loader-spin').removeClass('fa fa-refresh fa-spin');
        }
    }
    
</script>

@endpush