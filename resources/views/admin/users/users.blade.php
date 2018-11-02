@extends('layouts.master')

@section('title')
{{trans('admin.reg_users')}}
@stop

@section('content')

<ul>
@forelse ($users as $user)

<li><a href="/admin/user/{{$user->id}}">{{ $user->name }}</a> ({{ $user->email }}), {{$user->status}}, 
{{trans('user.created_at')}} {{$user->created_at}}</li>

@empty

@endforelse
</ul>

@stop
