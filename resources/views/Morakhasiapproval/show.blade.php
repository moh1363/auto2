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
              <h3 class="card-title">{{__('users.index')}}
                <span style="float: left" class="badge badge-success">{{__('users.mande_morakhasi')}}  : {{$user->mande_morakhasi}}{{__('day')}} </span>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                                @include('Layouts.messages')

                <form  method="POST" action="{{route('approval.update',$morakhasiApproval->id)}}" >
                    @method('PUT')
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
                        <input disabled value="{{$morakhasiApproval->morakhasi->days_number}}" type="text" class=" col-xl-3 rounded" name="days_number"  value="{{old('days_number')}}"><span>روز مرخصی</span>
                        <input disabled value="{{$morakhasiApproval->morakhasi->type}}" type="text" class=" col-xl-3 rounded" name="type"  value="{{old('days_number')}}">
                        <span>اینجانب</span>
                        <input  hidden name="user_id">
                        <input disabled value="{{$user->firstname}}{{$user->lastname}}" class="col-xl-3 rounded" value="{{auth()->user()->firstname}}{{auth()->user()->lastname}}">

                    </div>
                    <br>
                    <div class="form-inline col-md-12 mb4" >
                        <input disabled class="col-xl-3 rounded" value="{{$user->personnel_id}}" name="personnel_id" hidden>
                        <span>پرسنلی شماره</span>
                        <input disabled class="col-xl-2 rounded" value="{{auth()->user()->personnel_id}}" >
                        <span>ازتاریخ</span>
                        <input disabled value="{{$morakhasiApproval->morakhasi->start_date}}" class="col-xl-4 rounded" type="text"   name="start_date">
                        <span>تا</span>
                        <input disabled value="{{$morakhasiApproval->morakhasi->end_date}}" class="col-xl-4 rounded"  type="text"   name="end_date">
                    </div>
                    <div class="form-inline col-md-12 mb4"  style="padding-top: 20px">

                        <p>موافقت نمایید</p>

                    </div>
                    <hr>
                    <div class="col-md-12">
                        <label for="contact_info" class="form-label">{{__('morakhasi.comments')}}</label><br>

                        <textarea disabled name="comments" style="width: 100%;">{{$morakhasiApproval->morakhasi->comments}} </textarea>

                    </div>
                    <div class="card col-md-12">
                        <div class="card-header">
                            <h4>ضمائم</h4>
                        </div>
                        <div class="card-body">
                    @if(count($files) > 0)
                        @foreach($files as $file)
                            @php
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            @endphp

                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                <!-- نمایش تصویر -->
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/'. $file) }}" target="_blank"><img src="{{ asset('storage/'. $file) }}" alt="تصویر مرخصی" class="img-thumbnail" width="150"></a>
                                    </div>
                            @else
                                <!-- نمایش لینک دانلود برای فایل‌های دیگر -->
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-sm btn-primary">
                                            دانلود فایل
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <span class="text-muted">فایلی آپلود نشده است</span>
                        @endif
                    </div>
                    </div>

                    <hr>
                    <div class="card">
                    <div class="card-header">
                    <h3>نظر مدیریت محترم گروه : </h3>
                    </div>
                    <div class="card-body col-md-8">
                       <select class="form-group" name="status">
                           <option value="approved">موافقت می گردد</option>
                           <option value="rejected">موافقت نمی گردد</option>
                       </select>
                       <div class="col-md-12">
                        <label for="contact_info" class="form-label">{{__('morakhasi.comments')}}</label><br>

                        <textarea  name="comments" style="width: 100%;"></textarea>

                    </div>
                    </div>
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
