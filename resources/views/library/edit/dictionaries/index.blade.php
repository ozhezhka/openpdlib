@extends('layouts.master')

@section('title')
{{trans('library.'.$dictionary)}}
@stop

@section('content')

<ul>
@forelse ($items as $item)

@if (isset($id)&&$item->id==$id)

<li><a name="edit">{{trans('library.edit_item')}}</a></li>

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/'.$dictionary.'/'.$item->id, 'class'=>'form-signin', 
'method'=>'put'))!!}

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


@else

<li> <a href="/library/edit/{{$dictionary}}/{{$item->id}}">{{ $item->name }}</a>
       <span class="badge">
        <a class="badge" href="/library/edit/{{$dictionary}}/{{$item->id}}/edit#edit"><span class="glyphicon glyphicon-pencil"></span></a>
        <a class="badge" href="/library/edit/{{$dictionary}}/{{$item->id}}/delete"><span class="glyphicon glyphicon-remove"></span></a>
        </span>
</li>

@endif

@empty

@endforelse

<li>{{trans('library.new_item')}}</li>

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

</ul>

@stop
