@extends('Layouts.dashboard')
@section('title')
    {{__('posttitle.index')}}
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('posttitle.title')}}</th>
                <th>{{__('posttitle.parent_id')}}</th>
                <th>{{__('actions')}}</th>
            </tr>
        </thead>
        <tbody id="postTable"></tbody>
    </table>
    <div class="card">
           
           <div class="card-body">
           <button class="btn btn-primary mb-3" id="addNew">{{__('posttitle.create')}}</button>
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
  <!-- Save Modal (For Creating New Post) -->
  <div class="modal fade" id="saveModal">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{__('posttitle.create')}}</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>{{__('posttitle.title')}}</label>
            <input type="text" id="save_title" class="form-control" placeholder="Enter title" />
          </div>
          <div class="form-group">
            <label>{{__('posttitle.parent_id')}}</label>
            <select class="form-control select2" style="width: 100%;" id="save_parent_id" name="parent_id">
            <option value="">ندارد</option>
            
                @foreach($posttitles as $posttitle)
                <option value="{{$posttitle->id}}">{{$posttitle->title}}</option>
                @endforeach
</select>
            <!-- <input type="number" id="save_parent_id" class="form-control" placeholder="Enter parent id" /> -->

        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="savePost">{{__('create')}}</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal (For Editing Existing Post) -->
  <div class="modal fade" id="editModal">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{__('posttitle.edit')}}</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- Hidden field to store the post id -->
          <input type="hidden" id="edit_post_id" >
          <input type="hidden" id="allpost" value="{{$posttitles}}">
          <div class="form-group">
            <label>Title</label>
            <input type="text" id="edit_title" class="form-control" placeholder="Enter title" />
          </div>
          <div class="form-group">
            <label>{{__('posttitle.title')}}</label>
            <select class="form-control select2" style="width: 100%;" name="parent_id" id="edit_parent_id">
            <option value="">ندارد</option>
            
                @foreach($posttitles as $posttitle)
                <option value="{{$posttitle->id}}">{{$posttitle->title}}</option>
                @endforeach
</select>
            <!-- <input type="number" id="save_parent_id" class="form-control" placeholder="Enter parent id" /> -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="updatePost">{{__('edit')}}</button>
        </div>
      </div>
    </div>
  </div>


    <script>
        $(document).ready(function () {
            fetchPosts();

            function fetchPosts() {
                $.get("/fetch", function (data) {
                    let rows = "";
                    data.posts.forEach(post => {

                        rows += `<tr>
                            <td>${post.title}</td>
                            <td>${post.parent ? post.parent.title : 'No profile'}</td>
                            <td>
                                <button class="btn btn-warning btn-edit" data-id="${post.id}" data-title="${post.title}" data-parent="${post.parent_id}">Edit</button>
                                <button class="btn btn-danger btn-delete" data-id="${post.id}">Delete</button>
                            </td>
                        </tr>`;
                    });
                    $("#postTable").html(rows);
                });
            }

            

      $("#addNew").click(function () {
        clearSaveModal();
        $("#saveModal").modal("show");
      });

      // AJAX for saving a new post
      $("#savePost").click(function () {
        let title = $("#save_title").val();
        let parent_id = $("#save_parent_id").val();
        console.log(parent_id)

        $.ajax({
          url: "/post-titles/",
          type: "POST",
          data: {
            title: title,
            parent_id: parent_id,
            _token: "{{ csrf_token() }}"
          },
          success: function (response) {
            Swal.fire("Success", response.message, "success");
            $("#saveModal").modal("hide");
            fetchPosts();
          },
          error: function(xhr) {
            Swal.fire("Error", "There was an error saving the post.", "error");
          }
        });
      });

      // Clear Save modal when closed
      $("#saveModal").on("hidden.bs.modal", function () {
        clearSaveModal();
      });

      // Function to clear Save modal fields
      function clearSaveModal() {
        $("#save_title").val("");
        $("#save_parent_id").val("");
      }

      // --------------------
      // EDIT EXISTING POST Modal
      // --------------------

      // Open the Edit modal when clicking Edit button
      $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");
        let title = $(this).data("title");
        let parent = $(this).data("parent");
        let allpost = $(this).data("allpost");
        console.log(parent);

        allpost
        $("#edit_post_id").val(id);
        $("#edit_title").val(title);
        $("#edit_parent_id").val(parent);
        $("#editModal").modal("show");
        $("#edit_parent_id option[value='" + parent + "']").attr("selected","selected");

      });

      // AJAX for updating an existing post
      $("#updatePost").click(function () {
        let id = $("#edit_post_id").val();
        let title = $("#edit_title").val();
        let parent_id = $("#edit_parent_id").val();
        console.log(parent);

        $.ajax({
          url: "/post-titles/" + id,
          type: "PUT",
          data: {
            title: title,
            parent_id: parent_id,
            _token: "{{ csrf_token() }}"
          },
          success: function (response) {
            Swal.fire("Success", response.message, "success");
            $("#editModal").modal("hide");
            fetchPosts();
          },
          error: function(xhr) {
            Swal.fire("Error", "There was an error updating the post.", "error");
          }
        });
      });

      // Clear Edit modal when closed
      $("#editModal").on("hidden.bs.modal", function () {
        clearEditModal();
      });

      // Function to clear Edit modal fields
      function clearEditModal() {
        $("#edit_post_id").val("");
        $("#edit_title").val("");
        $("#edit_parent_id").val("");
      }


            $(document).on("click", ".btn-delete", function () {
                let id = $(this).data("id");
                Swal.fire({
                    title: "آیا مطمئن هستید؟",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "بله",
                    cancelButtonText:"بستن"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/post-titles/${id}`,
                            type: "DELETE",
                            data: { _token: "{{ csrf_token() }}" },
                            success: function (response) {
                                Swal.fire("Deleted!", response.message, "success");
                                fetchPosts();
                            }

                        });
                    }
                });
            });
        });
    </script>

@endsection
