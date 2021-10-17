<div class="box box-default box-solid">
    <div class="box-body">
		<div class="row" style="overflow-x: auto;">
		    <div class="col-md-12">
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th class="text-center"> Date </th>
							<th class="text-center"> Customer Name </th>
							<th class="text-center"> Total Amount </th>
							<th class="text-center"> Payment Status </th>
							<th class="text-center"> Action </th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $key => $order)
						<tr>
							<td class="v-align-middle">{{ date('F d, Y', strtotime($order['cashier_date'])) }}</td>
							<td class="v-align-middle">{{ $order['cashier_customer_name'] }}</td>
							<td class="v-align-middle text-right text-bold text-blue">{{ number_format($order['cashier_total_amt'], 2) }}</td>
							<td class="v-align-middle">{{ $order['cashier_status_order'] }}</td>
							<td class="v-align-middle text-center">
								<button class="btn btn-primary"><i class="fa fa-print"></i></button>
							</td>
						</tr>
						@endforeach 
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


