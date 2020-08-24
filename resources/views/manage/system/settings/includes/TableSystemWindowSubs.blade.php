<tr style="font-size: 12px;">
	<td class="text-center" style="padding-bottom: 0px;">
		<input type="hidden" name="window[{{ $key }}][menu_id]" value="{{ Crypt::encrypt($value->menu_id) }}">
		<input type="checkbox" name="window[{{ $key }}][checkbox]" style="height: 17px; width: 17px; background-color: transparent;">
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="window[{{ $key }}][menu_level]" value="{{ $value->menu_level }}" style="width: 40px;text-align: center; padding-left: 2px; padding-right: 2px; background-color: transparent;">
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="window[{{ $key }}][menu_icon]" value="{{ $value->menu_icon }}" style="background-color: transparent;">
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="window[{{ $key }}][menu_name]" value="{{ $value->menu_name }}" style="background-color: transparent;" autocomplete="off">
	</td>
	<td class="no-padding">
		<select class="form-control input-sm" name="window[{{ $key }}][menu_parent]" style="background-color: transparent;">
			<option value="0"> Main Class </option>
			@foreach( app('SystemWindow')->where('menu_id','!=',$value->menu_id)->where('menu_type','1')->get() as $parent )
			<option value="{{ $parent->menu_id }}" @if($parent->menu_id == $value->menu_parent) selected @endif>
				{{ $parent->menu_name }}
			</option>
			@endforeach
		</select>
	</td>
	<td class="no-padding">
		<input type="text" class="form-control input-sm" name="window[{{ $key }}][menu_path]" value="{{ $value->menu_path }}" style="background-color: transparent;" @if($value->menu_type == '1') readonly @endif>
	</td>
	<td class="text-center" style="padding-bottom: 0px;">
		<input type="checkbox" name="window[{{ $key }}][menu_type]" value="{{ $value->menu_type }}" @if($value->menu_type == '1') checked @endif style="height: 17px; width: 17px;">
	</td>
	<td style="padding: 0px;">
		<input type="text" name="window[{{ $key }}][order_level]" class="form-control input-sm" value="{{ $value->order_level }}" style="width: 60px;text-align: center; padding-left: 2px; padding-right: 2px; background-color: transparent;">
	</td>
</tr>