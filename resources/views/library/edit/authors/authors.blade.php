@extends('layouts.master')

@section('title')
{{trans('library.authors')}}
@stop

@section('content')

<ul>
@forelse ($authors as $author)

<li><a href="/library/edit/author/{{$author->id}}">{{ $author->surname }} {{ $author->name }} {{ $author->patronimic }}</a> ({{ $author->birth_year }} - {{$author->death_year}}) 
       <span class="badge">
        <a  class="badge" href="/library/edit/author/{{$author->id}}/edit"><span class="glyphicon glyphicon-pencil"></span></a>
        <a  class="badge" href="/library/edit/author/{{$author->id}}/delete"><span class="glyphicon glyphicon-remove"></span></a>
        </span>
</li>

@empty

@endforelse
</ul>

@stop
