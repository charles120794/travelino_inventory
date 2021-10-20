$(document).ready(function(){
	$('.cashier-product_datatable').DataTable({
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
        ]
    });
});