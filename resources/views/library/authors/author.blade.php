@extends('layouts.master')

@section('title')
{{trans('library.author')}}
@stop

@section('content')


	<b>{{ trans('library.author_name') }}:</b> {{$author->name}}<br/>
	<b>{{ trans('library.patronimic') }}:</b> {{$author->patronimic}}<br/>
	<b>{{ trans('library.surname') }}:</b> {{$author->surname}}<br/>
	<b>{{ trans('library.WD') }}:</b> {{$author->WD}}<br/>
	<b>{{ trans('library.birth_year') }}:</b> {{$author->birth_year}}<br/>
	<b>{{ trans('library.death_year') }}:</b> {{$author->death_year}}<br/>
	<b>{{ trans('library.repressed') }}:</b> {{$author->repressed>""?trans('total.'.$author->repressed):""}}<br/>
	<b>{{ trans('library.rehabilitated_year') }}:</b> {{$author->rehabilitated_year}}<br/>

        <b>{{ trans('library.categories') }}:</b> 
        @foreach ($author->categories as $category)
                <a href="/ACategory/{{$category->id}}">{{$category->name}}</a>
        @endforeach

	@if (sizeof($author->books)>0)
	<h3>{{  trans('library.books') }}</h3>

        @foreach ($author->books as $book)
                <a href="/book/{{$book->id}}">{{$book->short_name()}}</a>&nbsp;<br/>
        @endforeach
	@endif

@stop
