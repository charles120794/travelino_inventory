<form method="post" action="{{ route('actions.route',['path' => $path, 'action' => 'create-users-account', 'id' => encrypt('') ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}
	<div class="row">
		<div class="col-md-12" style="overflow-x: auto;">
			<table class="table table-bordered">
				<tr>
					<th class="text-center">
						PROFILE PHOTO
					</th>
					<th class="text-center" colspan="2" style="width: 43%; min-width: 400px;">
						USER INFORMATION
					</th>
					<th class="text-center" colspan="2" style="width: 43%; min-width: 400px;">
						SECURITY
					</th>
				</tr>
				<tr>
					<td rowspan="8" style="width: 200px;">
						<div class="profile-photo" id="profile_photo_div" onclick="$('#profile_photo').click();" style="height: 250px; width: 230px; background-color: #999; cursor: pointer;">
							<img src="{{ Storage::url('/default/default_image_01.png') }}" id="load_image" style="height: 100%;width: 100%;">
						</div>
						<input type="file" name="profile_photo" id="profile_photo" style="position: absolute; opacity: 0;">
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						COMPANY: 
					</td>
					<td style="padding: 0px;">
						<select class="form-control input-sm" name="company" data-toggle="tooltip" title="Please select Company" tabindex="1" required>
							<option value="">--SELECT COMPANY--</option>
							@foreach($usersCompany as $key => $value)
		                    <option value="{{ $value->company_id }}" @if(old('company') == $value->company_id) selected @endif> {{ strtoupper($value->company_code) }} - {{ strtoupper($value->company_name) }} {{ ($value->company_id == $thisUser->company_id) ? ' (DEFAULT COMPANY)' : ''}}</option>
		                    @endforeach
						</select>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						USERNAME: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="username" value="{{ old('username') }}" autocomplete="off" tabindex="0" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						FIRSTNAME:
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="firstname" value="{{ old('firstname') }}" autocomplete="off" tabindex="2" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						PASSWORD: 
					</td>
					<td style="padding: 0px;">
						<input type="password" class="form-control input-sm" name="password" autocomplete="off" tabindex="10" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						MIDDLENAME:
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="middlename" value="{{ old('middlename') }}" autocomplete="off" tabindex="3" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						CONFIRM PASSWORD: 
					</td>
					<td style="padding: 0px;">
						<input type="password" class="form-control input-sm" name="cpassword" autocomplete="off" tabindex="11" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						LASTNAME:
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="lastname" value="{{ old('lastname') }}" autocomplete="off" tabindex="4" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						EMAIL ADDRESS:
					</td>
					<td style="padding: 0px;">
						<input type="email" class="form-control input-sm" name="email" value="{{ old('email') }}" autocomplete="off" tabindex="12" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						 BIRTHDATE: 
					</td>
					<td style="padding: 0px;">
						<input type="date" class="form-control input-sm" name="birth_date" value="{{ old('birth_date') }}" tabindex="5" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						CONTACT NUMBER:
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="contact_no" value="{{ old('contact_no') }}" autocomplete="off" tabindex="13" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						EDUCATION: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="education" value="{{ old('education') }}" autocomplete="off" tabindex="6" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
					</td>
					<td style="padding: 0px;">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						POSITION:
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="position_title" value="{{ old('position_title') }}" autocomplete="off" tabindex="7" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
					</td>
					<td style="padding: 0px;">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						ADDRESS:
					</td>
					<td style="padding: 0px;">
						<textarea class="form-control input-sm" name="address" autocomplete="off" tabindex="8" required>{{ old('address') }}</textarea>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
					</td>
					<td style="padding: 0px;">
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<button class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i> SUBMIT </button>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>


@push('scripts')

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#profile_photo').on('change',function(){
			displayImage(this);
		});
	     function displayImage(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function (e) {
		            $('#load_image').attr('src', e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
	})

</script>

@endpush 