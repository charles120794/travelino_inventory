<table class="table table-bordered table-condensed cashier-details-datatable">
    <thead>
        <tr class="bg-gray-light no-wrap">
            <th class="text-center" style="width: 10%;">Code</th>
            <th class="text-center" style="width: 40%;">Description</th>
            <th class="text-center" style="width: 10%;">Unit</th>
            <th class="text-center" style="width: 10%;">Quantity</th>
            <th class="text-center" style="width: 10%;">Cost</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cashier->cashierDetails as $key => $cashier)
            <tr>
                <td class="v-align-middle"> 
                    <small><a href="#preview-details" class="btn-modal-product-details" data-id="{{ $cashier->cashier_item }}">{{ $cashier->cashier_item_code }}</a></small> 
                </td>
                <td class="v-align-middle"> <small>{{ $cashier->cashier_item_description }}</small> </td>
                <td class="v-align-middle"> <small>{{ $cashier->cashierItemUnit['unit_description'] }}</small> </td>
                <td class="v-align-middle text-center"> <small>{{ number_format($cashier->cashier_quantity) }}</small> </td>
                <td class="v-align-middle text-right text-blue text-bold"> <small>&#8369;{{ number_format($cashier->cashier_selling_price, 2) }}</small> </td>
            </tr>
        @endforeach
    </tbody>
</table>