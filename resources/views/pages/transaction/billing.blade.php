@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Laboratorium')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- pace --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">

@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')

@if(auth()->user()->can('view billing')/* && $some_other_condition*/)
<!-- billing list start -->
<section class="billing-list-wrapper">
  <div class="billing-list-table">
    <div class="card">
      <div class="card-body">
        <!-- datatable start -->
        @if (session('error'))
		    <div class="alert alert-danger">
		        {{ session('error') }}
		    </div>
		@endif
        <div class="table-responsive">
          <table id="billing-list-datatable" class="table table-striped table-sm table-hover" width="100%">
            <thead>
             	<tr>
             		<th>No</th>
                	<th>Registration Number</th>
                	<th>NIK</th>
                	<th>Registration Date</th>
                	<th>Patient Name</th>
                	<th>Partner</th>
                	<th>Reference Date</th>
                	<th>Type Of Billing</th>
                	<th>Action</th>
                	<th>Billing</th>
                	<th>Account Receivable</th>
                	<th style="text-align: center;"><i class="bx bx-cog"></i></th>
            	</tr>
            </thead>
          </table>
        </div>
        <!-- datatable ends -->
      </div>
    </div>
  </div>
</section>
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
<!-- registration list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>

<script type="text/javascript">

</script>

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

$(document).ready(function(){
	var dt = $('#billing-list-datatable').DataTable({
	    processing: true,
	    ordering: true,
	    serverSide: true,
	    ajax: "{{ route('Billing') }}",
	    columns: [
	      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'penid', name: 'penid'},
        {data: 'pasnik', name: 'pasnik'},
        {data: 'pentgl', name: 'pentgl'},
        {data: 'pasnama', name: 'pasnama'},
        {data: 'pennama', name: 'pennama'},
        {data: 'pentglrujukan', name: 'pentglrujukan'},
        {data: 'pemnama', name: 'pemnama'},
        {data: 'action', name: 'action'},
        {data: 'billing', name: 'billing'},
        {data: 'bayar', name: 'bayar'},
        {data: 'bayar', name: 'bayar'},
	    ],
	    createdRow:function(row,data,index){
	    	$('td',row).eq(5).attr("nowrap","nowrap");
	    	$('td',row).eq(5).css("text-align","center");
		}
	});
});

</script>
@endsection
