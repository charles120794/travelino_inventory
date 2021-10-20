<table class="table table-bordered table-condensed table-top-selling-product">
    <thead>
        <tr class="bg-gray-light no-wrap">
            <th class="text-center" style="width: 10%;"> Code </th>
            <th class="text-center" style="width: 40%;"> Description sss</th>
            <th class="text-center" style="width: 10%;"> Unit </th>
            <th class="text-center" style="width: 10%;"> Qty. Sold </th>
            <th class="text-center" style="width: 10%;"> Stock </th>
            <th class="text-center" style="width: 10%;"> Cost </th>
            <th class="text-center" style="width: 10%;"> Price </th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $key => $item)
            <tr>
                <td class="v-align-middle"> 
                    <small><a href="#preview-details" class="btn-modal-product-details" data-id="{{ $item->item_id }}">{{ $item->item_code }}</a></small> 
                </td>
                <td class="v-align-middle"> <small>{{ $item->item_description }}</small> </td>
                <td class="v-align-middle"> <small>{{ $item->itemUnit['unit_description'] }}</small> </td>
                <td class="v-align-middle text-center"> <small>{{ number_format($item->item_quantity_sold) }}</small> </td>
                <td class="v-align-middle text-center"> <small>{{ number_format($item->item_quantity - $item->item_quantity_sold) }}</small> </td>
                <td class="v-align-middle text-right text-green text-bold"> 
                    <small>&#8369;{{ number_format($item->item_quantity_sold * $item->item_purchase_price, 2) }}</small>
                </td>
                <td class="v-align-middle text-right text-blue text-bold"> 
                    <small>&#8369;{{ number_format($item->item_quantity_sold * $item->item_selling_price, 2) }}</small> 
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="7"> No Top Selling Products </td>
            </tr>
        @endforelse
    </tbody>
</table>