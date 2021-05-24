<table class="table table-bordered table-condensed">
    <thead>
        <tr class="bg-gray-light no-wrap">
            <th class="text-center" style="width: 10%;">Code</th>
            <th class="text-center" style="width: 30%;">Customer Name</th>
            <th class="text-center" style="width: 10%;">Date Added</th>
            <th class="text-center" style="width: 10%;">Total Quantity</th>
            <th class="text-center" style="width: 10%;">Total Cost</th>
            <th class="text-center" style="width: 10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($customers as $key => $customer)
        <tr>
            <td class="v-align-middle text-center no-padding">
                <button class="btn btn-link btn-modal-customer-details" data-id="{{ encrypt($customer->customer_id) }}">{{ $customer->customer_code }}</button>
            </td>
            <td class="v-align-middle">{{ $customer->customer_description }}</td>
            <td class="v-align-middle text-center">{{ date_format(date_create($customer->created_date), 'F d, Y') }}</td>
            <td class="v-align-middle text-center">{{ $customer->customerCashier->sum('total_quantity') }}</td>
            <td class="v-align-middle text-right text-blue text-bold"> &#8369;{{ number_format($customer->total_cost, 2) }} </td>
            <td class="v-align-middle text-center">
                <button class="btn btn-primary btn-xs"><i class="fa fa-search"></i></button>
            </td>
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="6"> No Top Customers </td>
        </tr>
        @endforelse
    </tbody>
</table>