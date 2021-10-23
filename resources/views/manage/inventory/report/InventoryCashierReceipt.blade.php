@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<section class="content">

    @include('layouts.alerts.errors.alerts')

	<div class="row">
	    <div class="col-md-12">
	        <div class="box box-solid">
	            <div class="box-body">
	                <h3 class="panel-title pull-left" style="margin-top: 8px;">
	                    <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
	                </h3>
	                <div class="pull-right">
	                    <a href="{{ route('inventory.route',['path' => active_path()]) }}" class="btn btn-primary btn-modal-recent"><i class="fa fa-arrow-left"></i> &nbsp; Back to Cashier </a>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="box box-default box-solid" id="printable-receipt">
	    <div class="box-body">

    	  	<div class="row">
    	        <div class="col-xs-12">
    	          	<h2 class="page-header">
    		        	<i class="fa fa-home"></i> {{ $company['company_description'] }}
    		            <small class="pull-right">Date: {{ date('F d, Y', strtotime($cashier['cashier_date'])) }}</small>
    	          	</h2>
    	        </div>
    	  	</div>

	  	  	<div class="row invoice-info">
	  	    	<div class="col-sm-4 invoice-col">
	  		      	From
	  		      	<address>
	  		            <strong>{{ $company['company_description'] }}</strong><br>
	  		            {{ $company['company_address'] }}<br>
	  		            Email: {{ $company['company_email'] }}
	  		      	</address>
	  		    </div>

	  		    <div class="col-sm-4 invoice-col">
	  		      	To
	  		      	<address>
	  		            <strong>{{ $cashier['cashier_customer_name'] }}</strong><br>
	  		            {{ $cashier->cashierCustomer->customerAddress['address_number'] }}<br>
	  		            {{ $cashier->cashierCustomer->customerAddress['address_street'] }} 
	  		            {{ $cashier->cashierCustomer->customerAddress['address_barangay'] }} 
	  		            {{ $cashier->cashierCustomer->customerAddress['address_city'] }}<br>
	  		            Email: {{ $cashier->cashierCustomer->customerContact['contact_email'] }}
	  		      	</address>
	  		    </div>

	  		    <div class="col-sm-4 invoice-col">
	  		      	<b>Invoice: {{ $cashier['cashier_code'] }} </b><br>
	  		      	<br>
	  		      	<b>Order ID: </b> {{ $cashier['cashier_id'] }}<br>
	  		      	<b>Payment Due: </b> <br>
	  		      	<b>Account: </b> 
	  		    </div>
	  	  	</div>

  	  	  	<div class="row">
  	  	        <div class="col-xs-12 table-responsive">
  	  	          	<table class="table table-bordered">
  	  	            	<thead>
  	  	            		<tr>
  	  	              			<th>Qty</th>
  	  	              			<th>Code</th>
  	  	              			<th>Description</th>
  	  	              			<th class="text-right">Subtotal</th>
  	  	            		</tr>
  	  	            	</thead>
  	  		            <tbody>
  	  		            @foreach($cashier->cashierDetails as $value)
  	  		            <tr>
  	  		              	<td>{{ $value['cashier_quantity'] }}</td>
  	  		              	<td>{{ $value['cashier_item_code'] }}</td>
  	  		              	<td>{{ $value['cashier_item_description'] }}</td>
  	  		              	<td class="text-right">&#8369; {{ number_format($value['cashier_selling_price'], 2) }}</td>
  	  		            </tr>
  	  		            @endforeach
  	  		            </tbody>
  	  	      		</table>
  	  	    	</div>
  	  		</div>

  			<div class="row">
  		      	<div class="col-xs-8">
  		        	<p class="lead">Payment Methods:</p>
  		        	{{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
  		        	<img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
  		        	<img src="../../dist/img/credit/american-express.png" alt="American Express">
  		        	<img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}
  		        	<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"> Cash </p>
  		      	</div>

  		      	<div class="col-xs-4">
  	  		   	 	<p class="lead"> Payment Status: PAID </p>
  		        	<div class="table-responsive">
  	  		          	<table class="table table-bordered">
  	  		  				<tr>
  	  		      		  		<th style="width: 70%;"> Total Amount: </th>
  	  		      		  		<td style="width: 30%;" class="text-right"><strong>&#8369; {{ number_format($cashier['cashier_total_price'], 2) }}</strong></td>
  	  		  				</tr>
  	  		  				<tr>
  	  		      		  		<th style="width: 70%;"> Total Cash: </th>
  	  		      		  		<td style="width: 30%;" class="text-right">&#8369; {{ number_format($cashier['cashier_total_cash'], 2) }}</td>
  	  		  				</tr>
  	  		  				<tr>
  	  		      		  		<th style="width: 70%;"> Total Changed: </th>
  	  		      		  		<td style="width: 30%;" class="text-right">&#8369; {{ number_format($cashier['cashier_total_changed'], 2) }}</td>
  	  		  				</tr>
  	  		          	</table>
  	  		          	<table class="table table-bordered">
  	  		  				<tr>
  	  		      		  		<th style="width: 70%;"><small>Vatable:</small></th>
  	  		      		  		<td style="width: 30%;" class="text-right"><small>&#8369; {{ number_format($cashier['cashier_total_vatable'], 2) }}</small></td>
  	  		  				</tr>
  	  		  				<tr>
  	  		      		  		<th style="width: 70%;"><small>Vat (12%):</small></th>
  	  		      		  		<td style="width: 30%;" class="text-right"><small>&#8369; {{ number_format($cashier['cashier_total_vat'], 2) }}</small></td>
  	  		  				</tr>
  	  		  				<tr>
  	  		      		  		<th style="width: 70%;"><small>Vat Excempt Sale:</small></th>
  	  		      		  		<td style="width: 30%;" class="text-right"><small>&#8369; {{ number_format(0, 2) }}</small></td>
  	  		  				</tr>
  	  		            		<tr>
  	  		              		<th style="width: 70%;"><small>Zero Rated Sale:</small></th>
  	  		              		<td style="width: 30%;" class="text-right"><small>&#8369; {{ number_format(0, 2) }}</small></td>
  	  		            		</tr>
  	  		          	</table>
  		        	</div>
  		      	</div>
  			</div>
		</div>
	</div>

	<div class="box box-default box-solid">
	    <div class="box-body">
    		<div class="row no-print">
    	      	<div class="col-xs-12">
    	        	<button type="button" class="btn btn-success pull-right print-receipt"><i class="fa fa-print"></i> Print Receipt </button>
    	        	<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
    	          	<i class="fa fa-envelope"></i> Send as Email
    	        	</button>
    	      	</div>
    		</div>
	    </div>
	</div>
</section>

<div class="clearfix"></div>

@endsection

@push('scripts')

<script type="text/javascript">

	$('.print-receipt').on('click',function(){
		printData();
	});

	function printData()
	{
	   	var printable = $('#printable-receipt');
	   	printWindow = window.open('{{ route('inventory.route',['path' => active_path(), 'action' => 'inventory-print-customer-receipt', 'id' => encrypt($cashier['cashier_id']) ]) }}', 'Print Receipt', 'width=874, height=1240');
	}
	
</script>

@endpush