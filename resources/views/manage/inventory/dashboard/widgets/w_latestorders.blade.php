<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title pull-left text-blue"><b style="font-size: 2rem;"><i class="fa fa-angle-double-right fa-fw"></i> Latest Orders  </b></h4>
        <h4 class="box-title pull-right text-blue">
            <b style="font-size: 1.5rem;"><span id="s_order_dt_rng">({{ date('F d, Y') }})</span></b>
            <a href="#modalchangeorderdaterange" id="btnmodalchangeorderdaterange" data-toggle="tooltip" data-title="Change Date Range"><i class="fa fa-calendar fa-fw"></i></a>
        </h4>
    </div>
</div>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#pending_order" id="r_pending_order" data-toggle="tab"><b>Pending</b></a></li>
        <li><a href="#delivered_order" id="r_delivered_order" data-toggle="tab"><b>Paid & Delivered</b></a></li>
        <li><a href="#cancelled_order" id="r_cancelled_order" data-toggle="tab"><b>Cancelled</b></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="pending_order">
            <div class="retrieve-pending-orders">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr class="bg-gray-light no-wrap">
                            <th class="text-center" style="width: 15%;">Code</th>
                            <th class="text-center" style="width: 30%;">Customer Name</th>
                            <th class="text-center" style="width: 15%;">Date</th>
                            <th class="text-center" style="width: 10%;">Cost</th>
                            <th class="text-center" style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="5"> No Pending Orders </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Place New Order </button>
            </div>
        </div>
      
        <div class="tab-pane" id="delivered_order">
            <div class="retrieve-delivered-orders">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr class="bg-gray-light no-wrap">
                            <th class="text-center" style="width: 15%;">Code</th>
                            <th class="text-center" style="width: 30%;">Customer Name</th>
                            <th class="text-center" style="width: 15%;">Order Date</th>
                            <th class="text-center" style="width: 15%;">Paid/Delivery Date</th>
                            <th class="text-center" style="width: 10%;">Cost</th>
                            <th class="text-center" style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="6"> No Delivered Orders </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane" id="cancelled_order">
            <div class="retrieve-cancelled-orders">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr class="bg-gray-light no-wrap">
                            <th class="text-center" style="width: 15%;">Code</th>
                            <th class="text-center" style="width: 30%;">Customer Name</th>
                            <th class="text-center" style="width: 15%;">Order Date</th>
                            <th class="text-center" style="width: 10%;">Date Cancelled</th>
                            <th class="text-center" style="width: 10%;">Cost</th>
                            <th class="text-center" style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="6"> No Cancelled Orders </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>