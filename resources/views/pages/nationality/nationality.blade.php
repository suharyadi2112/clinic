@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Nationality')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">  
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

@endsection

@section('content')

@if(auth()->user()->can('view nationality')/* && $some_other_condition*/)
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Nationality</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
        {{-- batas table --}}
        <div class="table-responsive">

        @if(auth()->user()->can('create nationality')/* && $some_other_condition*/)
            <button type="button" class="btn btn-primary round addNationality"><i class="bx bx-plus-circle"></i> Create Nationality</button>
        @endif
            <table class="table yajra-datatable table-inverse table-hover" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nationality</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        {{-- batas table --}}
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
<!--/ Description -->

<!--/ HTML Markup -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script> 
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>



<script type="text/javascript">

 $(function () {  

    //show data
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ShowNationality') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kwn', name: 'kwn'},
            {
              data: 'action', 
              name: 'action' 
              // orderable: true, 
              // searchable: true
            },
        ]
    });


    //insert
    $(document).on('click', '.addNationality', function () {
        Swal.fire({
          title: 'New Nationality',
          input: 'text',
          inputAttributes: {
            autocapitalize: 'off'
          },
          showCancelButton: true,
          confirmButtonText: 'Submit',
          showLoaderOnConfirm: true,
          allowOutsideClick: false,
          preConfirm: (data) => {
            if (data) {
                return fetch(`{{ Route('StoreNationality') }}`,{
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({nameNationality: data})
                }).then(response => {
                    
                    $('.yajra-datatable').DataTable().ajax.reload();
                    return response.json()
                }).catch(error => {
                    Swal.showValidationMessage(
                      `Request failed: ${error}`
                    )
                    console.log(error)
                })
            } else {
                Swal.showValidationMessage('First input missing')   
            }
          },
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: `Success`,
            })
          }
        })
    }); 


    //delete
    $(document).on('click', '.delNA', function () {
        var id = $(this).attr('data-id')
        Swal.fire({
          title: 'Are you sure delete this data ?',
          showCancelButton: true,
          confirmButtonText: 'Yes',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              if (id) {
                return fetch('{{route("DelNationality", ":id")}}'.replace(":id", id),{
                    method: 'DELETE',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).then(response => {
                    $('.yajra-datatable').DataTable().ajax.reload();
                    Swal.fire('Success!', '', 'success')
                    return response.json()
                }).catch(error => {
                    Swal.fire('Server Error', '', 'error')
                    console.log(error)
                })
            } else {
                Swal.fire('Server Error', '', 'error')
            }
          }
        })
    });


    //update
    $(document).on('click', '.upNA', function () {
        var id = $(this).attr('data-id')
        var nameRole = $(this).attr('vall')
        Swal.fire({
          title: 'Update Nationality',
          input: 'text',
          inputValue: nameRole,
          inputAttributes: {
            autocapitalize: 'off'
          },
          showCancelButton: true,
          confirmButtonText: 'Update',
          showLoaderOnConfirm: true,
          allowOutsideClick: false,
          preConfirm: (data) => {
            if (data) {
                return fetch('{{route("PutNationality", ":id")}}'.replace(":id", id),{
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({NewUpdateNationality: data})
                }).then(response => {
                    
                    $('.yajra-datatable').DataTable().ajax.reload();
                    return response.json()
                }).catch(error => {
                    Swal.showValidationMessage(
                      `Request failed: ${error}`
                    )
                    console.log(error)
                })
            } else {
                Swal.showValidationMessage('First input missing')   
            }
          },
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: `Success`,
            })
          }
        })
    }); 
    
  
});
</script>
@endsection
