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
                                <label> Date From </label>
                                <input type="date" class="form-control" name="date_from">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Date To </label>
                                <input type="date" class="form-control" name="date_to">
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
                                <th class="v-align-middle text-center">Image</th>
                                <th class="v-align-middle text-center">Description</th>
                                <th class="v-align-middle text-center">Stock</th>
                                <th class="v-align-middle text-right">Cost</th>
                                <th class="v-align-middle text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product_data as $key => $product)
                            <tr>
                                <td class="text-center"><img src="{{ Storage::url($product->item_image) }}" style="width: 100px;"></td>
                                <td style="vertical-align: middle;">{{ $product->item_description }}</td>
                                <td class="v-align-middle text-center">{{ $product->item_quantity }}</td>
                                <td class="v-align-middle text-right">{{ number_format($product->item_selling_price,2) }}</td>
                                <td class="v-align-middle text-center">
                                    <button class="btn btn-info btn-flat btn-modal-view" data-id="{{ $product->item_id }}"><i class="fa fa-eye"></i></button>
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

@include('manage.inventory.maintenance.modal.modalshowproductdetails')

@push('scripts')

<script type="text/javascript">
    
    $(function(){

        $('.btn-modal-view').on('click', function(){
            $('#modalshowproductdetails').modal('show');
            $.ajax({
                url : '{{ route('inventory.route',['path' => $path, 'action' => 'show-product-details', 'id' => encrypt(1)])}}',
                type : 'post',
                data : {id:$(this).data('id')},
                dataType : 'html',
                success : function(data){
                    $('#modalshowproductdetails #productdetails').html(data);
                }
            });
        });

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