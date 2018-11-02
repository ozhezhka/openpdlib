@extends('layouts.master')

@section('title')
{{trans('library.'.$dictionary)}}: {{trans('library.edit_item')}}
@stop

@section('content')

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/'.$dictionary.'/'.$item->id, 'class'=>'form-signin', 'method'=>'put')) 
!!}

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif


	<b>{{ trans('library.name') }}</b> {!! Form::text('name',$item->name,array('class'=>'form-control', 'required'=>'true')) !!} 
	@if ($is_descr)
	<b>{{ trans('library.descr') }}</b> {!! Form::textarea('descr',$item->descr,array('class'=>'form-control')) !!} 
	@endif
	{!! Form::submit(trans('library.save'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}

{!! Form::close() !!}

@stop
