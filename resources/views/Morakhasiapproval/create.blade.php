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
              <h3 class="card-title">{{__('users.index')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                                @include('Layouts.messages')

    <form  method="POST" action="{{route('morakhasi.store')}}">
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
            <div class="form-inline col-md-12" >
                <span>خواهشمنداست با </span>
                <input type="text" class="form-control" name="days_number"  value="{{old('days_number')}}"><span>روز مرخصی</span>
                <select name="type">
                    <option>استحقاقی</option>
                    <option>استعلاجی</option>
                    <option>بدون حقوق</option>
                </select>
                <span>اینجانب</span>
                <input value="{{auth()->user()->id}}" hidden name="user_id">
                <input value="{{auth()->user()->firstname}}{{auth()->user()->lastname}}">

            </div>
        <br>
        <div class="form-inline">
            <input value="{{auth()->user()->personnel_id}}" name="personnel_id" hidden>
            <span>پرسنلی شماره</span>
            <input value="{{auth()->user()->personnel_id}}" >
            <span>ازتاریخ</span>
            <input type="text"  data-jdp name="start_date">
            <span>تا</span>
            <input  type="text"  data-jdp name="end_date">
            <span>.موافقت نمایید</span>




        </div>
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
