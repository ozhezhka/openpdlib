@extends('layouts.master')

@section('title')
{{trans('library.'.$dictionary)}}
@stop

@section('content')

@foreach ($itemsalpha as $firstletter=>$items)

<h3>{{$firstletter}}</h3>

<ul>
@forelse ($items as $item)

<li> <a href="/{{$dictionary}}/{{$item->id}}">{{ $item->name }}</a>
</li>

@empty

@endforelse

</ul>

@endforeach

@stop
