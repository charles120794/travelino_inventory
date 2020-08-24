<?php
use App\Helper\SystemControl;

$profile = SystemControl::system_control();
$contact = SystemControl::system_control();
$aboutus = SystemControl::system_control();
$values  = SystemControl::system_control_values_details();
?>
@extends('layouts.body')
@section('body')
<div class="row">
    <div class="col-md-3">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="box">
            <div class="box-header bg-gray-light">
                <h4>List Header</h4>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-stacked">
                    <li class="active"><a href="#storeprofile" data-toggle="tab"> <i class="fa fa-home fa-fw"></i> <b>Store</b> </a></li>
                    <li><a href="#storecontactinformation" data-toggle="tab"> <i class="fa fa-phone fa-fw"></i> <b>Contact</b> </a></li>
                    <li><a href="#storeabout" data-toggle="tab"> <i class="fa fa-info-circle fa-fw"></i> <b>About</b> </a></li>
                    <li><a href="#storevalues" data-toggle="tab"> <i class="fa fa-handshake-o fa-fw"></i> <b>Values</b> </a></li>
                    <li><a href="#storeadventure" data-toggle="tab"> <i class="fa fa-group fa-fw"></i> <b>Adventure</b> </a></li>
                    <li><a href="#storelocations" data-toggle="tab"> <i class="fa fa-map-marker fa-fw"></i> <b>Location</b> </a></li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <div class="col-md-9">
        <div class="box">
            <div class="box-header bg-gray-light">
                <h4>Content</h4>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <!-- Profile Tab Content -->
                        <div class="chart tab-pane fade in active" id="storeprofile">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-aqua"> Logo </label>
                                    <div class="col-sm-10">
                                        <div class="custom-text-display">
                                            <img class="img-thumbnail" src="{{asset($profile->com_logo)}}" style="max-height: 100px; max-width: 300px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-aqua">Code</label>
                                    <div class="col-sm-10">
                                        <div class="custom-text-display">{{$profile->com_code}}</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-aqua">Name</label>
                                    <div class="col-sm-10">
                                        <div class="custom-text-display">{{$profile->com_name}}</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-aqua">Tagline</label>
                                    <div class="col-sm-10">
                                        <div class="custom-text-display">{{$profile->com_tagline}}</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-aqua">Complete Address</label>
                                    <div class="col-sm-10">
                                        <div class="custom-text-display-textarea">{{$profile->com_address}}</div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <div class="col-sm-12">
                                        <a class="btn btn-sm btn-flat bg-blue" data-toggle="modal" href="#modal-default-profile"><i class="fa fa-edit"></i> Update Details</a>
                                        <a href="/togglehideshow/profile/@if($profile->com_profile_flag == 1){{0}}@else{{1}}@endif" class="btn btn-sm btn-flat bg-@if($profile->com_profile_flag == 1){{'red'}}@else{{'orange'}}@endif">
                                        <i class="fa fa-eye @if($profile->com_profile_flag == 1){{'-slash'}}@endif"></i> @if($profile->com_profile_flag == 1){{'Hide'}}@else{{'Show'}}@endif on Website</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Contact Tab Content -->
                        <div class="chart tab-pane fade" id="storecontactinformation">
                            <div class="hr-sect"> Social Media </div>
                            <!-- Form -->
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-aqua"><i class="fa fa-envelope fa-fw"></i> Email</label>
                                    <div class="col-sm-9 custom-label">
                                        <div class="custom-text-display-link"> {{$contact->com_email}} </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-aqua"><i class="fa fa-facebook-official fa-fw"></i> Facebook</label>
                                    <div class="col-sm-9">
                                        <div class="custom-text-display-link"> {{$contact->com_facebook}} </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-aqua"><i class="fa fa-twitter-square fa-fw"></i> Twitter </label>
                                    <div class="col-sm-9">
                                        <div class="custom-text-display-link"> {{$contact->com_twitter}} </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-aqua"><i class="fa fa-instagram fa-fw"></i> Instagram </label>
                                    <div class="col-sm-9">
                                        <div class="custom-text-display-link"> {{$contact->com_instagram}} </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Divider -->
                            <div class="hr-sect"> Contact Number </div>
                            <!-- Form -->
                            <form class="form-horizontal">
                                <!-- PERSONAL CONTACTS -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-aqua"> Phone Personal 1 </label>
                                    <div class="col-sm-3">
                                        <div class="custom-text-display"> {{Encrypter::phone_number_format($contact->com_pp_no_1)}} </div>
                                    </div>
                                    <label class="col-sm-3 control-label text-aqua"> Phone Personal 2 </label>
                                    <div class="col-sm-3">
                                        <div class="custom-text-display"> {{Encrypter::phone_number_format($contact->com_pp_no_2)}} </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-aqua"> Landline Personal 1 </label>
                                    <div class="col-sm-3">
                                        <div class="custom-text-display"> {{$contact->com_lp_no_1}} </div>
                                    </div>
                                    <label class="col-sm-3 control-label text-aqua"> Landline Personal 2 </label>
                                    <div class="col-sm-3">
                                        <div class="custom-text-display"> {{$contact->com_lp_no_2}} </div>
                                    </div>
                                </div>
                                <!-- COMPANY CONTACTS -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-aqua"> Phone Company 1 </label>
                                    <div class="col-sm-3">
                                        <div class="custom-text-display"> {{$contact->com_pc_no_1}} </div>
                                    </div>
                                    <label class="col-sm-3 control-label text-aqua"> Phone Company 2 </label>
                                    <div class="col-sm-3">
                                        <div class="custom-text-display"> {{$contact->com_pc_no_2}} </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-aqua"> Landline Company 1 </label>
                                    <div class="col-sm-3">
                                        <div class="custom-text-display"> {{$contact->com_lc_no_1}} </div>
                                    </div>
                                    <label class="col-sm-3 control-label text-aqua"> Landline Company 2 </label>
                                    <div class="col-sm-3">
                                        <div class="custom-text-display"> {{$contact->com_lc_no_2}} </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <div class="col-md-12">
                                        <a class="btn btn-sm btn-flat bg-blue" data-toggle="modal" href="#modal-default-contact"><i class="fa fa-edit"></i> Update Details</a>
                                        <a href="/togglehideshow/contact/@if($contact->com_contact_flag == 1){{0}}@else{{1}}@endif" class="btn btn-sm btn-flat bg-@if($contact->com_contact_flag == 1){{'red'}}@else{{'orange'}}@endif">
                                        <i class="fa fa-eye @if($contact->com_contact_flag == 1){{'-slash'}}@endif"></i> @if($contact->com_contact_flag == 1){{'Hide'}}@else{{'Show'}}@endif on Website</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- About Tab Content -->
                        <div class="chart tab-pane fade" id="storeabout">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <img class="img-thumbnail" src="{{asset($aboutus->com_about_us_img)}}" alt="user image"><br>
                                    <!--  <div class="upload-btn-wrapper">
                                        <button class="btn btn-plat bg-light-gray btn-block btn-xs">Change Me</button>
                                        <input type="file" name="aboutus_img" id="AboutUsId" onchange="return setImgname(this.id)">
                                        <p id="ImagePath"></p>
                                    </div> -->
                                </div>
                                <div class="col-xs-8">
                                    <label class="text-blue">
                                        <a href="#">About Us</a>
                                        <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                                    </label>
                                    <div class="custom-text-display text-justify" style="padding-right: 10px;">
                                        <?php echo $aboutus->com_about_us_desc; ?>
                                        </div><!-- / custom-text-display-->
                                        </div><!-- / col-xs-8 -->
                                        <div class="col-sm-12 text-right" style="margin-top: 10px;">
                                            <a class="btn btn-sm btn-flat bg-blue" data-toggle="modal" href="#modal-default-aboutus"><i class="fa fa-edit"></i> Update Details </a>
                                            <a href="/togglehideshow/aboutus/@if($aboutus->com_about_us_flag == 1){{0}}@else{{1}}@endif" class="btn btn-sm btn-flat bg-@if($aboutus->com_about_us_flag == 1){{'red'}}@else{{'orange'}}@endif">
                                            <i class="fa fa-eye @if($aboutus->com_about_us_flag == 1){{'-slash'}}@endif"></i> @if($aboutus->com_about_us_flag == 1){{'Hide'}}@else{{'Show'}}@endif on Website</a>
                                            </div><!-- /div class 12 -->
                                            </div><!-- / row -->
                                        </div>
                                        <!-- Values Tab Content -->
                                        <div class="chart tab-pane fade" id="storevalues">
                                            <div class="row">
                                                @foreach($values as $value)
                                                <div class="col-xs-2 text-right" style="padding: 10px;">
                                                    <img class="img-thumnail img-bordered" src="{{asset($value->com_values_image)}}" alt="user image" style="max-height: 155px; max-width: 230px;">
                                                </div>
                                                <div class="col-xs-10">
                                                    <label class="text-blue">
                                                        <a href="{{$value->com_values_link}}">{{$value->com_values_name}}</a>
                                                        <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                                                    </label>
                                                    <div class="custom-text-display">
                                                        <?php echo $value->com_values_desc;?>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 text-right" style="margin-top: 15px;">
                                                    <a class="btn btn-xs btn-flat bg-blue" data-toggle="modal" href="#modal-default-values-update-{{$value->id}}"><i class="fa fa-edit"></i> Update Details </a>
                                                    <a href="/togglehideshowvalues/{{$value->id}}/@if($value->com_values_flag_status == 1){{0}}@else{{1}}@endif" class="btn btn-xs btn-flat bg-@if($value->com_values_flag_status == 1){{'red'}}@else{{'orange'}}@endif">
                                                    <i class="fa fa-eye @if($value->com_values_flag_status == 1){{'-slash'}}@endif"></i> @if($value->com_values_flag_status == 1){{'Hide'}}@else{{'Show'}}@endif on Website</a>
                                                    <a href="/delete/values/{{$value->id}}" class="btn btn-xs btn-flat bg-red" onclick="return confirm('Are you sure you want to delete this row?')">
                                                    <i class="fa fa-trash"></i> Delete </a>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-right" style="margin-top: 15px;">
                                                    <a class="btn btn-sm btn-flat bg-blue" data-toggle="modal" href="#modal-default-add-values"><i class="fa fa-plus fa-fw"></i> Add Details </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Adventure Tab Content -->
                                        <div class="chart tab-pane fade" id="storeadventure">
                                            <!-- Photo Grid -->
                                            <div style="max-height: 500px; overflow-y: scroll;">
                                                <div class="col-md-3 no-padding">
                                                    <img src="https://www.w3schools.com/w3images/wedding.jpg" style="width:100%">
                                                    <img src="https://www.w3schools.com/w3images/rocks.jpg" style="width:100%">
                                                    <img src="https://www.w3schools.com/w3images/falls2.jpg" style="width:100%">
                                                    <img src="https://www.w3schools.com/w3images/paris.jpg" style="width:100%">
                                                </div>
                                            </div>
                                            <div class="row text-right">
                                                <div class="col-sm-12" style="margin-top: 15px;">
                                                    <a class="btn btn-sm btn-flat bg-blue" data-toggle="modal" href="#modal-default-add-adventure"><i class="fa fa-plus fa-fw"></i> Add Details </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Location Tab Content -->
                                        <div class="chart tab-pane fade" id="storelocations">
                                            <table class="table table-bordered table-condensed">
                                                <thead>
                                                    <tr class="bg-light-blue">
                                                        <th>Name</th>
                                                        <th>Street</th>
                                                        <th>Appartment, Suite, ect.</th>
                                                        <th>City</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach(SystemControl::system_control_location(1) as $location)
                                                    <tr>
                                                        <td>{{$location->location_name}}</td>
                                                        <td>{{$location->location_street}}</td>
                                                        <td>{{$location->location_address}}</td>
                                                        <td>{{$location->location_city}}</td>
                                                        <td>{{$location->location_phone}}</td>
                                                        <td>{{$location->location_email}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-xs-12 text-right">
                                                    <a class="btn btn-warning btn-flat btn-xs"><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                    <a class="btn btn-danger btn-flat btn-xs"><i class="fa fa-eye-slash fa-fw"></i> Hide </a>
                                                </div>
                                                </div><!-- / row -->
                                                <div class="row">
                                                    <div class="col-sm-12 text-right" style="margin-top: 15px;">
                                                        <button class="btn btn-sm btn-flat bg-blue"><i class="fa fa-plus"></i> Add location </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- Modals -->
                    <!-- For Profile -->
                    <div class="modal fade" id="modal-default-profile">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form role="form" action="edit/company/profile" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-home fa-fw"></i> Company Profile</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Logo</label>
                                                <input type="hidden" name="company_logo_old" value="{{$profile->com_logo}}">
                                                <input type="file" name="company_logo">
                                                <p class="help-block">Image must 36X36px. Type (JPEG,PNG,GIF)</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Code</label>
                                                <input type="text" class="form-control text-uppercase" name="company_code" value="{{$profile->com_code}}" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control text-uppercase" name="company_name" value="{{$profile->com_name}}" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Tagline</label>
                                                <input type="text" class="form-control" name="company_tagline" value="{{$profile->com_tagline}}" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" name="company_address" style="resize: vertical; min-height: 50px;">{{$profile->com_address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-flat bg-red pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                        <button type="submit" class="btn btn-flat bg-blue pull-right"><i class="fa fa-check"></i> Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- FOR CONPANY CONTACT -->
                    <div class="modal fade" id="modal-default-contact">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form role="form" action="update/contact" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-phone fa-fw"></i> Contacts </h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Divider -->
                                        <div class="hr-sect"> Social Media </div>
                                        <!-- Form -->
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> Email</label>
                                                <div class="col-sm-9 custom-label">
                                                    <input type="text" class="form-control input-sm" name="email" value="{{$contact->com_email}}" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> Facebook</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control input-sm" name="facebook" value="{{$contact->com_facebook}}" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> Twitter </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control input-sm" name="twitter" value="{{$contact->com_twitter}}" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> Instagram </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control input-sm" name="instagram" value="{{$contact->com_instagram}}" autocomplete="off">
                                                </div>
                                            </div>
                                            </div><!--./ Div Horizontal -->
                                            <!-- Divider -->
                                            <div class="hr-sect"> Contact Number (Optional) </div>
                                            <!-- Form -->
                                            <div class="form-horizontal">
                                                <!-- PERSONAL CONTACTS -->
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"> Phone Personal 1 </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" maxlength="10" class="form-control input-sm" name="phone_personal_1" value="{{$contact->com_pp_no_1}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                    </div>
                                                    <label class="col-sm-3 control-label"> Phone Personal 2 </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" maxlength="10" class="form-control input-sm" name="phone_personal_2" value="{{$contact->com_pp_no_2}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"> Landline Personal 1 </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" maxlength="10" class="form-control input-sm" name="landline_personal_1" value="{{$contact->com_lp_no_1}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                    </div>
                                                    <label class="col-sm-3 control-label"> Landline Personal 2 </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" maxlength="10" class="form-control input-sm" name="landline_personal_2" value="{{$contact->com_lp_no_2}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                    </div>
                                                </div>
                                                <!-- COMPANY CONTACTS -->
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"> Phone Company 1 </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" maxlength="10" class="form-control input-sm" name="personal_company_1" value="{{$contact->com_pc_no_1}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                    </div>
                                                    <label class="col-sm-3 control-label"> Phone Company 2 </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" maxlength="10" class="form-control input-sm" name="personal_company_2" value="{{$contact->com_pc_no_2}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"> Landline Company 1 </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" maxlength="10" class="form-control input-sm" name="landline_company_1" value="{{$contact->com_lc_no_1}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                    </div>
                                                    <label class="col-sm-3 control-label"> Landline Company 2 </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" maxlength="10" class="form-control input-sm" name="landline_company_2" value="{{$contact->com_lc_no_2}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                    </div>
                                                </div>
                                                </div><!-- /. Div horixontal -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-flat bg-red pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                <button type="submit" class="btn btn-flat bg-blue pull-right"><i class="fa fa-check"></i> Submit </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- FOR OVERVIEW / ABOUT US -->
                            <div class="modal fade" id="modal-default-aboutus">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form role="form" action="update/aboutus" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-about fa-fw"></i> Overview / About Us</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="hidden" name="com_about_us_img" value="{{$aboutus->com_about_us_img}}">
                                                        <input type="file" name="aboutus_img">
                                                        <p class="help-block">Image must 36X36px. Type (JPEG,PNG,GIF)</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea class="form-control textarea" name="aboutus_desc" style="resize: horizontal; min-height: 200px;"><?php echo $aboutus->com_about_us_desc; ?> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-flat bg-red pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                <button type="submit" class="btn btn-flat bg-blue pull-right"><i class="fa fa-check"></i> Submit </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- For Values for ADDING -->
                            <div class="modal fade" id="modal-default-add-values">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form role="form" action="add/values/{{$profile->id}}" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-handshake-o fa-fw"></i> Values </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <div class="upload-btn-wrapper">
                                                        <button type="button" class="btn btn-sm btn-block bg-green"><i class="fa fa-image"></i> Upload Image </button>
                                                        <input type="file" name="values_img" onchange="return setImgname(this.value)" accept="image/x-png,image/gif,image/jpeg">
                                                        <p class="ImagePath"></p>
                                                    </div>
                                                    <!-- <input type="text" name="com_values_img" value="$values->$com_values_image"> -->
                                                    <!-- <button type="button" class="btn btn-sm btn-block bg-green"><i class="fa fa-image"></i> Upload Image </button>
                                                    <input type="file" name="values_img" style="width: 100%; top: -15px; float: left; "> -->
                                                    <p class="help-block">Image must atleast minimum of 50X50px. Type (JPEG,PNG,GIF)</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Link</label>
                                                    <input type="text" name="values_link" class="form-control" placeholder="Optional" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="values_name" class="form-control" placeholder="Required" required autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="textarea form-control" name="values_desc" placeholder="Place some text here" style="resize: horizontal;" required autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-flat bg-red pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                <button type="submit" class="btn btn-flat bg-blue pull-right"><i class="fa fa-check"></i> Submit </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- For Values for UPDATE -->
                            @foreach($values as $modal_dtl)
                            <div class="modal fade" id="modal-default-values-update-{{$modal_dtl->id}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form role="form" action="update/values" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-handshake-o fa-fw"></i> Values </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group"><center>
                                                    <img class="img-thumnail img-bordered" src="{{asset($modal_dtl->com_values_image)}}" alt="user image" style="max-height: 155px; max-width: 230px;"></center>
                                                    <div class="upload-btn-wrapper">
                                                        <input type="hidden" name="com_values_image" value="{{$modal_dtl->com_values_image}}">
                                                        <input type="hidden" name="com_values_id" value="{{$modal_dtl->id}}">
                                                        <button type="button" class="btn btn-sm btn-block bg-green"><i class="fa fa-image"></i> Cnange Image </button>
                                                        <input type="file" name="values_img" onchange="return setImgname(this.value)">
                                                        <p class="ImagePath"></p>
                                                    </div>
                                                    <label>Image</label>
                                                    <!-- <button type="button" class="btn btn-sm btn-block bg-green"><i class="fa fa-image"></i> Upload Image </button>
                                                    <input type="file" name="values_img" style="width: 100%; top: -15px; float: left; "> -->
                                                    <p class="help-block">Image must atleast minimum of 50X50px. Type (JPEG,PNG,GIF)</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Link</label>
                                                    <input type="text" name="values_link" class="form-control" value="{{$modal_dtl->com_values_link}}" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="values_name" class="form-control" value="{{$modal_dtl->com_values_name}}" required autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="textarea form-control" name="values_desc" placeholder="Place some text here" style="resize: horizontal;" required autocomplete="off">{{$modal_dtl->com_values_desc}}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-flat bg-red pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                <button type="submit" class="btn btn-flat bg-blue pull-right"><i class="fa fa-check"></i> Submit </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- For Values for ADDING -->
                            <div class="modal fade" id="modal-default-add-adventure">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form role="form" action="add/adventure/{{$profile->id}}" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-photo fa-fw"></i> Adventure </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <div class="upload-btn-wrapper">
                                                        <button type="button" class="btn btn-sm btn-block bg-green"><i class="fa fa-image"></i> Upload Image </button>
                                                        <input type="file" name="adventure_image[]" onchange="return setImgname(this.value)" accept="image/x-png,image/gif,image/jpeg" multiple="">
                                                        <p class="ImagePath"></p>
                                                    </div>
                                                    <p class="help-block">Image must atleast minimum of 50X50px. Type (JPEG,PNG,GIF)</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-flat bg-red pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                <button type="submit" class="btn btn-flat bg-blue pull-right"><i class="fa fa-check"></i> Submit </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- For Location -->
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form role="form" action="add/location" method="post" enctype="multipart/form-data"> {{ csrf_field() }}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Default Modal</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Location/Branch Name</label>
                                                    <input type="text" class="form-control" name="location_name[]">
                                                </div>
                                                <div class="form-group">
                                                    <label>Location/Branch Complete Address <i>( Bldg / Street / Brgy / City )</i> </label>
                                                    <input type="text" class="form-control" name="location_address[]">
                                                </div>
                                                <div class="form-group">
                                                    <label>Location/Branch Contact <i>( Phone / Landline )</i> </label>
                                                    <input type="text" class="form-control" name="location_phone_landline[]">
                                                </div>
                                                <div class="form-group">
                                                    <label>Facebook Link <i>( Optional )</i></label>
                                                    <input type="text" class="form-control" name="location_phone_landline[]" placeholder="https://www.facebook.com/profile.php">
                                                </div>
                                                <div class="form-group">
                                                    <label>Twitter Link <i>( Optional )</i></label>
                                                    <input type="text" class="form-control" name="location_phone_landline[]" placeholder="https://www.twitter.com/profile.php">
                                                </div>
                                                <div class="form-group">
                                                    <label>Instagram Link <i>( Optional )</i></label>
                                                    <input type="text" class="form-control" name="location_phone_landline[]" placeholder="https://www.instagram.com/profile.php">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email Address <i>( Optional )</i></label>
                                                    <input type="email" class="form-control" name="location_phone_landline[]"  placeholder="sampleemail@gmail.com">
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="pull-right" name="visibility" style="height: 16px; width: 16px;"> Hide Location
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Submit </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            @endsection
                            @section('script')
                            <script>
                            $(function () {
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            //CKEDITOR.replace('editor1')
                            //bootstrap WYSIHTML5 - text editor
                            $('.textarea').wysihtml5()
                            });
                            /* ANGULAR JS */
                            // var AngularModule = angular.module('MyAngular', []);
                            // AngularModule.config(function($interpolateProvider) {
                            //   $interpolateProvider.startSymbol('//');
                            //   $interpolateProvider.endSymbol('//');
                            // });
                            // AngularModule.controller('withValidation', function($scope, $http) {
                            //   $scope.setMenuparent = function() {
                            //     var value = $scope.myValue
                            //     $scope.label = value;
                            //     $http.get("{{url('/getArrayData')}}/" + value).then(function (response) {
                            //       $scope.myData = response.data;
                            //     });
                            //   };
                            // });
                            /* ABOUT US ANGULAR JS */
                            // var AboutUsimg = angular.module('AboutUs', []);
                            // AboutUsimg.config(function($interpolateProvider) {
                            //   $interpolateProvider.startSymbol('//');
                            //   $interpolateProvider.endSymbol('//');
                            // });
                            // AngularModule.controller('AboutUsCOntroller', function($scope, $http){
                            //   //$scope.viewImage = 'Change Me';
                            //   // console.log($scope);
                            //   // $scope.viewImage = 'Chalres';
                            //   // $scope.setImgname = function(){
                            //   //   alert();
                            //   // }
                            // });
                            // AngularModule.controller('AboutUsCOntroller', function($scope, $http){
                            //   $scope.inputChange = function(){
                            //     // alert($scope.inputModel);
                            //     // console.log($scope);
                            //     //$scope.viewImage = $scope.inputModel;
                            //   }
                            // });
                            /* JQUERY */
                            function setImgname(evt){
                            $('.ImagePath').text(evt);
                            
                            // var fi = document.getElementById(evt); // GET THE FILE INPUT AS VARIABLE.
                            // var totalFileSize = 0;
                            // // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
                            // if (fi.files.length > 0)
                            // {
                            //     // RUN A LOOP TO CHECK EACH SELECTED FILE.
                            //     for (var i = 0; i <= fi.files.length - 1; i++)
                            //     {
                            //         //ACCESS THE SIZE PROPERTY OF THE ITEM OBJECT IN FILES COLLECTION. IN THIS WAY ALSO GET OTHER PROPERTIES LIKE FILENAME AND FILETYPE
                            //         var fsize = fi.files.item(i).size;
                            //         totalFileSize = totalFileSize + fsize;
                            //         document.getElementById('fp').innerHTML =
                            //         document.getElementById('fp').innerHTML
                            //         +
                            //         '<br /> ' + 'File Name is <b>' + fi.files.item(i).name
                            //         +
                            //         '</b> and Size is <b>' + Math.round((fsize / 1024)) //DEFAULT SIZE IS IN BYTES SO WE DIVIDING BY 1024 TO CONVERT IT IN KB
                            //         +
                            //         '</b> KB and File Type is <b>' + fi.files.item(i).type + "</b>.";
                            //     }
                            // }
                            // document.getElementById('divTotalSize').innerHTML = "Total File(s) Size is <b>" + Math.round(totalFileSize / 1024) + "</b> KB";
                            // $('#ImagePath').text(evt);
                            // var fileName = e.target.files[0].name;
                            //       alert('The file "' + fileName +  '" has been selected.');
                            // //$.post('/update/aboutusimg',function(){  })
                            }
                            function GetFileSizeNameAndType(){
                            // var fi = document.getElementById('file'); // GET THE FILE INPUT AS VARIABLE.
                            // var totalFileSize = 0;
                            // // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
                            // if (fi.files.length > 0)
                            // {
                            //     // RUN A LOOP TO CHECK EACH SELECTED FILE.
                            //     for (var i = 0; i <= fi.files.length - 1; i++)
                            //     {
                            //         //ACCESS THE SIZE PROPERTY OF THE ITEM OBJECT IN FILES COLLECTION. IN THIS WAY ALSO GET OTHER PROPERTIES LIKE FILENAME AND FILETYPE
                            //         var fsize = fi.files.item(i).size;
                            //         totalFileSize = totalFileSize + fsize;
                            //         document.getElementById('fp').innerHTML =
                            //         document.getElementById('fp').innerHTML
                            //         +
                            //         '<br /> ' + 'File Name is <b>' + fi.files.item(i).name
                            //         +
                            //         '</b> and Size is <b>' + Math.round((fsize / 1024)) //DEFAULT SIZE IS IN BYTES SO WE DIVIDING BY 1024 TO CONVERT IT IN KB
                            //         +
                            //         '</b> KB and File Type is <b>' + fi.files.item(i).type + "</b>.";
                            //     }
                            // }
                            // document.getElementById('divTotalSize').innerHTML = "Total File(s) Size is <b>" + Math.round(totalFileSize / 1024) + "</b> KB";
                            }
                            
                            // AboutUsCOntroller
                            // setImgname
                            // Imgname
                            // Imgname
                            /* ng-change="setMenuparent(this.value)" ng-model="myValue" */
                            /* JQUERY */
                            // function numberOnly(evt){
                            //   var value = evt.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                            //   return value;
                            // }
                            </script>
                            <!-- function
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" -->
                            @endsection