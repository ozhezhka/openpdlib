@extends('layouts.master')

@section('title')
{{trans('library.'.$dict)}}: {{$category->name}}
@stop

@section('content')

@if (sizeof($category->parents)>0)
<h3>{{trans('library.parent_categories')}}</h3>

        @foreach ($category->parents as $item)
                <a href="/{{$dict}}/{{$item->id}}">{{$item->name}}</a>&nbsp;
        @endforeach
@endif

@if (sizeof($category->children)>0)
<h3>{{trans('library.children_categories')}}</h3>

        @foreach ($category->children as $item)
                <a href="/{{$dict}}/{{$item->id}}">{{$item->name}}</a>&nbsp;
        @endforeach
@endif

@if (sizeof($category->elements)>0)
<h3>{{trans('library.'.$category->element().'s')}}</h3>

        @foreach ($category->elements as $item)
                <a 
href="/{{$category->element()}}/{{$item->id}}">{{$item->short_name()}}</a>&nbsp;<br/>
        @endforeach
@endif

@stop

