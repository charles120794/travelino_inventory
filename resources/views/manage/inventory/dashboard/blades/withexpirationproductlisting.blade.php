<table class="table table-bordered table-condensed table-product-with-expiration-date">
    <thead>
        <tr class="bg-gray-light no-wrap">
            <th class="text-center" style="width: 10%;">Code</th>
            <th class="text-center" style="width: 50%;">Description</th>
            <th class="text-center" style="width: 10%;">Unit</th>
            <th class="text-center" style="width: 10%;">Expiration Date</th>
            <th class="text-center" style="width: 10%;">Status</th>
            <th class="text-center" style="width: 10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $key => $item)
            <?php 
                $dt_fr = new DateTime(date('Y-m-d'));
                $dt_to = new DateTime($item->item_expiry_date);
                $interval = $dt_fr->diff($dt_to);
                
                if(date('Y-m-d', strtotime(date('Y-m-d'))) < date('Y-m-d', strtotime($item->item_expiry_date))) {
                    $due_date = $interval->format('%a') . 'd';
                } else {
                    $due_date = '<span class="text-red text-bold"> Expired </span>';
                }
            ?>
            <tr>
                <td class="v-align-middle"> 
                    <small><a href="#preview-details" class="btn-modal-product-details" data-id="{{ $item->item_id }}">{{ $item->item_code }}</a></small> 
                </td>
                <td class="v-align-middle"> <small>{{ $item->item_description }}</small> </td>
                <td class="v-align-middle"> <small>{{ $item->itemUnit['unit_description'] }}</small> </td>
                <td class="v-align-middle text-center"> <small>{{ date('F d, Y', strtotime($item->item_expiry_date)) }}</small> </td>
                <td class="v-align-middle text-center"> <small>{!! $due_date !!}</small> </td>
                <td class="v-align-middle text-center">
                    <button class="btn btn-default btn-xs"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hooray!"><i class="fa fa-remove"></i></button>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="6"> No Products with Expiration Date </td>
            </tr>
        @endforelse
    </tbody>
</table>