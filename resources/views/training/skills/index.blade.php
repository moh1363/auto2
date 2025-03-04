@extends('Layouts.dashboard')
@section('title')
    {{__('skills.manager')}}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1> {{__('skills.manager')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#">خانه</a></li>
                            <li class="breadcrumb-item active"> {{__('skills.manager')}}</li>

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
                            <h3 class="card-title">{{__('skills.manager')}}</h3>
                            @include('Layouts.messages')

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <h2 class="mb-3">{{__('skills.manager')}}</h2>

                            <!-- Add Skill Form -->
                            <form id="skillForm">
                                <input type="hidden" id="skill_id">
                                <div class="mb-2">
                                    <input type="text" id="title" class="form-control" placeholder="{{__('skills.title')}}" required>
                                </div>
                                <div class="mb-2">
                                    <textarea id="description" class="form-control" placeholder="{{__('skills.description')}}" ></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">{{__('create')}}</button>
                            </form>

                            <!-- Skill List -->
                            <table class="table mt-4">
                                <thead>
                                <tr>
                                    <th>{{__('row')}}</th>
                                    <th>{{__('skills.title')}}</th>
                                    <th>{{__('skills.description')}}</th>
                                    <th>{{__('actions')}}</th>
                                </tr>
                                </thead>
                                <tbody id="skillTable"></tbody>
                            </table>

                            <!-- Bootstrap Modal for Editing -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">{{__('edit')}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editSkillForm">
                                                <input type="hidden" id="edit_skill_id">
                                                <div class="mb-2">
                                                    <input type="text" id="edit_title" class="form-control" placeholder="{{__('skills.title')}}" required>
                                                </div>
                                                <div class="mb-2">
                                                    <textarea id="edit_description" class="form-control" placeholder="{{__('skills.description')}}" ></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">{{__('edit')}}</button>
                                            </form>
                                        </div>
                                    </div>
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
        $(document).ready(function() {
            fetchSkills();

            function fetchSkills() {
                $.get('/skillsfetch', function(data) {
                    let rows = '';
                    data.forEach(skill => {
                        rows += `<tr>
                            <td>${skill.id}</td>
                            <td>${skill.title}</td>
                            <td>${skill.description}</td>
                            <td>
                                <button class="btn btn-primary btn-sm edit" data-id="${skill.id}" data-title="${skill.title}" data-description="${skill.description}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm delete" data-id="${skill.id}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;
                    });
                    $('#skillTable').html(rows);
                });
            }

            $('#skillForm').submit(function(e) {
                e.preventDefault();
                let id = $('#skill_id').val();
                let skill = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    title: $('#title').val(),
                    description: $('#description').val()
                };
                let method = id ? 'PUT' : 'POST';
                let url = id ? `/skills/${id}` : '/skills';

                $.ajax({
                    url: url,
                    type: method,
                    data: skill,
                    success: function() {
                        Swal.fire({
                            icon: 'success',
                            title: id ? 'با موفقیت آپدیت گردید!' : 'با موفقیت ایجاد گردید!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#skillForm')[0].reset();
                        $('#skill_id').val('');
                        fetchSkills();
                    }
                });
            });

            // Open Edit Modal with Existing Data
            $(document).on('click', '.edit', function() {
                $('#edit_skill_id').val($(this).data('id'));
                $('#edit_title').val($(this).data('title'));
                $('#edit_description').val($(this).data('description'));
                $('#editModal').modal('show');
            });

            // Handle Edit Form Submission
            $('#editSkillForm').submit(function(e) {
                e.preventDefault();
                let id = $('#edit_skill_id').val();
                let skill = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    title: $('#edit_title').val(),
                    description: $('#edit_description').val()
                };

                $.ajax({
                    url: `/skills/${id}`,
                    type: 'PUT',
                    data: skill,
                    success: function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'با موفقیت آپدیت گردید!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#editModal').modal('hide');
                        fetchSkills();
                    }
                });
            });

            // Delete Skill with Confirmation
            $(document).on('click', '.delete', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'آیا مطمئن هستید؟',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'بله!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/skills/${id}`,
                            type: 'DELETE',
                            data: { _token: $('meta[name="csrf-token"]').attr('content') },
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted Successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                fetchSkills();
                            }
                        });
                    }
                });
            });
        });
    </script>



@endsection
