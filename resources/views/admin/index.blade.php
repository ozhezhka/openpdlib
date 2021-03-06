@extends('layouts.master')

@section('title')
{{trans('admin.console')}}
@stop

@section('content')

{{--<a  href="/admin/devel"><h3 class="form-signin-heading">{{trans('admin.devel_management')}}</h3></a> --}}

<h3 class="form-signin-heading">{{trans('admin.user_management')}}</h3>

<ul>

<li><a href="/admin/user">{{trans('admin.reg_users')}}</a></li>

<li><a href="/admin/user/create">{{trans('admin.add_user')}}</a></li>

<li>{{trans('admin.find_user')}}<br/>

{{ $message or '' }}

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/admin/user/find', 'class'=>'form-signin', 'method'=>'post')) !!}
<b>ID</b>{!!Form::text('id','',array('class'=>'form-control'))!!}
<b>Email</b>{!! Form::email('email','',array('class'=>'form-control')) !!}
{!! Form::submit(trans('total.find'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}
{!! Form::close() !!}
</li>

</ul>



@stop
