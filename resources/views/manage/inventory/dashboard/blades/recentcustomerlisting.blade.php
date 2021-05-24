<table class="table table-bordered table-condensed">
    <thead>
        <tr class="bg-gray-light no-wrap">
            <th class="text-center" style="width: 10%;">Code</th>
            <th class="text-center" style="width: 20%;">Customer Name</th>
            <th class="text-center" style="width: 10%;">Date Purchased</th>
            <th class="text-center" style="width: 10%;">Purchase Type</th>
            <th class="text-center" style="width: 10%;">Total Quantity</th>
            <th class="text-center" style="width: 10%;">Total Cost</th>
            <th class="text-center" style="width: 10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cashiers as $key => $cashier)
        <tr>
            <td class="v-align-middle text-center no-padding">
                <button class="btn btn-link btn-modal-customer-details" data-id="{{ encrypt($cashier->cashierCustomer['customer_id']) }}">{{ $cashier->cashierCustomer['customer_code'] }} {{ $path }}</button>
            </td>
            <td class="v-align-middle">{{ $cashier->cashierCustomer['customer_description'] }}</td>
            <td class="v-align-middle text-center">{{ date_format(date_create($cashier->cashier_date), 'F d, Y') }}</td>
            <td class="v-align-middle">{{ ucfirst($cashier->cashier_purchase_type) }}</td>
            <td class="v-align-middle text-center">{{ number_format($cashier->total_quantity) }}</td>
            <td class="v-align-middle text-right text-blue text-bold"> &#8369;{{ number_format($cashier->total_cost, 2) }} </td>
            <td class="v-align-middle text-center">
                <a href="{{ route('inventory.route',['path' => 'sales-cashier', 'action' => 'retrieve-cashier-receipt', 'id' => encrypt($cashier->cashier_id)]) }}" target="_blank" class="btn btn-success btn-xs btn-flat"><i class="fa fa-print"></i></a>
                <button class="btn btn-primary btn-xs btn-modal-customer-cashier-details" data-id="{{ encrypt($cashier->cashier_id) }}"><i class="fa fa-list"></i></button>
            </td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="6"> No Recent Customers </td>
        </tr>
        @endforelse
    </tbody>
</table>