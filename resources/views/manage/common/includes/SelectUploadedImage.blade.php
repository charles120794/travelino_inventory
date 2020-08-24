<div class="row">

	<div class="col-md-8">

		<div class="box box-solid">

			<div class="box-body" style="max-height: 500px; overflow-x: scroll;">

				<div class="row">

					@foreach($images as $image)

					<div class="col-sm-3" style="padding: 5px 5px 5px 5px;">
						<img src="{{ Storage::url($image->media_path) }}" alt="{{ $image->media_alt_name }}" data-media_id="{{ encrypt($image->media_id) }}" data-title="{{ $image->media_name }}" data-tags="{{ $image->media_tags }}" data-alternative="{{ $image->media_alt_name }}" data-description="{{ $image->media_description }}" data-orig_path="{{ $image->media_path }}" class="img-responsive sel-image-class" onclick="return selectedImage(this)" ondblclick="submitModalImageUpload()">
					</div>

					@endforeach 

				</div>

			</div>

		</div>

	</div>

	<div class="col-md-4">

		<div class="box box-solid">

			<form method="post" action="{{ route('common.route',['path' => $path, 'action' => 'update-image-content', 'id' => encrypt('') ]) }}"  id="form-media-details"> @csrf
			
				<div class="box-body">

					<div class="form-group">
						<label><small>Title:</small></label>
						<input type="text" class="form-control inut-sm" id="media_name" name="media_name">
						<input type="hidden" class="form-control inut-sm" id="media_id" name="media_id">
						<input type="hidden" class="form-control inut-sm" id="submit" name="submit">
					</div>

					<div class="form-group">
						<label><small>Description:</small></label>
						<input type="text" class="form-control inut-sm" id="media_description" name="media_description">
					</div>

					<div class="form-group">
						<label><small>Alternative Text:</small></label>
						<input type="text" class="form-control inut-sm" id="media_alt_name" name="media_alt_name">
					</div>

					<div class="form-group">
						<label><small>Tags:</small></label>
						<input type="text" class="form-control inut-sm" id="media_tags" name="media_tags">
					</div>

					<div class="form-group">
						<label><small>Image Path:</small></label>
						<input type="text" class="form-control inut-sm" id="media_image_path" name="media_image_path" readonly>
					</div>

					<div class="form-group text-right">
						<button type="submit" onclick="this.form.submit.value=this.value" value="update" id="btn-update" class="btn btn-default btn-xs"><i class="fa fa-check"></i> Update </button>
						<button type="submit" onclick="this.form.submit.value=this.value" value="delete" id="btn-delete" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete </button>
					</div>

				</div>

			</form>

		</div>

	</div>

</div>
