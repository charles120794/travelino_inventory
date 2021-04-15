<table class="table table-bordered table-condensed">
    <thead>
        <tr class="bg-gray-light no-wrap">
            @if($order_type == 'pending')
                <th class="text-center" style="width: 15%;">Code</th>
                <th class="text-center" style="width: 30%;">Customer Name</th>
                <th class="text-center" style="width: 15%;">Date</th>
                <th class="text-center" style="width: 10%;">Cost</th>
                <th class="text-center" style="width: 10%;">Action</th>
            @endif
            @if($order_type == 'paid')
                <th class="text-center" style="width: 15%;">Code</th>
                <th class="text-center" style="width: 30%;">Customer Name</th>
                <th class="text-center" style="width: 15%;">Order Date</th>
                <th class="text-center" style="width: 15%;">Paid/Delivery Date</th>
                <th class="text-center" style="width: 10%;">Cost</th>
                <th class="text-center" style="width: 10%;">Action</th>
            @endif
            @if($order_type == 'cancelled')
                <th class="text-center" style="width: 15%;">Code</th>
                <th class="text-center" style="width: 30%;">Customer Name</th>
                <th class="text-center" style="width: 15%;">Order Date</th>
                <th class="text-center" style="width: 10%;">Date Cancelled</th>
                <th class="text-center" style="width: 10%;">Cost</th>
                <th class="text-center" style="width: 10%;">Action</th>
            @endif
        </tr>
    </thead>
    <tbody>

        @if($order_type == 'pending')
            @forelse($orders as $key => $order)
                <tr>
                    <td class="v-align-middle"> {{ $order->cashier_code }} </td>
                    <td class="v-align-middle"> {{ $order->cashier_customer_name }} </td>
                    <td class="v-align-middle"> {{ date('F d, Y', strtotime($order->cashier_date)) }} </td>
                    <td class="v-align-middle text-right text-blue text-bold"> &#8369;{{ number_format($order->cashier_total_amt, 2) }} </td>
                    <td class="v-align-middle text-center"> 
                        <button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                        <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="5"> No Pending Orders </td>
                </tr>
            @endforelse
        @endif

        @if($order_type == 'paid')
            @forelse($orders as $key => $order)
                <tr>
                    <td class="v-align-middle"> {{ $order->cashier_code }} </td>
                    <td class="v-align-middle"> {{ $order->cashier_customer_name }} </td>
                    <td class="v-align-middle"> {{ date('F d, Y', strtotime($order->cashier_date)) }} </td>
                    <td class="v-align-middle"> {{ date('F d, Y', strtotime($order->cashier_payment_date)) }} </td>
                    <td class="v-align-middle text-right text-blue text-bold"> &#8369;{{ number_format($order->cashier_total_amt, 2) }} </td>
                    <td class="v-align-middle text-center"> 
                        <button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6"> No Delivered Orders </td>
                </tr>
            @endforelse
        @endif

        @if($order_type == 'cancelled')
            @forelse($orders as $key => $order)
                <tr>
                    <td class="v-align-middle"> {{ $order->cashier_code }} </td>
                    <td class="v-align-middle"> {{ $order->cashier_customer_name }} </td>
                    <td class="v-align-middle"> {{ date('F d, Y', strtotime($order->cashier_date)) }} </td>
                    <td class="v-align-middle"> {{ date('F d, Y', strtotime($order->cashier_cancelled_date)) }} </td>
                    <td class="v-align-middle text-right text-blue text-bold"> &#8369;{{ number_format($order->cashier_total_amt, 2) }} </td>
                    <td class="v-align-middle text-center"> 
                        <button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6"> No Cancelled Orders </td>
                </tr>
            @endforelse
        @endif
        
    </tbody>
</table>