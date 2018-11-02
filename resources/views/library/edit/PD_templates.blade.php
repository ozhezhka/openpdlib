@extends('layouts.master')

@section('title')
{{trans('library.PD_templates')}}
@stop

@section('content')

<ul>
@forelse ($PD_templates as $PD_template)

<li>{{ $PD_template->name }} </li>

@empty

@endforelse
</ul>

@stop
