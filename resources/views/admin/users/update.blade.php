@extends('layouts.master')

@section('title')
{{trans('admin.edit_user')}}
@stop

@section('content')

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/admin/user/'.$user->id, 'class'=>'form-signin', 'method'=>'put')) !!}


        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

	<b>{{trans('user.name')}}</b> {!! Form::text('name',$user->name,array('class'=>'form-control', 
'required'=>'true')) !!} <br />
	<b>{{trans('user.email')}}</b> {!! Form::email('email',$user->email,array('class'=>'form-control', 'required'=>'true')) !!} <br />

	<b>{{trans('user.status')}}</b> {!! Form::select('status',$user_status_list,$user->status) !!} <br />
	<b>{{trans('user.password')}}</b> {!! Form::input('password','password',null,array('class'=>'form-control')) !!} <br />
	<b>{{trans('user.password_confirmation')}}</b> {!! Form::input('password','password_confirmation',null,array('class'=>'form-control')) !!} <br />
	{!! Form::submit(trans('total.save'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}

{!! Form::close() !!}

@stop
