@extends('layouts.layout')

@section('title', $windowName)

@section('content')

@include('manage.system.accounts.includes.WindowBreadCrumbs')

<section class="content">

    @include('layouts.alerts.errors.alerts')

    <div class="box box-primary">
        <div class="box-body" style="min-height: 75vh;">
            <div class="panel panel-default">
                <div class="panel-heading clearfix bg-white">
                    <h3 class="panel-title pull-left">
                        <span class="fa fa-angle-double-right fa-fw"></span><b>{{ strtoupper($windowName) }}</b>  
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Issuance No. </label>
                                                <input type="text" class="form-control" name="issue_code" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Department </label>
                                                <input type="text" class="form-control" name="issue_code">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Issue By </label>
                                                <input type="text" class="form-control" name="issue_code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1"> Date </label>
                                                <input type="date" class="form-control" name="issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Warehouse </label>
                                                <input type="text" class="form-control" name="issue_code">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Issue To </label>
                                                <input type="text" class="form-control" name="issue_code">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Particulars</label>
                                                <textarea class="form-control" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box box-primary">
                                 <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Status </label>
                                        <input type="text" class="form-control" name="issue_code">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Reference No. </label>
                                        <input type="text" class="form-control" name="issue_code">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Net Cost </label>
                                        <input type="text" class="form-control" name="issue_code">
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Select Product</h3>
                                    <div class="pull-right">
                                        <button class="btn btn-warning"><i class="fa fa-plus"></i> Product Item </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Product Item </label>
                                                <div class="pro-input-dropdown">
                                                    <div class="pro-dropdown">
                                                        <div class="input-group">
                                                            <div class="input-group-btn">
                                                                <button type="button" onclick="proDropDownFunction('proDropdown')" class="btn btn-primary btn-flat pro-dropbtn">&#43;</button>
                                                            </div>
                                                            <input type="hidden" name="personal_address_id" id="personal_address_id" value="">
                                                            <input type="text" class="form-control" name="personal_address" id="personal_address" oninput="updateInput('personal_address_id')" autocomplete="personal-address" value="" required>
                                                        </div>
                                                    </div>
                                                    <div id="proDropdown" class="pro-dropdown-content">
                                                        <ul class="pro-dropdown-content-list">
                                                            <li><a href="#personal_address_id" data-target="personal_address" data-id="" data-address="" class="select-address">No result's found.</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label for="exampleInputEmail1"> Unit </label>
                                                <input type="text" class="form-control" name="issue_code">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label for="exampleInputEmail1"> Variant </label>
                                                <input type="text" class="form-control" name="issue_code">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                             <div class="form-group">
                                                <label for="exampleInputEmail1"> Quantity </label>
                                                <input type="text" class="form-control" name="issue_code">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label for="exampleInputEmail1"> Unit Cost </label>
                                                <input type="text" class="form-control text-right" name="issue_code">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                <label class="text-center" for="exampleInputEmail1"> Total Cost </label>
                                                <input type="text" class="form-control text-right" name="issue_code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </div>   
                    </div>
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