<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title pull-left text-blue"><b style="font-size: 2rem;"><i class="fa fa-angle-double-right fa-fw"></i> Customers  </b></h4>
        <h4 class="box-title pull-right text-blue">
            <b style="font-size: 1.5rem;"><span id="s_order_dt_rng">({{ date('F d, Y') }})</span></b>
            <a href="#modalchangeorderdaterange" id="btnmodalchangeorderdaterange" data-toggle="tooltip" data-title="Change Date Range"><i class="fa fa-calendar fa-fw"></i></a>
        </h4>
    </div>
</div>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#top_customers" id="r_top_customers" data-toggle="tab"><b> Top Customers </b></a></li>
        <li><a href="#recent_customers" id="r_recent_customers" data-toggle="tab"><b> Recent Customers </b></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="top_customers">
            <div class="retrieve-top-customers products-widget-ff">
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
                        <tr>
                            <td class="text-center" colspan="6"> No Top Customers </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="recent_customers">
            <div class="retrieve-recent-customers">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr class="bg-gray-light no-wrap">
                            <th class="text-center" style="width: 10%;">Code</th>
                            <th class="text-center" style="width: 30%;">Customer Name</th>
                            <th class="text-center" style="width: 10%;">Date Purchase</th>
                            <th class="text-center" style="width: 10%;">Purchase Type</th>
                            <th class="text-center" style="width: 10%;">Total Quantity</th>
                            <th class="text-center" style="width: 10%;">Total Cost</th>
                            <th class="text-center" style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="7"> No Recent Customers </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- <div class="box box-primary trigger-widget-ff">
    <div class="box-header">
        <h4 class="box-title pull-left text-blue"><b style="font-size: 2rem;"><i class="fa fa-angle-double-right fa-fw"></i> Latest Customers </b></h4>
    </div>
    <div class="box-body">
        <div class="">
            
        </div>
    </div>
</div> --}}
