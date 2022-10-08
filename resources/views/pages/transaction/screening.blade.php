@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Screening')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- pace --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">

@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')

@if(auth()->user()->can('view screening')/* && $some_other_condition*/)
<!-- add result laboratorium -->
<section class="add_registration-list-wrapper">
  <div class="add_registration-list-table">
    <div class="card ">
      <div class="card-body">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
      	{{-- <form id="InsertRegistration" data-route="{{ route('InsertRegistration') }}" role="form" method="POST" accept-charset="utf-8"> --}}
        {{-- start form --}}
      	<div class="row match-height">
          <div class="col-12">
               <div class="row">
		            <div class="col-sm-4 col-12">
		                <h6><small class="text-muted">Registration Date</small></h6>
		                <p><b>{{ $databasic->pentgl }}</b></p>
		            </div>
		            <div class="col-sm-4 col-12">
		                <h6><small class="text-muted">Reference Date</small></h6>
		                <p><b>{{ $databasic->pentglrujukan }}</b></p>
		            </div>
		            <div class="col-sm-4 col-12">
		                <h6><small class="text-muted">Patient Name</small></h6>
		                <p><b>{{ $databasic->pasnama }}</b></p>
		            </div>
		            <div class="col-sm-4 col-12">
		                <h6><small class="text-muted">Partner</small></h6>
		                <p><b>{{ $databasic->pennama }}</b></p>
		            </div>
		            <div class="col-sm-4 col-12">
		                <h6><small class="text-muted">Type Of Billing</small></h6>
		                <p><b>{{ $databasic->pemnama }}</b></p>
		            </div>
		        </div>
		        <hr>


              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="home-tab" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">
                        <i class='bx bx-band-aid align-middle'></i>
                        <span class="align-middle">Reassessment Health</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="profile-tab" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">
                        <i class='bx bxs-first-aid align-middle'></i>
                        <span class="align-middle">Health Screening</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="about-tab" id="about-tab" data-toggle="tab" href="#about" aria-controls="about" role="tab" aria-selected="false">
                        <i class='bx bx-first-aid align-middle'></i>
                        <span class="align-middle">Health Screening 2</span>
                    </a>
                </li>
              </ul>
              <div class="tab-content p-0">
                  
                  {{-- PAGE 1 --}}

                  <div class="tab-pane home-tab" id="home" aria-labelledby="home-tab" role="tabpanel">
                    <form id="UpdateScreeningSatu" data-route="{{ route('UpdateScreeningSatu',['id_regis' => $id_res_encrypt]) }}" role="form" method="POST" accept-charset="utf-8">
                    <div class="form-body">
                    <h6 class="card-title">Medical check up data</h6>
                      <div class="row">

                        {{-- Medical Check Up Data --}}

                          <div class="col-md-4 col-12">
                            <label for="registration-date">Date of exam <code>Registration Date</code></label>
                              <div class="position-relative has-icon-left">
                                  <input type="date" value="{{ $databasic->pentgl }}" name="date_registration" class="form-control" placeholder="Registration Data" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-calendar"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label for="certification">Certification</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="certification" name="certification" placeholder="leave certification" aria-label="certification">@if($GetScrReassessment){{ $GetScrReassessment->certification }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bx-note'></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label for="remark/medical history">Remark exam/medical history</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="remarkexam" name="remarkexam" placeholder="leave remark exam" aria-label="remark exam">@if($GetScrReassessment){{ $GetScrReassessment->remark_exam }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bx-note'></i>
                                  </div>
                              </div>
                          </div>

                        </div>

                        <hr>
                        {{-- Then futher examination was conduted --}}
                      
                      <h6 class="card-title">Then futher examination was conduted</h6>
                      <div class="row">
                          <div class="col-md-4 col-12">
                            <label for="doctor name">Doctor's Name</label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" value="{{ $users->name }}" name="doctor_name" class="form-control" placeholder="Doctor name" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-user"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <label for="date of exam">Date of exam <code>Reference Date</code></label>
                              <div class="position-relative has-icon-left">
                                  <input type="date" value="{{ $databasic->pentglrujukan }}" name="date_of_exam" class="form-control" placeholder="Date of exam" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-calendar"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-12 mb-1">
                            <label for="place of exam">Place of exam</label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" value="Laboratorium Klinik Osmaro" name="place_of_exam" class="form-control" placeholder="Place of exam" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-home"></i>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4 mb-1">
                            <label for="conclusion/remark">Conclusion/Remark</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="conclusion_remark" name="conclusion_remark" placeholder="leave remark exam" aria-label="remark exam">@if($GetScrReassessment){{ $GetScrReassessment->conclusion_remark }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-info-circle'></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>

                      {{-- Recertification --}}
                      
                      <h6 class="card-title">Recertification & Advice</h6>
                      <div class="row">
                    
                          <div class="col-md-6 mb-1">
                            <label for="recertification">Recertification</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="recertification" name="recertification" placeholder="leave recertification" aria-label="recertification">@if($GetScrReassessment){{ $GetScrReassessment->recertification }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-certification'></i>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-6 mb-1">
                            <label for="advice">advice</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="advice" name="advice" placeholder="leave advice" aria-label="advice">@if($GetScrReassessment){{ $GetScrReassessment->advice }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-smile'></i>
                                  </div>
                              </div>
                          </div>
                      
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success PrintSatu glow shadow"><i class='bx bx-check HaveChangeSatu'></i> <font class="UpdateSatu">Up to date</font></button>
                    <a target="_blank" class="btn btn-primary glow shadow" href="{{ route('PrintReassessmentHealth',['id_regis' => $id_res_encrypt])}}"><i class='bx bx-printer'></i> Print</a>
                  </form>
                  </div>

                  {{-- PAGE 2 --}}

                  <div class="tab-pane profile-tab" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                    <form id="UpdateScreeningSatu" data-route="{{ route('UpdateScreeningSatu',['id_regis' => $id_res_encrypt]) }}" role="form" method="POST" accept-charset="utf-8">
                    <div class="form-body">

                      {{-- Medical History --}}
                      <h6 class="card-title">Medical History</h6>
                      <div class="row">

                          <div class="col-md-5 mb-1 mr-0">
                            <label for="medical-history">Medical History<code>pick if have</code></label>
                            <select class="select2 form-control" multiple="multiple" name="medical_history[]">
                              @forelse($MedHis as $keyf => $valMedHis)
                                <option value="{{ $valMedHis->id_medical_history }}">{{ $valMedHis->name_medical_history }}</option>
                              @empty
                                <option value="">Data Not Found !</option>
                              @endforelse
                            </select>
                          </div>

                          <div class="col-md-1 mb-1">
                            <li class="d-inline-block pt-2">
                              <fieldset>
                                  <div class="checkbox checkbox-primary checkbox-glow">
                                      <input type="checkbox" id="checkboxGlow1" name="medical_history[]">
                                      <label for="checkboxGlow1">Others</label>
                                  </div>
                              </fieldset>
                            </li>
                          </div>
                          

                      </div>
                      <hr>

                      {{-- CLINIC EXAMINATION --}}
                      <h6 class="card-title">Clinic Examination</h6>
                      <div class="row">

                          <div class="col-md-3 mb-1">
                            <label for="weight">Weight</label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" name="weight" class="form-control" placeholder="Weight">
                                  <div class="form-control-position">
                                      <i class='bx bx-dumbbell'></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-3 mb-1">
                            <label for="height">Height</label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" name="height" class="form-control" placeholder="Height">
                                  <div class="form-control-position">
                                      <i class='bx bx-ruler'></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-3 mb-1">
                            <label for="bmi">BMI <code>body mass indeks</code></label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" name="bmi" class="form-control" placeholder="BMI">
                                  <div class="form-control-position">
                                      <i class='bx bx-dumbbell'></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-3 mb-1">
                            <label for="visus">Visus</label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" name="visus" class="form-control" placeholder="Visus">
                                  <div class="form-control-position">
                                      <i class='bx bx-show-alt'></i>
                                  </div>
                              </div>
                          </div>

                          {{-- TABELING INPUT CLINIC EXAMINATION --}}
                          
                          <div class="col-md-12 mb-1">
                            <table border="0">
                              <tbody>
                                <tr>
                                  <td style="width:50%">
                                    
                                    <table class="table table-bordered table-sm">
                                        {{-- vision --}}
                                        <thead>
                                          <tr>
                                            <th>1. Vision</th>
                                            <th style="text-align:center;" nowrap>No/Normal - Yes/Abnormal</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">a. Distant Vision</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" id="distant_vision">
                                                  <label class="custom-control-label" for="distant_vision">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:10px;">b. Near Vision</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="near_vision">
                                                <label class="custom-control-label" for="near_vision">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:10px;">c. Colour Vision</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="colour_vision">
                                                <label class="custom-control-label" for="colour_vision">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:10px;">d. Any Organic Eye Disease</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="any_organic_eye_disease">
                                                <label class="custom-control-label" for="any_organic_eye_disease">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        {{-- hearing --}}
                                        <thead>
                                          <tr>
                                            <th colspan="2">2. Hearing</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px; font-size:12px; text-align: left;">Unable to hear ordinary conversation at 2 m</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="hearing">
                                                <label class="custom-control-label" for="hearing">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>

                                        {{-- cardiovascular system --}}
                                        <thead>
                                          <tr>
                                            <th colspan="2">3. Cardiovascular System</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">a. Blood Pressure</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="blood_pressure">
                                                <label class="custom-control-label" for="blood_pressure">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:30px; font-size: 13px;">Systolic/Diastolic</td>
                                            <td style=" text-align: center;">
                                              <div class="input-group">
                                                <input class="form-control form-control-sm" name="Systolic/Diastolic" id="Systolic_Diastolic" type="text" placeholder="Input Systolic/Diastolic" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text form-control-sm">mmHg</span>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:30px; font-size: 13px;">Pulse</td>
                                            <td style=" text-align: center;">
                                              <div class="input-group">
                                                <input class="form-control form-control-sm" name="Pulse" id="pulse" type="text" placeholder="Input Pulse" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text form-control-sm">x/minute</span>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>

                                      </table>

                                  </td>
                                  <td style="width:50%"></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          
                      </div>

                    </div>

                    <button type="submit" class="btn btn-success PrintSatu glow shadow"><i class='bx bx-check HaveChangeSatu'></i> <font class="UpdateSatu">Up to date</font></button>
                    <a target="_blank" class="btn btn-primary glow shadow" href="{{ route('PrintReassessmentHealth',['id_regis' => $id_res_encrypt])}}"><i class='bx bx-printer'></i> Print</a>
                  </form>
                  </div>

                  <div class="tab-pane about-tab" id="about" aria-labelledby="about-tab" role="tabpanel">
                      <p>
                          Health Screening 2
                      </p>
                  </div>
              </div>
				     
              </div>
		   	</div>
		  {{-- endform --}}
		  <hr>
      <div class="col-12 d-flex justify-content-end p-0 m-0">
        <div class="shadow-lg p-1 bg-white rounded">
            <a href="{{ route('ViewLaboratorium') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
            <button type="submit" class="btn btn-outline-primary mr-0 btn_insert_registration"><i class='bx bx-printer'></i> Print All Report Screening</button>
        </div>
      </div>
      {{-- </form> --}}
      </div>
    </div>
  </div>
</section>
<!-- add result laboratorium -->
@else
<div class="col-xl-7 col-md-8 col-12">
    <div class="card bg-transparent shadow-none">
      <div class="card-body text-center">
        <img src="{{asset('images/pages/not-authorized.png')}}" class="img-fluid" alt="not authorized" width="400">
        <h1 class="my-2 error-title">You are not authorized!</h1>
        <p>
            You do not have permission to view this directory or page using
            the credentials that you supplied.
        </p>
        <a href="{{asset('/')}}" class="btn btn-primary round glow mt-2">BACK TO MAIN DASHBOARD</a>
      </div>
    </div>
</div>
@endif

@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')

<script type="text/javascript">

//top end notif
const ToastToB = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true,
didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})

// button update
$("form #certification, #remarkexam, #conclusion_remark, #recertification, #advice").change(function() {
  // <i class='bx bxs-cloud-upload'></i>
  $(".PrintSatu").addClass("btn-info");
  $(".HaveChangeSatu").addClass("ficon bx-tada bx-flip-horizontal bxs-cloud-upload");
  $(".UpdateSatu").html("Update");
});

// Basic Select2 select
$(".select2").select2({
  dropdownAutoWidth: true,
  placeholder: "Select Medical History",
  allowClear: true,
  width: '100%'
});

/*---------------------update reassessment health report------------------------*/
$(document).on('submit', '#UpdateScreeningSatu', function(e) {
    e.preventDefault();
    var route = $('#UpdateScreeningSatu').data('route');
    var form_data = $(this);
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    Pace.track(function(){
      Pace.restart();
      $.ajax({
          type: 'POST',
          url: route,
          data: form_data.serialize(),
          beforeSend: function() {
            $('.PrintSatu').prop('disabled', true);
          },
          success: function(data) {
            switch (data.code) {
              case "1":
                ToastToB.fire({icon: 'error',title: data.fail});
              break;
              case "2":
                ToastToB.fire({icon: 'success',title: 'Succes update Reassessment Health Report'});
                $(".HaveChangeSatu").removeClass("ficon bx-tada bx-flip-horizontal bxs-cloud-upload");
                $(".PrintSatu").removeClass("btn-info");
                $(".UpdateSatu").html("Up to date");
              break;
              case "3":
                ToastToB.fire({icon: 'error',title: 'Insert Registration Failed'});
              break;
              default:
              break;
            }
           },
          complete: function() {
            $('.PrintSatu').prop('disabled', false);
          },
          error: function(data,xhr) {
            alert("Failed response")
          },
      });
  });
});


//--------------- setingan active tab--------------------//
$(document).ready(function() {
  // Get saved data from sessionStorage
  let selectedCollapse = sessionStorage.getItem('selectedCollapse');
  if(selectedCollapse != null) {
    $('.accordion .collapse .nav-link .tab-pane').removeClass('active');
    $("#"+selectedCollapse).addClass('active');
    $("."+selectedCollapse).addClass('active');
  }
  //To set, which one will be opened
  $(document).on("click", ".ChangeTab", function () {
    let target = $(this).attr('tujuan');
    //Save data to sessionStorage
    sessionStorage.setItem('selectedCollapse', target);
  });
});

</script>
<style type="text/css">
.select2-search--inline {
    display: contents; /*this will make the container disappear, making the child the one who sets the width of the element*/
}

.select2-search__field:placeholder-shown {
    width: 100% !important; /*makes the placeholder to be 100% of the width while there are no options selected*/
}
</style>
@endsection
