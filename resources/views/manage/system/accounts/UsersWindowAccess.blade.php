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
                        <div class="col-md-12">
                            <form class="form-horizontal" method="GET" id="form-filter">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email"> Select Module: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="module">
                                            <option value="">--Select All--</option>
                                            @foreach($users_module as $module)
                                            <option value="{{ $module->module_id }}" @if(request()->get('module') == $module->module_id) selected @endif>{{ Str::title($module->module_description) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form method="post" action="{{ route('actions.route',['path' => $path, 'action' => 'update-users-window-access', 'id' => encrypt($thisUser->users_id) ]) }}"> @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-tools pull-right clearfix">
                                    <button type="button" class="btn btn-sm btn-warning" onclick="$('#form-filter').submit()"><i class="fa fa-search"></i> Search </button>
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Update </button>
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
                                        @forelse($users_window as $key => $value)

                                        <tr class="tr-order-level" data-group="{{ $value->menu_id }}">

                                            <td id="td-level-padding{{ $value->menu_id }}" style="padding-left: {{ 50 * ($value->menu_level - 1) }}px;">

                                                <div class="input-group" id="draggable_id{{ $key }}" draggable="true" ondragstart="drag(this)" ondrop="return alert()">
                                                    <span class="input-group-addon" style="cursor: move;"><i class="fa fa-arrows"></i></span>
                                                    <input type="text" class="form-control" name="group[{{ $value->access_id }}][description]" value="{{ $value->menu_name }}">
                                                </div>
                                                
                                                <input type="hidden" name="group[{{ $value->access_id }}][type]" id="type_id{{ $value->menu_id }}" value="{{ $value->menu_type }}">
                                                <input type="hidden" name="group[{{ $value->access_id }}][level]" id="level_id{{ $value->menu_id }}" value="{{ $value->menu_level }}">
                                                <input type="hidden" name="group[{{ $value->access_id }}][parent]" id="parent_id{{ $value->menu_id }}" value="{{ $value->menu_parent }}">
                                                <input type="hidden" name="group[{{ $value->access_id }}][order]" id="order_level{{ $value->menu_id }}" value="{{ $value->order_level }}">

                                            </td>

                                            <td class="text-center">

                                                <div class="btn-group">

                                                    {{-- <a href="#" data-uniqid="{{ $value->menu_id }}" data-parent="{{ $value->menu_parent }}" data-level="{{ $value->menu_level }}" data-type="{{ $value->menu_type }}" class="btn btn-default btn-flat btn-move-up"><i class="fa fa-angle-up"></i></a> --}}
                                                    {{-- <a href="#" data-uniqid="{{ $value->menu_id }}" data-parent="{{ $value->menu_parent }}" data-level="{{ $value->menu_level }}" data-type="{{ $value->menu_type }}" class="btn btn-default btn-flat btn-move-down"><i class="fa fa-angle-down"></i></a> --}}
                                                    <a href="#" data-uniqid="{{ $value->menu_id }}" data-parent="{{ $value->menu_parent }}" data-level="{{ $value->menu_level }}" data-type="{{ $value->menu_type }}" class="btn btn-default btn-flat btn-move-left"><i class="fa fa-angle-left"></i></a>
                                                    <a href="#" data-uniqid="{{ $value->menu_id }}" data-parent="{{ $value->menu_parent }}" data-level="{{ $value->menu_level }}" data-type="{{ $value->menu_type }}" class="btn btn-default btn-flat btn-move-right"><i class="fa fa-angle-right"></i></a>

                                                </div>

                                                <a href="{{ route('actions.route',['path' => active_path(), 'action' => 'delete-users-window-access', 'id' => encrypt($value->access_id) ]) }}" class="btn btn-danger" onclick="return confirm('Confirm to remove your access to this window')"><i class="fa fa-remove"></i></a>

                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center"> Please select module then click search button. </td>
                                        </tr>
                                        @endforelse
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

    function dropHere(event, target) {
        // event.preventDefault();
        // console.log(target.id, event.target.id)
        var htmlID =  localStorage.getItem('tableRow');

        console.log(event);
        // console.log($('#' + htmlID).closest('tr').html());

        $(event).html($('#' + htmlID)[0].outerHTML)

        $('#' + htmlID).closest('tr').remove();
    }

    function allowDropHere(event) {
        $(event).css('background-color', '#f7f7f7');
        $('tr[data-group="' + localStorage.getItem('tableData') + '"]').addClass('hide');
    }

    function drag(event) {

        $('.tr-order-level').each(function(){
            $(this).attr('ondragover','allowDrop(this)');
        });

        $(event).closest('tr').attr('ondragover', '');

        localStorage.setItem('tableRow', $(event).closest('tr')[0].outerHTML)
        localStorage.setItem('tableData', $(event).closest('tr').data('group'))
    }

    function allowDrop(event) {

        $('.added-tr').remove();;

        if(document.getElementsByClassName('added-tr').length == 0) {
            // $('tr[data-group="' + localStorage.getItem('tableData') + '"]');
            $('tr[data-group="' + localStorage.getItem('tableData') + '"]').insertAfter($(event));
            arangeOrder()
        }
    }

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

    function arangeOrder()
    {
        var orderLevel = 1;
        $('.tr-order-level').each(function(key, value){
            $('#order_level' + $(this).data('group')).val(orderLevel++);
        });
    }

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