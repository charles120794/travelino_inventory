@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<section class="content">

    @include('layouts.alerts.errors.alerts')

    <div class="box box-primary">
        <div class="box-header">
            <h4 class="box-title pull-left text-blue"><b style="font-size: 2rem;"><i class="fa fa-angle-double-right fa-fw"></i> Recap Report </b></h4>
            <h4 class="box-title pull-right text-blue">
                <b style="font-size: 1.5rem;"><span>({{ $date_range ?? date('F m, Y') }})</span></b>
                <a href="#modalchangedaterange" id="btnmodalchangedaterange" data-toggle="tooltip" data-title="Change Date Range"><i class="fa fa-calendar fa-fw"></i></a>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <h1 style="line-height: 0;">&#8369;{{ number_format($total_expense, 2) }}</h1> 
                    <h1 style="line-height: 1;"><small> Expense </small></h1> 
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-print"></i> Print Preview </button>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <h1 style="line-height: 0;">&#8369;{{ number_format($total_revenue, 2) }}</h1> 
                    <h1 style="line-height: 1;"><small> Revenue </small></h1> 
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-print"></i> Print Preview </button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <h1 style="line-height: 0;">&#8369;{{ number_format($total_profits, 2) }}</h1> 
                    <h1 style="line-height: 1;"><small> NET Amount </small></h1> 
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-print"></i> Print Preview </button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <h1 style="line-height: 0;">&#8369;{{ number_format($total_gross_a, 2) }}</h1> 
                    <h1 style="line-height: 1;"><small> Gross Amount </small></h1> 
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-print"></i> Print Preview </button>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h4 class="box-title pull-left text-blue"><b style="font-size: 2rem;"><i class="fa fa-angle-double-right fa-fw"></i> Inventory Report </b></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <h1 style="line-height: 0;">&#8369;{{ number_format($total_vat_amt, 2) }}</h1> 
                    <h1 style="line-height: 1;"><small> VAT Amount </small></h1> 
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-print"></i> Print Preview </button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <h1 style="line-height: 0;">{{ number_format($total_qty_sol) }}</h1> 
                    <h1 style="line-height: 1;"><small> Quantity Sold </small></h1> 
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-print"></i> Print Preview </button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <h1 style="line-height: 0;">&#8369;{{ number_format($total_qty_cos, 2) }}</h1> 
                    <h1 style="line-height: 1;"><small> Quantity Cost </small></h1> 
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-print"></i> Print Preview </button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-body text-center">
                    <h1 style="line-height: 0;">&#8369;{{ number_format($total_qty_pri, 2) }}</h1> 
                    <h1 style="line-height: 1;"><small> Quantity Price </small></h1> 
                </div>
                <div class="box-footer text-right">
                    <button type="button" class="btn btn-default btn-sm btn-flat"><i class="fa fa-print"></i> Print Preview </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">

            <div class="box box-primary">
                <div class="box-header">
                    <h4 class="box-title pull-left text-blue"><b style="font-size: 2rem;"><i class="fa fa-angle-double-right fa-fw"></i> Quick Views  </b></h4>
                </div>
            </div>

            <div class="nav-tabs-custom">
                <ul class="nav nav-stacked">
                    <li class="active"><a href="#quick_views_1" class="btn-quick-views" data-toggle="tab"><i class="fa fa-shopping-cart"></i> Orders </a></li>
                    <li><a href="#quick_views_2" class="btn-quick-views" data-toggle="tab"><i class="fa fa-arrow-up"></i> Top Selling Products  </a></li>
                    <li><a href="#quick_views_3" class="btn-quick-views" data-toggle="tab"><i class="fa fa-undo"></i> Products Below Min. Level </a></li>
                    <li><a href="#quick_views_4" class="btn-quick-views" data-toggle="tab"><i class="fa fa-calendar"></i> Products with Expiration Date </a></li>
                    <li><a href="#quick_views_5" class="btn-quick-views" data-toggle="tab"><i class="fa fa-ban"></i> Out of Stock Products </a></li>
                    <li><a href="#quick_views_6" class="btn-quick-views" data-toggle="tab"><i class="fa fa-cart-plus"></i> Recently Added Products </a></li>
                    <li><a href="#quick_views_7" class="btn-quick-views" data-toggle="tab"><i class="fa fa-calendar-times-o"></i> Non-moving Products </a></li>
                    <li><a href="#quick_views_8" class="btn-quick-views" data-toggle="tab"><i class="fa fa-users"></i> Top Customers </a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active fade in" id="quick_views_1">
                    @include('manage.inventory.dashboard.widgets.w_latestorders')
                </div>
                <div class="tab-pane fade" id="quick_views_2">
                    @include('manage.inventory.dashboard.widgets.w_topsellingproducts')
                </div>
                <div class="tab-pane fade" id="quick_views_3">
                    @include('manage.inventory.dashboard.widgets.w_productsbelowminimumlevel')
                </div>
                <div class="tab-pane fade" id="quick_views_4">
                    @include('manage.inventory.dashboard.widgets.w_productswithexpirationdate')
                </div>
                <div class="tab-pane fade" id="quick_views_5">
                    @include('manage.inventory.dashboard.widgets.w_outofstockproducts')
                </div>
                <div class="tab-pane fade" id="quick_views_6">
                    @include('manage.inventory.dashboard.widgets.w_recentlyaddedproducts')
                </div>
                <div class="tab-pane fade" id="quick_views_7">
                    @include('manage.inventory.dashboard.widgets.w_nonmovingproducts')
                </div>
                <div class="tab-pane fade" id="quick_views_8">
                    @include('manage.inventory.dashboard.widgets.w_topcustomers')
                </div>
            </div>
        </div>
    </div>
