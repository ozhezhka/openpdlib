@extends('layouts.master')

@section('title')
{{trans('admin.add_user')}}
@stop

@section('content')

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/admin/user', 'class'=>'form-signin')) !!}

        <h2 class="form-signin-heading">{{trans('user.register')}}</h2>

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

	<b>{{ trans('user.name') }}</b> {!! Form::text('name',old('name'),array('class'=>'form-control', 'required'=>'true')) !!} 
	<b>{{ trans('user.email') }}</b> {!! Form::email('email',old('email'),array('class'=>'form-control', 'required'=>'true')) !!} 

	<b>{{ trans('user.status') }}</b> {!! Form::select('status',$user_status_list) !!}
	<br><b>{{ trans('user.password') }}</b> {!! Form::input('password','password',null,array('class'=>'form-control', 'required'=>'true')) !!} 
	<b>{{ trans('user.password_confirmation') }}</b> {!! Form::input('password','password_confirmation',null,array('class'=>'form-control', 'required'=>'true')) !!} 
	{!! Form::submit(trans('user.register'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}

{!! Form::close() !!}

@stop
