<div class="modal fade" id="modalsearchproduct">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
    		<div class="modal-header">
    		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    		    <span aria-hidden="true"> &times; </span></button>
    		    <h4 class="modal-title"><i class="fa fa-search"></i> Product / Item </h4>
    		</div>
    		<div class="modal-body">
                <input type="text" class="form-control" name="search_modal_item" placeholder="Search Here...">
    			<table class="table table-bordered table-condensed">
                    <thead>
                        <tr class="bg-gray-light" style="height: 40px;">
                            <th class="v-align-middle text-center">Code</th>
                            <th class="v-align-middle text-center">Description</th>
                            <th class="v-align-middle text-center">Stock</th>
                            <th class="v-align-middle text-right">Cost</th>
                            <th class="v-align-middle text-center">Quantity</th>
                            <th class="v-align-middle text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $key => $value)
                        <tr>
                            <td class="v-align-middle modal-item-code{{ $key }}">{{ $value->item_code }}</td>
                            <td class="v-align-middle modal-item-description{{ $key }}">{{ $value->item_description }}</td>
                            <td class="v-align-middle text-center">{{ $value->item_quantity }}</td>
                            <td class="v-align-middle text-right modal-item-price{{ $key }}">{{ number_format($value->item_selling_price, 2) }}</td>
                            <td class="v-align-middle text-center no-padding" style="width: 140px;">
                                <input type="hidden" class="modal-item-unit{{ $key }}" value="{{ $value->itemUnit['unit_description'] }}">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-sm btn-flat modal-btn-les-qty modal-btn-les-qty{{ $key }}" data-key="{{ $key }}" disabled><i class="fa fa-minus"></i></button>
                                    </div>
                                    <input type="text" class="form-control text-center input-number input-quantity no-padding input-sm modal-item-qty modal-item-qty{{ $key }}" data-maxqty="{{ $value->item_quantity }}" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-sm btn-flat modal-btn-add-qty modal-btn-add-qty{{ $key }}" data-key="{{ $key }}" data-maxqty="{{ $value->item_quantity }}"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="v-align-middle text-center no-padding">
                                <button class="btn btn-primary btn-sm btn-flat selected-product" data-key="{{ $key }}" data-item="{{ $value->item_id }}">Select</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
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

	$(function(){

        $('.modal-item-qty').on('input', function(){
            if($(this).val() >= parseInt($(this).data('maxqty'))) {
                alert('Not enough stocks avaible');
                $(this).val(1);
            }
        });

        $('.modal-btn-les-qty').on('click', function(){
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

        $('.modal-btn-add-qty').on('click', function(event){
            var key = $(this).data('key'); 
            if($('.modal-item-qty' + key).val() >= parseInt($(this).data('maxqty'))) {
                $('.modal-btn-les-qty' + key).attr('disabled', false);
                $(this).attr('disabled',true);
            } else {
                $('.modal-btn-les-qty' + key).attr('disabled', false);
                $('.modal-item-qty' + key).val(function(i, old){
                    return parseInt(old) + 1;
                });
            }
        });
        
        $('.product-item-list').on('click', '.search-modal-product', function(event){
            $('#modalsearchproduct').modal('show');
            $('#input_id').val($(this).data('inputid'));
            $('#input_name').val($(this).data('input'));
        });

        $('.selected-product').on('click',function(){

            $(this).attr('disabled',true);

            $('.modal-btn-les-qty' + $(this).data('key')).attr('disabled',true);
            $('.modal-btn-add-qty' + $(this).data('key')).attr('disabled',true);

            $('.modal-item-qty' + $(this).data('key')).attr('disabled',true);

            var item_qty   = parseInt($('.modal-item-qty' + $(this).data('key')).val());
            var item_price = parseFloat($('.modal-item-price' + $(this).data('key')).text().replace(/,/g, "")).toFixed(2);

            var data = {
                code        : $('.modal-item-code' + $(this).data('key')).text(),
                description : $('.modal-item-description' + $(this).data('key')).text(),
                unit        : $('.modal-item-unit' + $(this).data('key')).val(),
                quantity    : $('.modal-item-qty' + $(this).data('key')).val(),
                price       : parseFloat(item_price * item_qty).toFixed(2),
            };

            append_selected_item(data);

            computeTotalPrice();

            $('.no-item-selected').addClass('hide');
    
        });

	});

    var countStart = 1;

    function append_selected_item(data = []) {

        count = countStart++;

        var div = $("<div></div>").attr('class','row item-row' + count).append(
                    $('<div></div>').attr('class','col-md-6').html(
                        $('<div></div>').attr('class','form-group text-center').append(
                            $('<div></div>').attr('class','input-group').append(
                                $('<div></div>').attr('class','input-group-btn').html(
                                    '<button type="button" class="btn btn-danger btn-flat" onclick="return remove_item_row(' + count + ')" data-row"' + count + '"><i class="fa fa-remove"></i></button>'
                                ),
                                $('<input>').attr('type','text')
                                            .attr('id','item_description' + count)
                                            .attr('class','form-control bg-white')
                                            .attr('name','item[' + count + '][item_description]')
                                            .attr('required',true)
                                            .attr('readonly',true)
                                            .val(data.description),
                                $('<input>').attr('type','hidden')
                                            .attr('id','item_id' + count)
                                            .attr('name','item[' + count + '][item_id]'),
                            )
                        ),
                    ),
                    $('<div></div>').attr('class','col-md-2').html(
                        $('<div></div>').attr('class','form-group text-center').html(
                            $('<input>').attr('type','text')
                                        .attr('class','form-control bg-white')
                                        .attr('id','item_unit' + count)
                                        .attr('name','item[' + count + '][item_unit]')
                                        .attr('required',true)
                                        .attr('readonly',true)
                                        .val(data.unit),
                            $('<input>').attr('type','hidden')
                                        .attr('id','item_unit_id' + count)
                                        .attr('name','item[' + count + '][item_unit_id]'),
                        )
                    ),
                    $('<div></div>').attr('class','col-md-2').html(
                        $('<div></div>').attr('class','form-group text-center').html(
                            $('<div></div>').attr('class','input-group').append(
                                $('<div></div>').attr('class','input-group-btn').append(
                                    $('<button></button>').attr('class','btn btn-default btn-flat item-les-qty')
                                    .attr('type','button')
                                    .append($('<i></i>').attr('class','fa fa-minus')),
                                ),
                                $('<input>').attr('type','text')
                                            .attr('class','form-control text-center input-number input-quantity')
                                            .attr('id','item_quantity' + count)
                                            .attr('name','item[' + count + '][item_quantity]')
                                            .attr('required',true)
                                            .val(data.quantity),
                                $('<div></div>').attr('class','input-group-btn').append(
                                    $('<button></button>').attr('class','btn btn-default btn-flat item-add-qty')
                                    .attr('type','button')
                                    .append($('<i></i>').attr('class','fa fa-plus')),
                                ),
                                $('<input>').attr('type','hidden')
                                            .attr('id','item_org_price' + count)
                                            .attr('name','item[' + count + '][item_org_price]')
                                            .val(data.price),

                            )
                        )
                    ),
                    $('<div></div>').attr('class','col-md-2').html(
                        $('<div></div>').attr('class','form-group text-center').html(
                            $('<input>').attr('type','text')
                                            .attr('class','form-control bg-white text-right')
                                            .attr('id','item_total_price' + count)
                                            .attr('name','item[' + count + '][item_total_price]')
                                            .attr('readonly',true)
                                            .val(data.price),
                        )
                    ),
                  );

        $('.product-item-list').append(div);

    };

    function remove_item_row(row) {
        if(confirm('Are you sure you want to remove this row?')) {
            $('.item-row' + row).remove();
            computeTotalPrice()
        }
    }

</script>

@endpush