</section>

@include('manage.inventory.dashboard.modal.modalchangedaterange')

@include('manage.inventory.dashboard.modal.modalchangeorderdaterange')

@include('manage.inventory.dashboard.modal.modalnonmovingproductdate')

@include('manage.inventory.dashboard.modal.modalshowcustomercashierdetails')

@include('manage.inventory.dashboard.modal.modalshowproductdetails')

@include('manage.inventory.dashboard.modal.modalshowcustomerdetails')


@push('scripts')
<script type="text/javascript">

    $(window).scroll(function(){

        var h_aa = $('.trigger-widget-aa').offset().top;
        var h_bb = $('.trigger-widget-bb').offset().top;
        var h_cc = $('.trigger-widget-cc').offset().top;
        var h_dd = $('.trigger-widget-dd').offset().top;
        var h_ee = $('.trigger-widget-ee').offset().top;
        var wS = $(this).scrollTop();
        var wH = $(window).height();

        /* Products below minimum level */
        // if((h_aa - wS) <= wH) {
        //     if($('.products-widget-aa-visible').length == 0) {
        //         $('.products-widget-aa').addClass('products-widget-aa-visible');
        //         retrieve_products_below_minimum_level('.products-widget-aa');
        //     }
        // }
       
    });

    $(document).ready(function(){

        $('.btn-quick-views').on('click', function(event){
            if(event.target.getAttribute('href') === '#quick_views_1') {
                return retrieve_customer_orders('pending', 'retrieve-pending-orders');
            } else if (event.target.getAttribute('href') === '#quick_views_2') {
                return retrieve_top_selling_products();
            } else if (event.target.getAttribute('href') === '#quick_views_3') {
                return retrieve_products_below_minimum_level('.products-widget-aa');
            } else if (event.target.getAttribute('href') === '#quick_views_4') {
                return retrieve_products_with_expiration_date('.products-widget-bb');
            } else if (event.target.getAttribute('href') === '#quick_views_5') {
                return retrieve_out_of_stock_products('.products-widget-cc');
            } else if (event.target.getAttribute('href') === '#quick_views_6') {
                return retrieve_recently_added_products('.products-widget-dd'); alert()
            } else if (event.target.getAttribute('href') === '#quick_views_7') {
                return retrieve_non_moving_products('.products-widget-ee');
            } else if (event.target.getAttribute('href') === '#quick_views_8') { 
                return retrieve_top_customers('.products-widget-ff');
            }
        });

        retrieve_customer_orders('pending', 'retrieve-pending-orders');

        retrieve_top_selling_products();

        retrieve_products_below_minimum_level();

        $('#r_pending_order').on('click', function(){
            retrieve_customer_orders('pending', 'retrieve-pending-orders');
        });

        $('#r_delivered_order').on('click', function(){
            retrieve_customer_orders('paid', 'retrieve-delivered-orders');
        });

        $('#r_cancelled_order').on('click', function(){
            retrieve_customer_orders('cancelled', 'retrieve-cancelled-orders');
        });

        $('[data-toggle="tooltip"]').tooltip();

    });

    $(document).on('click', '#r_top_customers', function(){
        return retrieve_top_customers('.products-widget-ff');
    });

    $(document).on('click', '#r_recent_customers', function(){
        return retrieve_recent_customers('.products-widget-gg');
    });

    $(document).on('click', '.btn-modal-product-details', function(){
        $('#modalshowproductdetails').modal('show');
        $.ajax({
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'show-product-details', 'id' => encrypt(1)])}}',
            type : 'post',
            data : { id: $(this).data('id') },
            dataType : 'html',
            success : function(data){
                $('#productdetails').html(data);
            }
        });
    });

    $(document).on('click', '.btn-modal-customer-details', function(){
        $('#modalshowcustomerdetails').modal('show');
        $.ajax({
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-customer-details', 'id' => encrypt(1)])}}',
            type : 'post',
            data : { id: $(this).data('id') },
            dataType : 'html',
            success : function(data){
                $('#customerdetails').html(data);
                $('#customerdetails').fadeIn(500);
            },
            error: function (error) {
                var button = $('<button></button>').attr('class','btn btn-primary btn-modal-customer-details').html('<i class="fa fa-refresh"></i> Reload Data');
                var reloader = $('<div></div>').attr('class','text-center').append(button);
                $('#customerdetails').html(reloader);
            }
        });
    });

    $(document).on('click', '.btn-modal-customer-cashier-details', function(){
        $('#modalshowcustomercashierdetails').modal('show');
        $.ajax({
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-customer-cashier-details', 'id' => encrypt(1)])}}',
            type : 'post',
            data : { id: $(this).data('id') },
            dataType : 'html',
            success : function(data){
                $('#customercashierdetails').html(data);
                $('#customercashierdetails').fadeIn(500);
            },
            error: function (error) {
                var reloader = $('<div></div>').attr('class','alert alert-warning alert-dismissible').append(
                    $('<button></button>').attr('class','close').attr('type','button').attr('data-dismiss','alert').attr('aria-hidden','true').text('x'),
                    $('<h4></h4>').attr('class','text-center').append($('<i></i>').attr('class','fa fa-warning').text(' Page not found!'))
                );
                $('#customercashierdetails').html(reloader);
            }
        });
    });

    function retrieve_customer_orders(type, html)
    {
        var date_fr = $('input[name="o_df"]').val();
        var date_to = $('input[name="o_dt"]').val();
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-customer-orders', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            data : { 
                order_type : type ,
                o_df : date_fr ,
                o_dt : date_to ,
            },
            success : function (data) {
                $('.' + html).html(data);
            }
        });
    }

    function retrieve_top_selling_products()
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-top-selling-products', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            success : function (data) {
                $('.top-selling-products').html(data);
                $('.table-top-selling-product').DataTable();
            }
        });
    }

    function retrieve_products_below_minimum_level(retrieve)
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-products-below-minimum-level', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            success : function (data) {
                $(retrieve).html(data);
            }
        });
    }

    function retrieve_products_with_expiration_date(retrieve)
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-products-with-expiry-date', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            success : function (data) {
                $(retrieve).html(data);
            }
        });
    }

    function retrieve_out_of_stock_products(retrieve)
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-out-of-stock-products', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            success : function (data) {
                $(retrieve).html(data);
            }
        });
    }

    function retrieve_recently_added_products(retrieve)
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-recently-added-products', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            success : function (data) {
                $(retrieve).html(data);
            }
        });
    }

    function retrieve_non_moving_products(retrieve)
    {
        var date = $('input[name="non_m_product"]').val();
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-non-moving-products', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            data : { as_of_date : date },
            success : function (data) {
                $(retrieve).html(data);
            }
        });
    }

    function retrieve_top_customers(retrieve)
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-top-customers', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            success : function (data) {
                $(retrieve).html(data);
            }
        });
    }

    function retrieve_recent_customers(retrieve)
    {
        $.ajax({
            type : 'get',
            url : '{{ route('inventory.route',['path' => $path, 'action' => 'retrieve-recent-customers', 'id' => encrypt(1)]) }}',
            dataType : 'html',
            success : function (data) {
                $(retrieve).html(data);
                print_cashier_receipt(data);
            }
        });
    }

    function datezero(num){
        return (num < 10 ? '0' : '') + num;
    }

    function print_cashier_receipt(data)
    {
        var myWindow=window.open('','Print','width=500,height=500');
            myWindow.document.write(data);
            myWindow.document.close();
            myWindow.focus();
            myWindow.print();
            myWindow.close();
    }
  
</script>

@endpush

@endsection