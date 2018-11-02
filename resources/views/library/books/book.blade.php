@extends('layouts.master')

@section('title')
{{trans('library.book')}}
@stop

@section('content')

        <b>{{ trans('library.authors') }}:</b> 
	@foreach ($book->authors as $author)
		<a href="/author/{{$author->id}}" target="_blank">{{$author->short_name()}}</a>&nbsp;</a>
	@endforeach
	<br/>

	<b>{{ trans('library.book_name') }}:</b> {{ $book->name }}<br/> 
	<b>{{ trans('library.book_name_orig') }}:</b> {{$book->name_orig}}<br/>
	<b>{{ trans('library.location') }}:</b> {{$book->location}}<br/>
	<b>{{ trans('library.publisher') }}:</b> {{$book->publisher}}<br/>
	<b>{{ trans('library.year') }}:</b> {{$book->year}}<br/>
	<b>{{ trans('library.volume') }}:</b> {{$book->volume}}<br/>
	<b>{{ trans('library.pages') }}:</b> {{$book->pages}} {{trans('library.p')}}<br/>
	<b>{{ trans('library.terach') }}:</b> {{$book->terach}}<br/>
	<b>{{ trans('library.year_firstpub') }}:</b> {{$book->year_firstpub}}<br/>
	<b>{{ trans('library.annotation') }}:</b> {{$book->annotation}}<br/>
	<b>{{ trans('library.PD_from_year') }}:</b> {{$book->PD_from_year}}<br/>
	<b>{{ trans('library.PD_template') }}:</b> {{($book->PD_template!=null?$book->PD_template->name:"")}}<br/>
        <b>{{ trans('library.WD') }}:</b> {{$book->WD}}<br/>
	<b>{{ trans('library.file') }}:</b> <a href="/book/{{$book->id}}/download">{{ $book->filename }}</a>  <br/>


        <b>{{ trans('library.categories') }}:</b> 
	@foreach ($book->categories as $category)
		<a href="/BCategory/{{$category->id}}">{{$category->name}}</a>&nbsp;
	@endforeach


@stop
