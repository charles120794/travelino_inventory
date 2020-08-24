<td style="vertical-align:top;" class="pro-pr-2 group-list" data-key="0">
    <div class="box box-solid" style="width: 300px;">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-list"></i> Group ({{ $group_data->group_description }}) - {{ $group_data->group_parent }}</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-flat btn-primary btn-sm modal-add-group" onclick="modal_add_group(this)" data-group="{{ $group_data_id }}"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body no-padding" style="max-height: 300px; overflow: auto">
            <div class="nav-tabs-custom">
                <ul class="nav nav-stacked">
                    @foreach($group_data->groupDetails as $group)
                    <li><a href="#tab_1" class="group-data" @if($group->group_type == '1') onclick="search_product_ajax(this)" @else onclick="selected_group(this)" @endif data-type="{{ $group->group_type }}" data-parent="{{ $group->group_parent }}" data-level="{{ $group->group_level }}" data-group="{{ $group->group_id }}" data-toggle="tab">{{ $group->group_description }} @if($group->group_type == '1')<i class="fa fa-angle-right pull-right"></i>@endif </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</td>
