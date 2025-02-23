@extends('Layouts.dashboard')
@section('title')
    {{__('users.index')}}
@endsection
@section('content')
<div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                            {{__('users.index')}}
                         
                            </header>
                            <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>{{__('users.firstname')}}</th>
                                        <th >{{__('users.lastname')}}</th>
                                        <th>{{__('users.title')}}</th>
                                        <th>{{__('action')}}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$users)
                                    <tr col-span="4">
                                        <td >{{__('noitem')}}</td>
                                        @else
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->firstname}}</td>
                                        <td>{{$user->lastname}}</td>
                                        <td>{{$user->title}}</td>
                                        <td></td>
                                        @endforeach
                                        @endif

</tr>
</tbody>

                            </table>
                            <hr>
                            
                        </section>
                    </div>
                    <div class="col-lg-12">

<a href="{{route('users.create')}}" class="btn btn-primary">{{__('users.create')}}</a>
</div>
                </div>
@endsection