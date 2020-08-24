<div class="row pro-pb-3 hide" id="variation-2-hidden">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Variation 2</h4>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-link pull-right" onclick="$(this).closest('.row').empty(), computeTotalPrice(), computeTotalQuantity(), $('#variation-button').removeClass('hide')"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Description <span class="text-red">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="variant_name_2" autocomplete="variant-name">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat btn-append-option" onclick="appendOption(this)" data-variant="2" data-target="#append-variation-2"><i class="fa fa-plus"></i></button>
                        </span>
                    </div>
                </div>
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr class="bg-gray-light">
                            <th class="text-center col-sm-3">Option</th>
                            <th class="text-center col-sm-3">Price</th>
                            <th class="text-center col-sm-3">Quantity</th>
                            <th class="text-center col-sm-3" colspan="2">Unit</th>
                        </tr>
                    </thead>
                    <tbody id="append-variation-2">
                        <tr>
                            <td class="no-padding">
                                <input type="text" class="form-control text-center" name="option2[0][option]" autocomplete="option-name">
                            </td>
                            <td class="no-padding">
                                <input type="text" class="form-control text-center input-currency input-price" oninput="computeTotalPrice($(this))" onblur="computeTotalPrice($(this),'blur')" name="option2[0][price]" value="0.00" autocomplete="option-price">
                            </td>
                            <td class="no-padding">
                                <input type="text" class="form-control text-center input-number input-quantity" oninput="computeTotalQuantity($(this))" name="option2[0][quantity]" placeholder="Qty." autocomplete="option-quantity">
                            </td>
                            <td class="no-padding">
                                <input type="text" class="form-control text-center" name="option2[0][unit]" placeholder="Unit" autocomplete="option-unit">
                            </td>
                            <td class="no-padding">
                                <button class="btn btn-default btn-flat" disabled><i class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>