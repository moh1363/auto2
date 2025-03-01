@extends('Layouts.dashboard')
@section('title')
    {{__('users.index')}}
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
    <form  method="POST" action="{{route('posttitle.store')}}">
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
            <div class="form-group">
                <label for="inputName">{{__('posttitle.title')}}</label>
                <input type="text" class="form-control" name="title" id="inputName" placeholder="{{__('posttitle.title')}}">
            </div>
            <div class="form-select ">
                <label for="inputFamily">{{__('posttitle.Hierarchy_id')}}</label>
                <select name="Hierarchy_id" class="form-select">
                    <option value="">ندارد </option>
                    @foreach($posttitles as $posttitle)
                    <option value="{{$posttitle->id}}">{{$posttitle->title}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('submit')}}</button>
    </form>
</div>
                                          </div>
                    
                </div>
@endsection