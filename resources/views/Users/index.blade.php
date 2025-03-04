@extends('Layouts.dashboard')
@section('title')
    {{__('users.index')}}
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1> {{__('users.index')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active"> {{__('users.index')}}</li>

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
           
            <!-- /.card-header -->
           
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('users.index')}}</h3>
              @include('Layouts.messages')

            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                 <thead>
                                    <tr>
                                        <th>{{__('users.firstname')}}</th>
                                        <th >{{__('users.lastname')}}</th>
                                        <th>{{__('users.title')}}</th>
                                        <th>{{__('action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->firstname}}</td>
                                        <td>{{$user->lastname}}</td>
                                        <td>{{$user->postTitle->title}}</td>
                                        <td><span style="float: right" ><a href="{{ route('users.edit', $user->id) }}"><i class="fa fa-edit"></i></a></span>
                                          <span style="float: right" ><a href="{{ route('users.show', $user->id) }}" title="{{__('show')}}"><i class="fa fa-eye"></i></a></span>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button class="fa fa-trash" style="float: right" type="submit" ></button>
      </form>
      

                                        </td>
                                        </tr>

                                        @endforeach

</tbody>
</table>
<div class="card">
           
            <div class="card-body">
<a href="{{route('users.create')}}" class="btn btn-primary">{{__('users.create')}}</a>
</div>
</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

    </section>
                       
    <script>
  $(function () {
    $("#example1").DataTable({
        "language": {
            "paginate": {
                "next": "بعدی",
                "previous" : "قبلی"
            }
        },
        "info" : false,
    });
    $('#example2').DataTable({
        "language": {
            "paginate": {
                "next": "بعدی",
                "previous" : "قبلی"
            }
        },
      "info" : false,
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "autoWidth": false
    });
  });
</script>          
<script>
  // When the delete button is clicked, prevent the form from submitting immediately
  document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault(); // Prevent form submission
      Swal.fire({
        title: 'آیامطمئن هستید؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بله!',
        cancelButtonText: 'بستن'
      }).then((result) => {
        if (result.isConfirmed) {
          // If confirmed, submit the form normally
          form.submit();
        }
      });
    });
  });
</script>
 @endsection