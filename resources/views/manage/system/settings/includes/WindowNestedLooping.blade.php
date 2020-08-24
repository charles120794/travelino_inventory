@foreach($allWindow as $key => $value)

	<tr style="font-size: 12px;">

		<td class="text-center" style="padding-bottom: 0px;">
			<input type="hidden" name="window[{{ $key + $value->menu_id }}][menu_id]" value="{{ encrypt($value->menu_id) }}">
			<input type="checkbox" class="method-checkbox" name="window[{{ $key + $value->menu_id }}][checkbox]" style="height: 17px; width: 17px; background-color: transparent;">
		</td>

		<td class="no-padding">
			<input type="text" class="form-control input-sm" name="window[{{ $key + $value->menu_id }}][menu_level]" value="{{ $value->menu_level }}" style="width: 40px;text-align: center; padding-left: 2px; padding-right: 2px; background-color: transparent; margin-left: {{ $margin }}px;" readonly>
		</td>

		<td class="no-padding">
			<input type="text" class="form-control input-sm" name="window[{{ $key + $value->menu_id }}][menu_icon]" value="{{ $value->menu_icon }}" autocomplete="off">
		</td>

		<td class="no-padding">
			<input type="text" class="form-control input-sm" name="window[{{ $key + $value->menu_id }}][menu_name]" value="{{ $value->menu_name }}" autocomplete="off">
		</td>

		<td class="no-padding">
			<select class="form-control input-sm" name="window[{{ $key + $value->menu_id }}][menu_parent]">
				<option value="0"> Main Class </option>
				@foreach($allWindowParent as $dd)
					<option value="{{ $dd->menu_id }}" @if($dd->menu_id == $value->menu_parent) selected @endif>
						{{ $dd->menu_name }}
					</option>
				@endforeach
			</select>
		</td>

		<td class="no-padding">
			<input type="text" class="form-control input-sm" name="window[{{ $key + $value->menu_id }}][menu_path]" value="{{ ($value->menu_type == '0') ? $value->menu_path : '' }}" @if($value->menu_type == '1') readonly @endif>
		</td>

		<td class="text-center" style="padding-bottom: 0px;">
			<input type="checkbox" name="window[{{ $key + $value->menu_id }}][menu_type]" value="{{ $value->menu_type }}" @if($value->menu_type == '1') checked @endif style="height: 17px; width: 17px;">
		</td>

	</tr>

	@include('manage.system.settings.includes.WindowNestedLooping', ['allWindow' => $value->subClassWindow, 'margin' => (40 + $margin) ])

@endforeach