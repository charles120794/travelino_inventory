@push('scripts')

<script type="text/javascript">

	function create_customer_basket_item(item, quantity = 1) 
	{
	    var item_id = item ;
	    var item_quantity = quantity ;
	    var item_customer = localStorage.getItem('customer_selected') ; /* Encrypted */

	    $.ajax({
	        url : '{{ route('inventory.route',['path' => active_path(), 'action' => 'inventory-create-customer-basket', 'id' => encrypt(1)]) }}',
	        type : 'get',
	        dataType : 'html',
	        data : { 
	            cashier_code : $('input[name="issue_code"]').val(), 
	            cashier_item_id: item_id,
	            cashier_item_quantity: item_quantity,
	            cashier_item_customer: item_customer,
	        },
	        success : function() {
	            retrieve_customer_basket(localStorage.getItem('customer_selected'));
	        },
	    });
	}

	function update_basket_quantity(key) 
	{
	    var item_id       = $('#item_id' + key).val();
	    var item_quantity = $('#item_quantity' + key).val();
	    var item_customer = localStorage.getItem('customer_selected');

	    $.ajax({
	        url : '{{ route('inventory.route',['path' => $path, 'action' => 'inventory-update-customer-basket-quantity', 'id' => encrypt(1)]) }}',
	        type : 'post',
	        data : { 
	            cashier_item_id : item_id, 
	            cashier_item_quantity: item_quantity,
	            cashier_item_customer: item_customer,
	        },
	        success : function () {
	        	retrieve_customer_basket(localStorage.getItem('customer_selected'))
	        },
	        complete : function () {
	        	update_basket_quantity_button(key, false);
	        }
	    });
	}

	function update_basket_quantity_button(key, status) 
	{
		$('#item-les-qty' + key).attr('disabled', status);
		$('#item_quantity' + key).attr('disabled', status);
		$('#item-add-qty' + key).attr('disabled', status);
	}

	function retrieve_customer_basket(customer) 
	{
	    $.ajax({
	        url : '{{ route('inventory.route', ['path' => active_path(), 'action' => 'inventory-retrieve-customer-basket', 'id' => str_random(30)]) }}',
	        type : 'get',
	        dataType : 'html',
	        data : { 
	            cashier_item_customer: customer,
	        },
	        success : function(data) {
	            $('#table_cuctomer_basket').html(data); 
	            hide_no_item_selected();
	        },
	        complete : function () {

	        	display_total_price(); 
	        	display_total_quantity(); 

	            compute_total_per_details_quantity();
	            compute_total_change();

	            validate_input_cash();
	            validate_submit_button();
	        }
	    });
	}

	function remove_customer_basket_item(basket)
	{
	    $.ajax({
	        url : '{{ route('inventory.route',['path' => active_path(), 'action' => 'inventory-delete-customer-basket', 'id' => encrypt(1)]) }}',
	        type : 'get',
	        dataType : 'html',
	        data : { basket_id: basket, },
	        success : function(data) {
	            retrieve_customer_basket(localStorage.getItem('customer_selected'));
	        }
	    });
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
	
	function remove_item_row(row, basket) 
	{
	    if(confirm('Are you sure you want to remove this row?')) {
	        $('.item-row-' + row).fadeOut(1000); remove_customer_basket_item(basket);
	    }
	}

	function hide_no_item_selected()
	{
	    compute_total_all_details_price() > 0.00 ? $('.no-item-selected').addClass('hide') : $('.no-item-selected').removeClass('hide') ;
	}

</script>

@endpush