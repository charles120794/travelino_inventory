@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<section class="content">

    @include('layouts.alerts.errors.alerts')

    <div class="bg-white">
        <div class="panel panel-default">
            <div class="panel-heading clearfix bg-white">
                <h3 class="panel-title pull-left">
                    <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
                </h3>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i> Search Product</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Group By </label>
                                <select class="form-control">
                                    <option value="group1">All</option>
                                    <option value="group2">Supplier</option>
                                    <option value="group3">Department</option>
                                    <option value="group4">Warehouse</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Date From </label>
                                <input type="date" class="form-control" name="issue_code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Date To </label>
                                <input type="date" class="form-control" name="issue_date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer text-right">
            <a class="btn btn-warning btn-flat" href="{{ route('inventory.route',['path' => $path, 'action' => 'create-product-page', 'id' => encrypt(1)]) }}" ><i class="fa fa-plus"></i> Product </a>
            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Search </button>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body no-padding">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-gray-light" style="height: 50px;">
                                <th class="text-center" style="vertical-align: middle;">Image</th>
                                <th class="text-center" style="vertical-align: middle;">Description</th>
                                <th class="text-center" style="vertical-align: middle;">Quantity</th>
                                <th class="text-center" style="vertical-align: middle;">Gross Cost</th>
                                <th class="text-center" style="vertical-align: middle;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product_data as $key => $product)
                            <tr>
                                <td class="text-center"><img src="{{ Storage::url($product->item_image) }}" style="width: 100px;"></td>
                                <td style="vertical-align: middle;">{{ $product->item_description }}</td>
                                <td class="text-center" style="vertical-align: middle;">{{ $product->item_quantity }}</td>
                                <td class="text-center" style="vertical-align: middle;">{{ number_format($product->item_selling_price,2) }}</td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <button class="btn btn-info btn-flat"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

@include('manage.system.accounts.scripts.UsersDashboardScript')

@push('scripts')

<script type="text/javascript">
    
    $(function(){

        $('.select-address').on('click', function(event){
            event.preventDefault();
            let targetInput = $(this).attr('href');
            let targetAddress = $(this).data('target');
            let addressid = $(this).data('id');
            let addresscomplete = $(this).data('address');
            $(targetInput).val(addressid);
            $('#' + targetAddress).val(addresscomplete);
        });

        $('.append-address').on('click', function(){
    
            $html = $("<textarea>")
                    .attr("type", "text")
                    .attr("name", "billing_address[]")
                    .attr("class", "form-control input-sm")
                    .attr("autocomplete", "billing-address")
                    .css("resize", "vertical");

            $('#billing-address').append($html);

        });

    });

    function updateInput(event) {
        $('#' + event).val("");
    }

</script>

@endpush

@endsection