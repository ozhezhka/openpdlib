@extends('layouts.master')

@section('title')
{{trans('library.'.$dictionary)}}: {{trans('library.new_item')}}
@stop

@section('content')

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/'.$dictionary, 'class'=>'form-signin')) !!}

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif


	<b>{{ trans('library.name') }}</b> {!! Form::text('name',old('name'),array('class'=>'form-control', 'required'=>'true')) !!} 
	@if ($is_descr)
	<b>{{ trans('library.descr') }}</b> {!! Form::textarea('descr',old('descr'),array('class'=>'form-control')) !!} 
	@endif
	{!! Form::submit(trans('library.add'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}

{!! Form::close() !!}

@stop
