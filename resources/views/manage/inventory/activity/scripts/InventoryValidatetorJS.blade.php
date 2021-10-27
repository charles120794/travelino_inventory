@push('scripts')

<script type="text/javascript">

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
	        // alert('Not enough stock is available, this will give you all the available quantity');
	        if(confirm('Not enough stock is available, Do you want to continue with the max available quantity?')) {
	        	event.val(parseInt($('#item_quantity_old' + event.data('key')).val()));
	        	update_basket_quantity(event.data('key'));
	        } else {
	        	event.val(parseInt($('#item_quantity_old' + event.data('key')).val()))
	        }
	    }

	    if(event.val() <= 0) {
	        event.val(1);
	    }
	}

	function validate_input_cash() 
	{
	    if(compute_total_all_details_price() > 0.00) {
	        $('.input-cash').attr('disabled', false).attr('readonly', false);
	    } else {
	        $('.input-cash').attr('disabled', true).attr('readonly', true).val('0.00');
	        $('input[name="total_change"]').val('0.00')
	    }
	}

	function validate_submit_button(errors = 0)
	{
	    /* IF Input Cash is Greater Than Total Price*/
	    if(parseFloat($('.input-cash').val().replace(/,/g, "")) < parseFloat(compute_total_all_details_price().toFixed(2))) {
	        errors++;
	    }
	    /* IF Total Price not equal to Zero*/
	    if(compute_total_all_details_price() == 0.00) {
	        errors++;
	    }
	    
	    /* If no Errors found Enable Submit Button */
	    if(errors == 0) {
	        $('.btn-submit').attr('type','submit').attr('disabled',false);
	    } else {
	        $('.btn-submit').attr('type','button').attr('disabled',true);
	    }
	}

</script>

@endpush