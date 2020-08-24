<div class="row">

	<div class="col-md-10 col-md-offset-1" style="overflow-x: auto;">

		<form method="post" action="{{ route('settings.route',['path' => $path, 'action' => $createCompany , 'id' => encrypt('') ]) }}" enctype="multipart/form-data"> {{ csrf_field() }}

			<h2 style="font-size: 18px; font-weight: bold;"><i class="fa fa-book"></i> Company Information</h2>
			<hr>

			<table class="table table-bordered">
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Code: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_code" maxlength="15" value="{{ old('company_code') }}" autocomplete="off" style="text-transform: uppercase;" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Company Name: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_name" value="{{ old('company_name') }}" maxlength="50" style="text-transform: uppercase;" autocomplete="off" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Company Tagline:
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_tagline" maxlength="50" value="{{ old('company_tagline') }}" style="text-transform: uppercase;" autocomplete="off" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Company Location: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_location" value="{{ old('company_location') }}" maxlength="15" style="text-transform: uppercase;" autocomplete="off" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Company Email: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_email" value="{{ old('company_email') }}" autocomplete="off" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Company Website: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_website" value="{{ old('company_website') }}" autocomplete="off">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Company Contact Phone: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_contact_phone" value="{{ old('company_contact_phone') }}" maxlength="20" style="text-transform: uppercase;" autocomplete="off" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Company Contact Mobile: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_contact_number" value="{{ old('company_contact_number') }}" maxlength="20" style="text-transform: uppercase;" autocomplete="off" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Registered Owner: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_registered_owner" value="{{ old('company_registered_owner') }}" maxlength="20" style="text-transform: uppercase;" autocomplete="off" required>
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Company Foundation: 
					</td>
					<td style="padding: 0px;">
						<input type="date" class="form-control input-sm" name="company_foundation" value="{{ old('company_foundation') }}" required>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Description:
					</td>
					<td style="padding: 0px;" colspan="3">
						<textarea type="text" class="form-control input-sm" name="company_description" style="text-transform: uppercase;" autocomplete="off">{{ old('company_description') }}</textarea>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						Complete Address:
					</td>
					<td style="padding: 0px;" colspan="3">
						<textarea type="text" class="form-control input-sm" name="company_address" maxlength="50" value="{{ old('company_address') }}" style="text-transform: uppercase;" autocomplete="off"></textarea>
					</td>
				</tr>
			</table>

			<hr>
			<h2 style="font-size: 18px; font-weight: bold;"><i class="fa fa-cog"></i> Company Setting </h2>
			<hr>

			<table class="table table-bordered">
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 24%;">
						License Number: 
					</td>
					<td style="padding: 0px;">
						<input type="password" class="form-control input-sm" name="company_license_no" value="{{ old('company_license_no') }}" maxlength="20" style="text-transform: uppercase;" autocomplete="off">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px; width: 24%;">
					 	Maximum no. of User: 
					</td>
					<td style="padding: 0px;">
						<input type="number" class="form-control input-sm" name="company_max_users" value="{{ old('company_max_users') }}" maxlength="20" autocomplete="off" required>
					</td>
				</tr>
			</table>

			<hr>
			<h2 style="font-size: 18px; font-weight: bold;"><i class="fa fa-users"></i> Company Social </h2>
			<hr>

			<table class="table table-bordered">
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						COMPANY FACEBOOK: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_facebook" value="{{ old('company_facebook') }}" maxlength="20" placeholder="-- https://www.example-link.com --" autocomplete="off">
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						COMPANY TWITTER: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_twitter" value="{{ old('company_twitter') }}" maxlength="20" placeholder="-- https://www.example-link.com --" autocomplete="off">
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						COMPANY PINTEREST: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_pinterest" value="{{ old('company_pinterest') }}" maxlength="20" placeholder="-- https://www.example-link.com --" autocomplete="off">
					</td>
					<td style="font-weight: bold; font-size: 12px; vertical-align: middle; padding: 6px;">
						COMPANY INSTAGRAM: 
					</td>
					<td style="padding: 0px;">
						<input type="text" class="form-control input-sm" name="company_instagram" value="{{ old('company_instagram') }}" maxlength="20" placeholder="-- https://www.example-link.com --" autocomplete="off">
					</td>
				</tr>
			</table>

			<hr>
			<h2 style="font-size: 18px; font-weight: bold;"><i class="fa fa-dropbox"></i> Company Module</h2>
			<hr>

			<table class="table table-bordered">
				<tr>
					<td style="font-weight: bold; font-size: 14px; padding: 6px;">
						Select Module: 
					</td>
					<td style="vertical-align: middle;">
						@foreach($allNotDefaultModule as $module)
							<div class="form-group">
								<label style="font-weight: normal;">
									<input type="checkbox" name="modules[{{ $module->module_id }}][company_module]" style="height: 16px; width: 16px;">&nbsp;&nbsp;&nbsp; {{ $module->module_description }} 
								</label>
							</div>
						@endforeach
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold; font-size: 14px; padding: 6px;">
						Default Module:
					</td>
					<td style="vertical-align: middle;">
						@foreach($allDefaultModule as $module)
							<div class="form-group">
								<label style="font-weight: normal;">
									<input type="checkbox" name="modules[{{ $module->module_id }}][company_module]" style="height: 16px; width: 16px;" checked onclick="return false;"> &nbsp;&nbsp;&nbsp; {{ $module->module_description }} 
								</label>
							</div>
						@endforeach
					</td>
				</tr>

				<tr>
					<td colspan="5">
						<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-save"></i> SUBMIT </button>
					</td>
				</tr>

			</table>

		</form>

	</div>
	
</div>