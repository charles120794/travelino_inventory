@foreach($customer_basket as $key => $value)

<tr class="item-row-{{ $key }}">

    <input type="hidden" id="basket_id{{ $key }}" name="item[{{ $key }}][basket_id]" value="{{ encrypt($value->basket_id) }}">
    <input type="hidden" id="item_id{{ $key }}" name="item[{{ $key }}][item_id]" value="{{ encrypt($value->basket_item_id) }}">
    <input type="hidden" id="item_code{{ $key }}" name="item[{{ $key }}][item_code]" value="{{ $value->basket_item_code }}">
    <input type="hidden" id="item_unit_id{{ $key }}" name="item[{{ $key }}][item_unit_id]" value="{{ encrypt($value->basket_item_unit_id) }}">
    
    <input type="hidden" id="item_price_old{{ $key }}" name="item[{{ $key }}][item_price_old]" value="{{ $value->basket_item_price_old }}">
    <input type="hidden" id="item_quantity_old{{ $key }}" name="item[{{ $key }}][item_quantity_old]" value="{{ $value->basket_item_quantity_old }}">

    <td class="no-padding">
        <div class="input-group">
            <div class="input-group-btn">
                <button type="button" class="btn btn-danger btn-flat" onclick="return remove_item_row({{ $key }}, '{{ encrypt($value['basket_id']) }}')" data-row="{{ $key }}">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
            <input type="text" class="form-control bg-white" id="item_description{{ $key }}" name="item[{{ $key }}][item_description]" value="{{ $value->basket_item_description }}" required="required" readonly="readonly">
        </div>
    </td>
    <td class="no-padding">
        <input type="text" class="form-control bg-white" id="item_unit{{ $key }}" name="item[{{ $key }}][item_unit]" value="{{ $value->basket_item_unit_description }}" required="required" readonly="readonly">
    </td>
    <td class="no-padding">
        <div class="input-group">
            <div class="input-group-btn">
                <button class="btn btn-default btn-flat item-les-qty" id="item-les-qty{{ $key }}" data-key="{{ $key }}" type="button">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <input type="text" class="form-control text-center input-number input-quantity basket-quantity" id="item_quantity{{ $key }}" name="item[{{ $key }}][item_quantity]" value="{{ number_format($value->basket_item_quantity_new) }}" required="required" data-key="{{ $key }}">
            <div class="input-group-btn">
                <button class="btn btn-default btn-flat item-add-qty" id="item-add-qty{{ $key }}" data-key="{{ $key }}" type="button">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </td>
    <td class="no-padding">
        <input type="text" class="form-control bg-white text-right total-row-price" id="item_total_price{{ $key }}" name="item[{{ $key }}][item_total_price]" value="{{ $value->basket_item_price_new }}" readonly="readonly">
    </td>
</tr>

@endforeach
