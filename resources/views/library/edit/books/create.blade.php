@extends('layouts.master')

@section('title')
{{trans('library.new_book')}}
@stop

@section('content')

<script language="JavaScript">

$(document).ready(function()
{	
	$( "#PD_template" ).autocomplete({
	  source: "/library/edit/PD_template/autocomplete",
	  minLength: 2,
	  select: function(event, ui) {
	  	$('#PD_template').val(ui.item.value);
	  }
	});

        $( "#author" ).autocomplete({
          source: "/library/edit/author/autocomplete",
          minLength: 1,
          select: function(event, ui) {
                var new_author_row =
                "<div id='row"+ui.item.id+"'>"+
                "<a href='/library/edit/author/"+ui.item.id+"' target='_blank'>"+ui.item.value+"</a>&nbsp;"+
                "<a class='badge'><span class='glyphicon glyphicon-remove' onclick='deleteField("+ui.item.id+")'></span></a>"+
                "<input type='hidden' name='author_id[]' value='"+ui.item.id+"'>"+
                "</div>";
                
                $('#authors').append(new_author_row);
          }  
        });   

	$( "#author" ).click(function () {
	    $("#author").val("");
	});


        $( "#category" ).autocomplete({
          source: "/library/edit/BCategory/autocomplete",
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



	$('#file').bind('change', function() {
	  let filesize = this.files[0].size // On older browsers this can return NULL.
	  let filesizeMB = (filesize / (1024*1024)).toFixed(2);

	  if(filesizeMB <= 130) {
	      // Allow the form to be submitted here.
	  } else {
	      // Don't allow submission of the form here.
		$('#file').val("");
		alert("{{ trans('library.file_too_big') }}"+filesizeMB+" MB");
	  }

	});


});

function deleteField (id) {
          $("#row"+id).remove();
}

</script>


{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/book', 'class'=>'form-signin', 'method'=>'post', 
'files'=>'true')) !!}

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif


        <b>{{ trans('library.authors') }}</b> {!! Form::text('author','',array('id'=>'author','class'=>'form-control')) !!}
        <div id=authors></div>

	<b>{{ trans('library.book_name') }}</b> {!! Form::text('name',old('name'),array('class'=>'form-control', 'required'=>'true')) !!} 
	<b>{{ trans('library.book_name_orig') }}</b> {!! Form::text('name_orig',old('name_orig'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.location') }}</b> {!! Form::text('location',old('location'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.publisher') }}</b> {!! Form::text('publisher',old('publisher'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.year') }}</b> {!! Form::text('year',old('year'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.volume') }}</b> {!! Form::number('volume',old('volume'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.pages') }}</b> {!! Form::number('pages',old('pages'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.terach') }}</b> {!! Form::text('terach',old('terach'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.year_firstpub') }}</b> {!! Form::text('year_firstpub',old('year_firstpub'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.annotation') }}</b> {!! Form::textarea('annotation',old('annotation'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.PD_from_year') }}</b> {!! Form::text('PD_from_year',old('PD_from_year'),array('class'=>'form-control')) !!} 
	<b>{{ trans('library.PD_template') }}</b> {!! Form::text('PD_template',old('PD_template'),array('id'=>'PD_template','class'=>'form-control')) !!} 
        <b>{{ trans('library.WD') }}</b> {!! Form::text('WD',old('WD'),array('class'=>'form-control')) !!}
	<b>{{ trans('library.file') }}</b> {!! Form::file('file',array('id'=>'file')) !!} 

        <b>{{ trans('library.categories') }}</b> {!! Form::text('category','',array('id'=>'category','class'=>'form-control')) !!}
        <div id=categories></div>


	{!! Form::submit(trans('library.add'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}

{!! Form::close() !!}

@stop
