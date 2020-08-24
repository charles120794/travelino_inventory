<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <ol class="breadcrumb bg-white" id="product_group_breadcrumb">&nbsp;</ol>
            <input type="hidden" id="selected_group">
            <input type="hidden" id="search_product_route" value="{{ route('inventory.route',['path' => $path, 'action' => 'search-product-group', 'id' => encrypt(1)]) }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12" style="overflow: auto;">
        <table>
            <tr>
                <td style="vertical-align:top;" class="pro-pr-2 group-list" data-key="0">
                    <div class="box box-solid" style="width: 300px;">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-list"></i> Group </h3>
                            @if($addgroup)
                            <div class="box-tools">
                                <button type="button" class="btn btn-flat btn-primary btn-sm modal-add-group" data-group="0"><i class="fa fa-plus"></i></button>
                            </div>
                            @endif
                        </div>
                        <div class="box-body no-padding" style="max-height: 300px; overflow: auto">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-stacked">
                                    @foreach($group_data_level_1 as $group)
                                    <li><a href="#tab_1" class="@if($group->group_type == '1') group-data @else selected-group @endif" data-type="{{ $group->group_type }}" data-parent="{{ $group->group_parent }}" data-level="{{ $group->group_level }}" data-group="{{ $group->group_id }}" data-toggle="tab">{{ $group->group_description }} @if($group->group_type == '1')<i class="fa fa-angle-right pull-right"></i>@endif</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>