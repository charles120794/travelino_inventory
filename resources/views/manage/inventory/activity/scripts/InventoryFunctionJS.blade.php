@push('scripts')

<script type="text/javascript">

	

	function update_basket_quantity(key) 
	{
	    var item_id       = $('#item_id' + key).val();
	    var item_quantity = $('#item_quantity' + key).val();
	    var item_customer = $('input[name="customer_id"]').val();

	    $.ajax({
	        url : '{{ route('inventory.route',['path' => $path, 'action' => 'update-customer-basket-quantity', 'id' => encrypt(1)]) }}',
	        type : 'post',
	        data : { 
	            cashier_item_id : item_id, 
	            cashier_item_quantity: item_quantity,
	            cashier_item_customer: item_customer,
	        },
	    });
	}


	/**
	 *  Validate Inputed Quantity 
	 * 
	 */
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

	function validate_input_cash() 
	{
	    if(computeTotalDetailsPrice() > 0.00) {
	        $('.input-cash').attr('disabled', false).attr('readonly', false);
	    } else {
	        $('.input-cash').attr('disabled', true).attr('readonly', true).val('0.00');
	        $('input[name="total_change"]').val('0.00')
	    }
	}

	function computeTotalQtyPrice(key)
	{
	    var totalPrice = parseFloat($('#item_price_old' + key).val()).toFixed(2);
	    var totalQuantity = parseInt($('#item_quantity' + key).val());
	    $('#item_total_price' + key).val(formatMoney(totalPrice * totalQuantity));
	}

	function retrieve_customer_basket(customer) 
	{
	    $.ajax({
	        url : '{{ route('inventory.route', ['path' => active_path(), 'action' => 'retrieve-customer-basket', 'id' => str_random(30)]) }}',
	        type : 'get',
	        dataType : 'html',
	        data : { 
	            cashier_item_customer: customer,
	        },
	        success : function(data) {

	        	// Load Data into Table
	            $('#table-cuctomer-basket').html(data); 

	            displayTotalPrice(); 
	            computeTotalChange();
	            computeTotalQuantity();
	            validate_input_cash();
	            validate_btn_submit();
	            hide_no_item_selected();
	        }
	    });
	}

	function create_customer_basket_item(item, quantity = 1) 
	{
	    var item_id = item ;
	    var item_quantity = quantity ;
	    var item_customer = localStorage.getItem('customer_selected') ;

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
	        success : function() {

	        	// Load Customer Basket
	            retrieve_customer_basket(item_customer);

	            displayTotalPrice(); 
	            computeTotalChange();
	            computeTotalQuantity();
	            validate_input_cash();
	            validate_btn_submit();
	            hide_no_item_selected();
	        }
	    });
	};

	function remove_customer_basket_item(basket)
	{

		var item_customer = localStorage.getItem('customer_selected') ;

	    $.ajax({
	        url : '{{ route('inventory.route',['path' => active_path(), 'action' => 'delete-cashier-customer-basket', 'id' => encrypt(1)]) }}',
	        type : 'get',
	        dataType : 'html',
	        data : { basket_id: basket, },
	        success : function(data) {

	            retrieve_customer_basket(item_customer);

	            displayTotalPrice(); 
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
	    computeTotalDetailsPrice() > 0.00 ? $('.no-item-selected').addClass('hide') : $('.no-item-selected').removeClass('hide') ;
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

	function modal_search_product_focus()
	{
	    if($.trim($("#search_modal_item").val()) != "") {
	        var input = $("#search_modal_item");
	        var len = input.val().length;
	        input[0].focus();
	        input[0].setSelectionRange(len, len);
	    }
	}

	function computeTotalDetailsPrice(totalPrice = 0.00)
	{
	    $('.total-row-price').each(function(key, value) {

	        totalPrice += parseFloat($(this).val().replace(/,/g, ""));

	        formatCurrency($('#' + $(this).attr('id')));
	    });

	    return totalPrice;
	}

	function validate_btn_submit(errors = 0)
	{
	    /* IF Input Cash is Greater Than Total Price*/
	    if(parseFloat($('.input-cash').val().replace(/,/g, "")) < parseFloat(computeTotalDetailsPrice().toFixed(2))) {
	        errors++;
	    }
	    /* IF Total Price not equal to Zero*/
	    if(computeTotalDetailsPrice() == 0.00) {
	        errors++;
	    }
	    /* If no Errors found Enable Submit Button */
	    if(errors == 0) {
	        $('.btn-submit').attr('type','submit').attr('disabled',false);
	    } else {
	        $('.btn-submit').attr('type','button').attr('disabled',true);
	    }
	}

	function ajax_call_customers_by_id(id)
	{
	    // $.ajax({
	    //     type : 'get',
	    //     url : '{ route('inventory.route',['path' => $path, 'action' => 'inventory-retrieve-customer-json-id', 'id' => str_random(30)]) }}',
	    //     data : { customer: id },
	    //     success : function(data) {
	    //         localStorage.setItem('customer_id', data.customer_id);
	    //         localStorage.setItem('customer_name', data.customer_name);
	    //     }
	    // });
	}

	function ajax_call_customers(page)
	{
	   //
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

	function displayTotalPrice()
	{
	    $('#total_price').text(formatMoney(computeTotalDetailsPrice()));
	}

	function computeTotalChange()
	{
	    if(computeTotalDetailsPrice().toFixed(2) > 0.00) {
	        var inputCash = $('input[name="total_cash"]').val().replace(/,/g, "");
	        var totalChange = parseFloat(inputCash).toFixed(2) - computeTotalDetailsPrice().toFixed(2); 
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
	
	function remove_item_row(row, basket) 
	{
	    if(confirm('Are you sure you want to remove this row?')) {
	        $('.item-row-' + row).fadeOut(1000); remove_customer_basket_item(basket);
	    }
	}

</script>

@endpush