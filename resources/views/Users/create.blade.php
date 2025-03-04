@extends('Layouts.dashboard')
@section('title')
    {{__('users.create')}}
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

                                @include('Layouts.messages')

    <form  method="POST" action="{{route('users.store')}}">
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
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">{{__('users.firstname')}}</label>
                <input type="text" class="form-control" name="firstname" id="inputName" value="{{old('firstname')}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputFamily">{{__('users.lastname')}}</label>
                <input type="text" class="form-control" name="lastname" id="inputFamily" value="{{old('lastname')}}" >
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
            <label>{{__('posttitle.title')}}</label>
            <select name="post_title_id" class="form-control select2" style="width: 100%;" value="{{old('post_title_id')}}">

                @foreach($posttitles as $posttitle)
                <option value="{{$posttitle->id}}">{{$posttitle->title}}</option>
                @endforeach
</select>
        </div>
            <div class="form-group col-md-6">
                <label for="inputPhone">{{__('users.email')}}</label>
                <input type="tel" name="email" class="form-control"  id="inputPhone" value="{{old('email')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">{{__('users.phone')}}</label>
                <input type="number" class="form-control"  name="phone" id="inputName" value="{{old('phone')}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputFamily">{{__('users.personnel_id')}}</label>
                <input type="number" class="form-control" name="personnel_id" id="inputFamily" value="{{old('personnel_id')}}">
            </div>

        </div>
        <div class="form-row">

          <div class="form-group col-md-6">
              <label for="inputFamily">{{__('users.mande_morakhasi')}}</label>
              <input type="number" class="form-control" name="mande_morakhasi" id="inputFamily" value="{{old('mande_morakhasi')}}">
          </div>

      </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select name="roles[]" class="form-control" multiple="multiple">
                    @foreach ($roles as $value => $label)
                        <option value="{{ $value }}">
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                    @foreach ($permissions as $permission)
                    <input name="permissions[]" class="form-control" type="checkbox" value="{{ $permission->id }}"> <strong>{{ $permission->name }}</strong>

                                  @endforeach
            </div>
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
