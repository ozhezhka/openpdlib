@extends('layouts.master')

@section('title')
{{trans('library.author')}}
@stop

@section('content')

<script language="JavaScript">

$(document).ready(function()
{
        $( "#category" ).autocomplete({
          source: "/library/edit/ACategory/autocomplete",
          minLength: 1,
          select: function(event, ui) {
                var new_category_row =
                "<div id='row"+ui.item.id+"'>"+
                ui.item.value+"&nbsp;"+
                "<a class='badge'><span class='glyphicon glyphicon-remove' onclick='deleteField("+ui.item.id+")'></span></a>"+
                "<input type='hidden' name='category_id[]' value='"+ui.item.id+"'>"+
                "</div>";

                $('#categories').append(new_category_row);
          }
        });

        $( "#category" ).click(function () {
            $("#category").val("");
        });
});

function deleteField (id) {
          $("#row"+id).remove();
}


</script>


{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/author/'.$author->id, 'class'=>'form-signin', 'method'=>'put')) !!}

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif


	<b>{{ trans('library.author_name') }}</b> {!! Form::text('name',$author->name,array('class'=>'form-control', 'required'=>'true')) !!} 
	<b>{{ trans('library.patronimic') }}</b> {!! Form::text('patronimic',$author->patronimic,array('class'=>'form-control')) !!} 
	<b>{{ trans('library.surname') }}</b> {!! Form::text('surname',$author->surname,array('class'=>'form-control', 'required'=>'true')) !!} 
	<b>{{ trans('library.WD') }}</b> {!! Form::text('WD',$author->WD,array('class'=>'form-control')) !!} 
	<b>{{ trans('library.birth_year') }}</b> {!! Form::text('birth_year',$author->birth_year,array('class'=>'form-control')) !!} 
	<b>{{ trans('library.death_year') }}</b> {!! Form::text('death_year',$author->death_year,array('class'=>'form-control')) !!} 
	<b>{{ trans('library.repressed') }}</b> &nbsp;&nbsp;{!! Form::checkbox('repressed',1,$author->repressed) !!} <br/>
	<b>{{ trans('library.rehabilitated_year') }}</b> {!! Form::text('rehabilitated_year',$author->rehabilitated_year,array('class'=>'form-control')) !!} 

        <b>{{ trans('library.categories') }}</b> {!! Form::text('category','',array('id'=>'category','class'=>'form-control')) !!}
        <div id=categories>
        @foreach ($author->categories as $category)
                <div id="row{{$category->id}}">
                {{$category->name}}&nbsp;<a class="badge"><span class="glyphicon glyphicon-remove"  onclick='deleteField({{$category->id}})'></span></a>
                {!! Form::hidden('category_id[]',$category->id) !!}
                </div>
        @endforeach
        </div>


	{!! Form::submit(trans('library.save'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}

{!! Form::close() !!}

@stop
