@extends('layouts.master')

@section('title')
{{trans('library.books')}}
@stop

@section('content')

@include('library.books.booklist')

@stop
