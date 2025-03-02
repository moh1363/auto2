@extends('Layouts.dashboard')
@section('title')
    {{__('morakhasi.index')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1> {{__('morakhasi.index')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active"> {{__('morakhasi.index')}}</li>

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
                            <h3 class="card-title">{{__('morakhasi.index')}}</h3>
                            @include('Layouts.messages')

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th >{{__('morakhasi.user')}}</th>

                                    <th>{{__('morakhasi.start_date')}}</th>
                                    <th >{{__('morakhasi.end_date')}}</th>
                                    <th >{{__('morakhasi.days_number')}}</th>
                                    <th >{{__('action')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($approvals as $morakhasi)
                                    <tr>
                                        <td>@php
                                                $user=\App\Models\User::where('id',$morakhasi->morakhasi->user_id)->first();
                                            @endphp
                                            {{$user->firstname}}{{$user->lastname}}
                                        </td>
                                        <td>{{$morakhasi->morakhasi->start_date}}</td>
                                        <td>{{$morakhasi->morakhasi->end_date}}</td>
                                        <td>{{$morakhasi->morakhasi->days_number}}</td>

                                        <td> <a href="{{route('approval.show',$morakhasi->id)}}">show</a>

                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                            <div class="card">

                                <div class="card-body">
                                    <a href="{{route('morakhasi.create')}}" class="btn btn-primary">{{__('morakhasi.create')}}</a>
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
