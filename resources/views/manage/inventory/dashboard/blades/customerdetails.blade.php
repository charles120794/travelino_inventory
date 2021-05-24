
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Customer Name</label>
            <input type="text" class="form-control bg-white" value="{{ $customer->customer_description }}" disabled>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Code</label>
            <input type="text" class="form-control bg-white" value="{{ $customer->customer_code }}" disabled>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
              	<label>Contact</label>
              	<input type="text" class="form-control bg-white" value="{{ $customer->customerContact['contact_number'] }}" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                <label>E-mail</label>
                <input type="text" class="form-control bg-white" value="{{ $customer->customerContact['contact_email'] }}" disabled>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-group">
                <label>Complete Address</label>
                <textarea class="form-control bg-white" style="resize: vertical;" disabled>{{ $customer->customerAddress['address_complete'] }}</textarea>
            </div>
        </div>
    </div>
</div>