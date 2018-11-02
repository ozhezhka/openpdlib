@extends('layouts.master')

@section('title')
{{trans('library.authors')}}
@stop

@section('content')

@foreach ($authorsalpha as $firstletter=>$authors)

<h3>{{$firstletter}}</h3>

<ul>
@forelse ($authors as $author)

<li><a href="/author/{{$author->id}}">{{ $author->surname }} {{ $author->name }} {{ $author->patronimic }}</a> ({{ $author->birth_year }} - {{$author->death_year}}) 
</li>

@empty

@endforelse
</ul>

@endforeach

@stop
