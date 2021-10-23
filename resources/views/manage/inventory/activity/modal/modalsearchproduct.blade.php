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
        });
    });

    $(document).on('click', '.selected-product', function(event){

        $(this).attr('disabled',true);

        $('.modal-btn-les-qty' + $(this).data('key')).attr('disabled',true);
        $('.modal-item-qty' + $(this).data('key')).attr('disabled',true);
        $('.modal-btn-add-qty' + $(this).data('key')).attr('disabled',true);

        create_customer_basket_item($(this).data('item'), $('.modal-item-qty' + $(this).data('key')).val());
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
            
            computeTotalQtyPrice(key);
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
            computeTotalQtyPrice(key);
            computeTotalPrice();
            computeTotalChange();
            computeTotalQuantity();
            validate_btn_submit();
        }
    });

    $(document).on('input','.input-quantity', function(){
        var key = $(this).data('key');
        validate_form_input_qty($(this));

        computeTotalQtyPrice(key);
        computeTotalPrice();
        computeTotalChange();
        validate_btn_submit();
    });

    // $(document).on('keypress', 'input[name="search_modal_item"]', function(event){
    //     if(event.which == 13){ retrieve_item_per_page(); }
    // });

    // $(document).on('change', 'input[name="search_modal_item"]', function(event){
    //     retrieve_item_per_page($(this).data('page'));
    // });

    // $(document).on('click', '.page-number', function(event){
    //     retrieve_item_per_page($(this).data('page'));
    //     ajax_call_customers($(this).data('page'));
    //     event.preventDefault();
    // });

</script>

@endpush