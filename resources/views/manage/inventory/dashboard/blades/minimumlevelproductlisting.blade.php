<table class="table table-bordered table-condensed">
    <thead>
        <tr class="bg-gray-light no-wrap">
            <th class="text-center" style="width: 10%;"> Code </th>
            <th class="text-center" style="width: 50%;"> Description </th>
            <th class="text-center" style="width: 10%;"> Unit </th>
            <th class="text-center" style="width: 10%;"> Remaining Qty. </th>
            <th class="text-center" style="width: 10%;"> Action </th>
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
                <td class="v-align-middle text-center"> <small>{{ number_format($item->item_quantity - $item->item_quantity_sold) }}</small> </td>
                <td class="v-align-middle text-center"> 
                    <button type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add Item </button>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="5"> No Products in minimum Level </td>
            </tr>
        @endforelse
    </tbody>
</table>