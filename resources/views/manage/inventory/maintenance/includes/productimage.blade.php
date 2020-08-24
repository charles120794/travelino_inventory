{{-- <tr>
	<td class="text-center"> --}}
		@for($img = 1; $img <= 8; $img++)
		<div class="col-sm-3">
			<div class="box box-solid">
				<div class="box-body text-center">
					<img src="{{ Storage::url('uploads/images/2020/08/U49onemtnT74RF0muPVMjpEK53OqWDNWfJYUt7g0.png') }}" class="img-thumbnail" id="media_product_image_{{ $img }}" style="width: 200px; height: 200px;">
					<input type="hidden" name="media[{{ $img }}][product_image]" id="media_product_image_path_{{ $img }}" readonly>
				</div>
				<div class="box-footer text-center">
					<button type="button" class="btn btn-info btn-flat btn-sm" data-key="{{ $img }}" onclick="openMediaModal(this)"><i class="fa fa-photo"></i> Select Image </button>
				</div>
			</div>
		</div>
		@endfor
{{-- 	</td>
	<td class="text-center" style="vertical-align: middle;">
		
	</td>
</tr> --}}