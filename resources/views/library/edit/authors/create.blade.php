@extends('layouts.master')

@section('title')
{{trans('library.new_author')}}
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


{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/author', 'class'=>'form-signin')) !!}

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif


	<b>{{ trans('library.author_name') }}</b> {!! Form::text('name',old('name'),array('class'=>'form-control', 'required'=>'true')) !!} 
	<b>{{ trans('library.patronimic') }}</b> {!! Form::text('patronimic',old('patronimic'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.surname') }}</b> {!! Form::text('surname',old('surname'),array('class'=>'form-control', 'required'=>'true')) !!} 
	<b>{{ trans('library.WD') }}</b> {!! Form::text('WD',old('WD'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.birth_year') }}</b> {!! Form::text('birth_year',old('birth_year'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.death_year') }}</b> {!! Form::text('death_year',old('death_year'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.repressed') }}</b> {!! Form::checkbox('repressed',1,old('repressed'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.rehabilitated_year') }}</b> {!! Form::text('rehabilitated_year',old('rehabilitated_year'),array('class'=>'form-control')) !!} 

        <b>{{ trans('library.categories') }}</b> {!! Form::text('category','',array('id'=>'category','class'=>'form-control')) !!}
        <div id=categories></div>


	{!! Form::submit(trans('library.add'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}

{!! Form::close() !!}

@stop
