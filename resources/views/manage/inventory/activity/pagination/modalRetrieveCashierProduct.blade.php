<div class="box box-default box-solid">
    <div class="box-body">
        {{-- <input type="text" class="form-control" name="search_modal_item" id="search_modal_item" placeholder="Search Here..." value="{{ $search ?? '' }}" style="margin-bottom: 10px;"> --}}
        <div class="row" style="overflow-x: auto;">
            <div class="col-md-12">
                <table class="table table-bordered table-condensed cashier-product_datatable" style="max-height: 70vh; overflow-y: scroll;">
                    <thead>
                        <tr class="bg-gray-light" style="height: 40px;">
                            <th class="v-align-middle text-center" style="width: 10%;"> Code </th>
                            <th class="v-align-middle text-center" style="width: 40%;"> Description </th>
                            <th class="v-align-middle text-center" style="width: 10%;"> Stock </th>
                            <th class="v-align-middle text-center" style="width: 10%;"> Price </th>
                            <th class="v-align-middle text-center" style="width: 10%;"> Quantity </th>
                            <th class="v-align-middle text-center" style="width: 20%;"> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                        @php 
                            $count = 1;
                        @endphp

                        @forelse ($products as $value)

                            <?php 
                                $total_quantity = $value['item_quantity'] - $value['item_quantity_sold'] - $value['item_quantity_checkout'];
                                $total_quantity_remaining = (is_null($value['item_quantity_sold'])) ? $value['item_quantity'] : $total_quantity ;

                                $counter = $count++
                            ?>

                            <tr>
                                <td class="v-align-middle">{{ $value['item_code'] }}</td>
                                <td class="v-align-middle">{{ $value['item_description'] }}</td>
                                <td class="v-align-middle text-center">{{ number_format($total_quantity_remaining) }}</td>
                                <td class="v-align-middle text-right text-blue text-bold">&#8369;{{ number_format($value['item_selling_price'], 2) }}</td>
                                <td class="v-align-middle text-center no-padding" style="width: 140px;">
                                    
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-sm btn-flat modal-btn-les-qty modal-btn-les-qty{{ $counter }}" data-key="{{ $counter }}" disabled>
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text" class="form-control text-center input-number input-quantity no-padding input-sm modal-item-qty modal-item-qty{{ $counter }}" data-key="{{ $counter }}" style="min-width: 50px;" value="1">

                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-sm btn-flat modal-btn-add-qty modal-btn-add-qty{{ $counter }}" data-key="{{ $counter }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <input type="hidden" id="item_max_qty{{ $counter }}" value="{{ $total_quantity_remaining }}">

                                </td>
                                <td class="v-align-middle text-center no-padding">
                                    <a href="{{ encrypt($value['item_id']) }}" class="btn btn-primary btn-sm btn-flat selected-product" data-key="{{ $counter }}"> Select </a>
                                </td>
                            </tr>
                            
                        @empty
                        <tr>
                            <td class="text-center" colspan="6"> No result's found </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="overlay modal-loader-overlay">
        <i class="fa fa-refresh fa-spin modal-loader-spin"></i>
    </div>
</div>