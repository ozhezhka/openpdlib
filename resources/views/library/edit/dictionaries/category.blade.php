@extends('layouts.master')

@section('title')
{{trans('library.'.$dict)}}: {{$category->name}}
@stop

@section('content')

<script language="JavaScript">

$(document).ready(function()
{
         $( "#element" ).autocomplete({
          source: "/library/edit/{{$category->element()}}/autocomplete",
          minLength: 1,
          select: function(event, ui) {
                var new_element_row =
                "<div id='rowelement"+ui.item.id+"'>"+
                "<a href='/library/edit/{{$category->element()}}/"+ui.item.id+"' target='_blank'>"+ui.item.value+"</a>&nbsp;"+
                "<a class='badge'><span class='glyphicon glyphicon-remove' onclick='deleteElementField("+ui.item.id+")'></span></a>"+
                "<input type='hidden' name='element_id[]' value='"+ui.item.id+"'>"+
                "</div>";
          
                $('#elements').append(new_element_row);
           
          }
        });
         
        $( "#element" ).click(function () {
            $("#element").val("");
        });

         $( "#parent" ).autocomplete({
          source: "/library/edit/{{$dict}}/autocomplete",
          minLength: 1,
          select: function(event, ui) {
                var new_parent_row =
                "<div id='rowparent"+ui.item.id+"'>"+
                "<a href='/library/edit/{{$dict}}/"+ui.item.id+"' target='_blank'>"+ui.item.value+"</a>&nbsp;"+
                "<a class='badge'><span class='glyphicon glyphicon-remove' onclick='deleteParentField("+ui.item.id+")'></span></a>"+
                "<input type='hidden' name='parent_id[]' value='"+ui.item.id+"'>"+
                "</div>";
                
                $('#parents').append(new_parent_row);
           
          }
        });

        $( "#parent" ).click(function () {
            $("#parent").val("");
        });

         $( "#child" ).autocomplete({
          source: "/library/edit/{{$dict}}/autocomplete",
          minLength: 1,
          select: function(event, ui) {
                var new_child_row =
                "<div id='rowchild"+ui.item.id+"'>"+
                "<a href='/library/edit/{{$dict}}/"+ui.item.id+"' target='_blank'>"+ui.item.value+"</a>&nbsp;"+
                "<a class='badge'><span class='glyphicon glyphicon-remove' onclick='deleteChildField("+ui.item.id+")'></span></a>"+
                "<input type='hidden' name='child_id[]' value='"+ui.item.id+"'>"+
                "</div>";

                $('#children').append(new_child_row);

          }
        });
        
        $( "#child" ).click(function () {
            $("#child").val("");
        });


});

function deleteElementField (id) {
          $("#rowelement"+id).remove();
}

function deleteParentField (id) {
          $("#rowparent"+id).remove();
} 

function deleteChildField (id) {  
          $("#rowchild"+id).remove();
}

</script>

<h3 class="form-signin-heading">{{trans('library.parent_categories')}}</h3>

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/'.$dict.'/parents/'.$category->id, 'method'=>'post')) !!}

        {!! Form::text('parent','',array('id'=>'parent','class'=>'form-control')) !!}
        <div id=parents>
        @foreach ($category->parents as $item)
                <div id="rowparent{{$item->id}}">
                <a href="/library/edit/{{$dict}}/{{$item->id}}" target="_blank">{{$item->name}}</a>&nbsp;<a class="badge"><span class="glyphicon glyphicon-remove" onclick='deleteParentField({{$item->id}})'></span></a>
                {!! Form::hidden('parent_id[]',$item->id) !!}
                </div>
        @endforeach
        </div>

        {!! Form::submit(trans('library.save'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}
          
{!! Form::close() !!}

<h3 class="form-signin-heading">{{trans('library.children_categories')}}</h3>

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/'.$dict.'/children/'.$category->id, 'method'=>'post')) !!}

        {!! Form::text('parent','',array('id'=>'child','class'=>'form-control')) !!}
        <div id=children>
        @foreach ($category->children as $item)
                <div id="rowchild{{$item->id}}">
                <a href="/library/edit/{{$dict}}/{{$item->id}}" target="_blank">{{$item->name}}</a>&nbsp;<a class="badge"><span class="glyphicon glyphicon-remove" onclick='deleteChildField({{$item->id}})'></span></a>
                {!! Form::hidden('child_id[]',$item->id) !!}
                </div>
        @endforeach
        </div>

        {!! Form::submit(trans('library.save'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}
          
{!! Form::close() !!}

<h3 class="form-signin-heading">{{trans('library.'.$category->element().'s')}}</h3>

{!! Form::open(array('url'=>'/'.(LaravelLocalization::getCurrentLocale()).'/library/edit/'.$dict.'/elements/'.$category->id, 'method'=>'post')) !!}

        
	 {!! Form::text('element','',array('id'=>'element','class'=>'form-control')) !!}
        <div id='elements'>
        @foreach ($category->elements as $item)
                <div id="rowelement{{$item->id}}">
                <a href="/library/edit/{{$category->element()}}/{{$item->id}}" target="_blank">{{$item->short_name()}}</a>&nbsp;<a class="badge"><span class="glyphicon glyphicon-remove" onclick='deleteElementField({{$item->id}})'></span></a>
                {!! Form::hidden('element_id[]',$item->id) !!}
                </div>
        @endforeach
        </div>

        {!! Form::submit(trans('library.save'),array('class'=>'btn btn-lg btn-primary btn-block')) !!}
          
{!! Form::close() !!}

@stop

