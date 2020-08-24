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
                    <form method="post" action="{{ route('inventory.route',['path' => $path, 'action' => 'update-item-group', 'id' => encrypt(1) ]) }}"> @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">&nbsp;</h3>
                                        <div class="box-tools clearfix">
                                            <button type="button" data-toggle="modal" data-target="#modaladdproductgroup" class="btn btn-warning"><i class="fa fa-plus"></i> Group </button>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pro-mt-2">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-gray-light">
                                            <th class="text-center">Description</th>
                                            <th class="text-center" style="width: 200px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($group_data as $key => $value)
                                        <tr class="tr-order-level" data-group="{{ $value->group_id }}">
                                            <td id="td-level-padding{{ $value->group_id }}" style="padding-left: {{ 50 * ($value->group_level - 1) }}px;">
                                                <input type="hidden" class="form-control" id="order_level{{ $value->group_id }}" name="group[{{ $value->group_id }}][order]" value="{{ $value->order_level }}">

                                                <input type="text" class="form-control" name="group[{{ $value->group_id }}][description]" value="{{ $value->group_description }}">

                                                <input type="hidden" class="form-control" id="type_id{{ $value->group_id }}" name="group[{{ $value->group_id }}][type]" value="{{ $value->group_type }}">
                                                <input type="hidden" class="form-control" id="level_id{{ $value->group_id }}" name="group[{{ $value->group_id }}][level]" value="{{ $value->group_level }}">
                                                <input type="hidden" class="form-control" id="parent_id{{ $value->group_id }}" name="group[{{ $value->group_id }}][parent]" value="{{ $value->group_parent }}">
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#" data-uniqid="{{ $value->group_id }}" data-parent="{{ $value->group_parent }}" data-level="{{ $value->group_level }}" data-type="{{ $value->group_type }}" class="btn btn-default btn-flat btn-move-up"><i class="fa fa-angle-up"></i></a>
                                                    <a href="#" data-uniqid="{{ $value->group_id }}" data-parent="{{ $value->group_parent }}" data-level="{{ $value->group_level }}" data-type="{{ $value->group_type }}" class="btn btn-default btn-flat btn-move-down"><i class="fa fa-angle-down"></i></a>
                                                    <a href="#" data-uniqid="{{ $value->group_id }}" data-parent="{{ $value->group_parent }}" data-level="{{ $value->group_level }}" data-type="{{ $value->group_type }}" class="btn btn-default btn-flat btn-move-left"><i class="fa fa-angle-left"></i></a>
                                                    <a href="#" data-uniqid="{{ $value->group_id }}" data-parent="{{ $value->group_parent }}" data-level="{{ $value->group_level }}" data-type="{{ $value->group_type }}" class="btn btn-default btn-flat btn-move-right"><i class="fa fa-angle-right"></i></a>
                                                </div>
                                                <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('manage.inventory.maintenance.modal.modaladdproductgroup')

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

    function findParent(uniqid)
    {
        /* Search Parent */
        var parentIDID = [];
        
        $('.tr-order-level').each(function(key, value){
            if($('#parent_id' + $(this).data('group')).val() == 0) {
                var dataGroup = $(this).data('group');
                parentIDID.push(dataGroup);
            } else if($(this).data('group') == uniqid) {
                return false;
            }
        });

        return parentIDID[parentIDID.length - 1];
    }

    function findChild(parentIDID)
    {
        var childID = [];

        $('.tr-order-level').each(function(key, value){
            if($('#parent_id' + $(this).data('group')).val() == parentIDID) {

                addPaddingLeft($(this).data('group'))

                $('#level_id' + $(this).data('group')).val(function(){
                    return Number($(this).val()) + 1;
                });

                childID.push(1);
            } 
        });

        return childID.length;
    }

    function addPaddingLeft(uniqID)
    {
        var padding = $('#td-level-padding' + uniqID).css('padding-left').replace(/\D/g,'');

        var addPadding = (Number(padding) + 50);
        
        $('#td-level-padding' + uniqID).css('padding-left', addPadding + 'px');
    }

    function removePaddingLeft(uniqID)
    {
        var padding = $('#td-level-padding' + uniqID).css('padding-left').replace(/\D/g,'');

        var removePadding = (Number(padding) - 50);
        
        $('#td-level-padding' + uniqID).css('padding-left', removePadding + 'px');
    }

    function updateInput(event) {
        $('#' + event).val("");
    }

</script>

@endpush

@endsection