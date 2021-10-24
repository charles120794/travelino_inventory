@push('scripts')

<script type="text/javascript">

	function compute_total_per_details_quantity(qty = 0)
	{
	    $('.basket-quantity').each(function(key, value){
	        qty += parseInt(value.value);
	    });

	    return qty;
	}

	function compute_total_per_details_price(key)
	{
	    var totalQuantity = parseInt($('#item_quantity' + key).val());
	    var totalAmounts_ = parseFloat($('#item_price_old' + key).val()).toFixed(2);

	    $('#item_total_price' + key).val(formatMoney(totalAmounts_ * totalQuantity));
	}

	function compute_total_all_details_price(price = 0.00)
	{
	    $('.total-row-price').each(function(key, value) {
	        price += parseFloat($(this).val().replace(/,/g, ""));
	        formatCurrency($('#' + $(this).attr('id')));
	    });

	    return price;
	}

	function compute_total_change()
	{
	    if(compute_total_all_details_price().toFixed(2) > 0.00) {
	        var inputCash = $('input[name="total_cash"]').val().replace(/,/g, "");
	        var totalChange = parseFloat(inputCash).toFixed(2) - compute_total_all_details_price().toFixed(2); 
	        if(parseFloat(inputCash).toFixed(2) > 0.00) {
	            $('input[name="total_change"]').val(formatMoney(totalChange));
	        } else {
	            $('input[name="total_change"]').val('0.00');
	        }
	    }
	}

	function display_total_price()
	{
	    $('#total_price').text(formatMoney(compute_total_all_details_price()));
	}

	function display_total_quantity()
	{
		$('#total_quantity').text(compute_total_per_details_quantity());
	}

	function formatMoney(amount)
	{
	    return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
	}

</script> 

@endpush