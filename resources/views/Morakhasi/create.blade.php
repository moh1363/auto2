@extends('Layouts.dashboard')
@section('title')
    {{__('morakhasi.create')}}
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> {{__('morakhasi.form')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active"> {{__('morakhasi.form')}}</li>
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
              <h3 class="card-title">{{__('morakhasi.form')}}
                <span style="float: left" class="badge badge-success">{{__('users.mande_morakhasi')}} شما : {{$mande_morakhasi}}{{__('day')}} </span>

              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                                @include('Layouts.messages')

    <form  method="POST" action="{{route('morakhasi.store')}}" enctype="multipart/form-data">
    @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
        @csrf
        <div class="form-inline col-md-12 mb-4" >
            <h3>{{__('morakhasi.tomanager')}} </h3>
        </div>
        <div class="form-inline col-md-12 mb4" >
                <span>خواهشمنداست با </span>
                <input type="text" class=" col-xl-3 rounded" name="days_number"  value="{{old('days_number')}}"><span>روز مرخصی</span>
                <select name="type" class="col-xl-3 rounded">
                    <option>استحقاقی</option>
                    <option>استعلاجی</option>
                    <option>بدون حقوق</option>
                </select>
                <span>اینجانب</span>
                <input value="{{auth()->user()->id}}" hidden name="user_id">
                <input class="col-xl-3 rounded" value="{{auth()->user()->firstname}}{{auth()->user()->lastname}}">

            </div>
        <br>
        <div class="form-inline col-md-12 mb4" >
            <input class="col-xl-3 rounded" value="{{auth()->user()->personnel_id}}" name="personnel_id" hidden>
            <span>پرسنلی شماره</span>
            <input class="col-xl-2 rounded" value="{{auth()->user()->personnel_id}}" >
            <span>ازتاریخ</span>
            <input class="col-xl-4 rounded" type="text"  data-jdp name="start_date">
            <span>تا</span>
            <input class="col-xl-4 rounded"  type="text"  data-jdp name="end_date">
        </div>
        <div class="form-inline col-md-12 mb4"  style="padding-top: 20px">

        <p>موافقت نمایید</p>

        </div>
        <hr>
        <div class="col-md-12">
            <label for="contact_info" class="form-label">{{__('morakhasi.comments')}}</label><br>

            <textarea name="comments" style="width: 100%;"> </textarea>

        </div>
    <hr>
        <div class="col-md-8">
            <label for="files" class="form-label">آپلود فایل‌ها</label>
            <input type="file" name="files[]" class="form-control" multiple>
        </div>

<hr>
        <button type="submit" class="btn btn-primary">{{__('submit')}}</button>
    </form>
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

@endsection
