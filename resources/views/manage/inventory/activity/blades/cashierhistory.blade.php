<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th class="text-center"> Date </th>
			<th class="text-center"> Customer Name </th>
			<th class="text-center"> Total Amount </th>
			<th class="text-center"> Action </th>
		</tr>
	</thead>
	<tbody>
		@foreach($cashiers as $key => $cashier)
		<tr>
			<td class="v-align-middle">{{ date('F d, Y', strtotime($cashier['cashier_date'])) }}</td>
			<td class="v-align-middle">{{ $cashier['cashier_customer_name'] }}</td>
			<td class="v-align-middle text-right text-bold text-blue">{{ number_format($cashier['cashier_total_amt'], 2) }}</td>
			<td class="v-align-middle text-center">
				<button class="btn btn-primary"><i class="fa fa-print"></i></button>
			</td>
		</tr>
		@endforeach 
	</tbody>
</table>


