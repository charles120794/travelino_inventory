<div class="form-group">
    <label>Code</label>
    <input type="text" class="form-control bg-white" value="{{ $product->item_code }}" disabled>
</div>
<div class="form-group">
  	<label>Full Description</label>
    <textarea class="form-control bg-white" style="resize: vertical; height: 100px;" disabled>{{ $product->item_long_description }}</textarea>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
              	<label>Unit</label>
              	<input type="text" class="form-control bg-white" value="{{ $product->itemUnit['unit_description'] }}" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label>Purchase Price</label>
                <input type="text" class="form-control bg-white text-right" value="{{ number_format($product->item_purchase_price, 2) }}" disabled>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label>Minimum Stock</label>
                <input type="text" class="form-control bg-white" value="{{ $product->item_min_quantity }}" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label>Condition</label>
                <input type="text" class="form-control bg-white" value="{{ $product->item_condition }}" disabled>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label>Purchase Date</label>
                <input type="text" class="form-control bg-white" value="{{ date('F d, Y', strtotime($product->item_purchase_date)) }}" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label>Expiry Date</label>
                <input type="text" class="form-control bg-white" value="{{ (!is_null($product->item_expiry_date)) ? date('F d, Y', strtotime($product->item_expiry_date)) : 'No Expiration Date' }}" disabled>
            </div>
        </div>
    </div>
</div>