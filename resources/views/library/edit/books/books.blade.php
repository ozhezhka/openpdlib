@extends('layouts.master')

@section('title')
{{trans('library.books')}}
@stop

@section('content')

<ul>
@forelse ($books as $book)


<li>@foreach($book->authors as $author)
{{ $author->short_name() }},
@endforeach
<a href="/library/edit/book/{{$book->id}}">{{ $book->name }}</a>. - {{ $book->location }}: {{ $book->publisher }},  
{{ $book->year }}. - {{ $book->pages }} {{trans("library.p")}}
        <span class="badge">
        <a class="badge" href="/library/edit/book/{{$book->id}}/edit"><span class="glyphicon glyphicon-pencil"></span></a>
        <a class="badge" href="/library/edit/book/{{$book->id}}/delete"><span class="glyphicon glyphicon-remove"></span></a>
        </span>
</li>

@empty

@endforelse
</ul>

@stop
