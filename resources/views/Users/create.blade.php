@extends('Layouts.dashboard')
@section('title')
    {{__('users.create')}}
@endsection
@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                            {{__('users.create')}}
                         
                            </header>
                            <div class="container mt-5">
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
                <input type="text" class="form-control" name="firstname" id="inputName" placeholder="Name">
            </div>
            <div class="form-group col-md-6">
                <label for="inputFamily">{{__('users.lastname')}}</label>
                <input type="text" class="form-control" name="lastname" id="inputFamily" placeholder="Family">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputTitle">{{__('users.title')}}</label>
                <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Title">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPhone">{{__('users.email')}}</label>
                <input type="tel" name="email" class="form-control"  id="inputPhone" placeholder="Phone">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">{{__('users.phone')}}</label>
                <input type="text" class="form-control"  name="phone" id="inputName" placeholder="Name">
            </div>
            <div class="form-group col-md-6">
                <label for="inputFamily">{{__('users.personnel_id')}}</label>
                <input type="text" class="form-control" name="personnel_id" id="inputFamily" placeholder="Family">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('submit')}}</button>
    </form>
</div>
                                          </div>
                    
                </div>
@endsection