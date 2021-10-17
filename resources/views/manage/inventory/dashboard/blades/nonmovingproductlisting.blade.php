<table class="table table-bordered table-condensed">
    <thead>
        <tr class="bg-gray-light no-wrap">
            <th class="text-center" style="width: 10%;">Code</th>
            <th class="text-center" style="width: 40%;">Description</th>
            <th class="text-center" style="width: 10%;">Unit</th>
            <th class="text-center" style="width: 10%;">Date Added</th>
            <th class="text-center" style="width: 10%;">Quantity</th>
            <th class="text-center" style="width: 10%;">Status</th>
            <th class="text-center" style="width: 10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $key => $item)

            <?php 
                $dt_fr = new DateTime($item->item_purchase_date);
                $dt_to = new DateTime(date('Y-m-d'));
                $interval = $dt_fr->diff($dt_to);
                
                if(date('Y-m-d') > date('Y-m-d', strtotime($item->item_purchase_date))) {
                    if($interval->format('%f') > 1) {
                        $age_status = $interval->format('%f') . ' month(s) ago';
                    } else {
                        $age_status = $interval->format('%a') . ' day(s) ago';
                    }
                } else {
                    $age_status = '<span class="text-red text-bold">Invalid</span>';
                }
            ?>

            <tr>
                <td class="v-align-middle"> 
                    <small><a href="#preview-details" class="btn-modal-product-details" data-id="{{ $item->item_id }}">{{ $item->item_code }}</a></small> 
                </td>
                <td class="v-align-middle"> <small>{{ $item->item_description }}</small> </td>
                <td class="v-align-middle"> <small>{{ $item->itemUnit['unit_description'] }}</small> </td>
                <td class="v-align-middle text-center no-wrap"> <small>{{ date('F d, Y', strtotime($item->created_date)) }}</small> </td>
                <td class="v-align-middle text-center"> <small>{{ number_format($item->item_quantity) }}</small> </td>
                <td class="v-align-middle text-center"> <small>{{ $age_status }}</small> </td>
                <td class="v-align-middle text-center"> 
                    <button class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Remove Item </button>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="6"> No Non-moving Products </td>
            </tr>
        @endforelse
    </tbody>
</table>