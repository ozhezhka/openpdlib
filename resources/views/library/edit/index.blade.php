@extends('layouts.master')

@section('title')
{{trans('library.library_edit')}}
@stop

@section('content')

<h3 class="form-signin-heading">{{trans('library.authors')}}</h3>

<ul>

<li><a href="/library/edit/author">{{trans('library.authors')}}</a></li>

<li><a href="/library/edit/author/create">{{trans('library.new_author')}}</a></li>

<li>{{trans('library.find_author')}}<br/>

{{ $message or '' }}

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/author/find', 'class'=>'form-signin', 'method'=>'post')) !!}
<b>{{trans('library.surname')}}</b><br>{!!Form::text('surname','',array('class'=>'form-control'))!!}
{!! Form::submit(trans('total.find'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}
{!! Form::close() !!}
</li>

</ul>

<h3 class="form-signin-heading">{{trans('library.books')}}</h3>

<ul>

<li><a href="/library/edit/book">{{trans('library.books')}}</a></li>

<li><a href="/library/edit/book/create">{{trans('library.new_book')}}</a></li>

<li>{{trans('library.find_book')}}<br/>

{{ $message or '' }}

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/book/find', 'class'=>'form-signin', 'method'=>'post')) !!}
<b>{{trans('library.book_name')}}</b>{!!Form::text('name','',array('class'=>'form-control'))!!}
{!! Form::submit(trans('total.find'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}
{!! Form::close() !!}
</li>

</ul>

<h3 class="form-signin-heading">{{trans('library.sprav')}}</h3>

<ul>
<li><a href="/library/edit/PD_template">{{trans('library.PD_template')}}</a></li>
<li><a href="/library/edit/ACategory">{{trans('library.ACategory')}}</a></li>
<li><a href="/library/edit/BCategory">{{trans('library.BCategory')}}</a></li>
</ul>

@stop
