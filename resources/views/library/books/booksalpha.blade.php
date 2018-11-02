@extends('layouts.master')

@section('title')
{{trans('library.books')}}
@stop

@section('content')

@foreach ($booksalpha as $firstletter=>$books)

<h3>{{$firstletter}}</h3>

@include('library.books.booklist')

@endforeach

@stop
