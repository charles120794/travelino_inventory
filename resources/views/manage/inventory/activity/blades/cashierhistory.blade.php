<div class="box box-default box-solid">
    <div class="box-body">
		<div class="row" style="overflow-x: auto;">
		    <div class="col-md-12">
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th class="text-center" style="width: 50%;"> Customer Name </th>
							<th class="text-center" style="width: 20%;"> Date Purchased </th>
							<th class="text-center" style="width: 20%;"> Total Amount </th>
							<th class="text-center" style="width: 20%;"> Action </th>
						</tr>
					</thead>
					<tbody>
						@foreach($cashiers as $key => $cashier)
						<tr>
							<td class="v-align-middle">{{ $cashier['cashier_customer_name'] }}</td>
							<td class="v-align-middle">{{ date('F d, Y', strtotime($cashier['cashier_date'])) }}</td>
							<td class="v-align-middle text-right text-bold text-blue">
								&#8369; {{ number_format($cashier['cashier_total_price'], 2) }}
							</td>
							<td class="v-align-middle text-center">
								<button class="btn btn-primary"><i class="fa fa-print"></i></button>
							</td>
						</tr>
						@endforeach 
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
		        <div class="pull-right">
		            {{ $cashiers->links('vendor.pagination.cashierHistoryPagination') }}
		        </div>
		    </div>
		</div>
	</div>
	<div class="overlay modal-loader-overlay">
        <i class="fa fa-refresh fa-spin modal-loader-spin"></i>
    </div>
</div>


