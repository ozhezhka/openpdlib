@extends('layouts.master')

@section('title')
{{ $user->name }}
@stop

@section('content')

<script>

  function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }

</script>

<ul>

<li><b>ID</b>: {{ $user->id }}</li> 
<li><b>{{trans('user.name')}}</b>: {{ $user->name }}</li> 
<li><b>Email</b>: {{ $user->email }}</li> 
<li><b>{{trans('user.status')}}</b>: {{ trans("user.".$user->status) }}</li> 
<li><b>{{trans('user.created_at')}}</b>: {{ $user->created_at }}</li> 
<li><b>{{trans('user.updated_at')}}</b>: {{ $user->updated_at }}</li> 

</ul>

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/admin/user/'.$user->id, 'method'=>'delete', 'class'=>'form-signin','onsubmit' => 'return ConfirmDelete()')) !!}
<a href="/admin/user/{{$user->id}}/edit" class="btn btn-lg btn-primary btn-block"> {{trans('admin.edit_user')}} </a>
{!! Form::submit(trans('admin.delete_user'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}
{!! Form::close() !!}



@stop

