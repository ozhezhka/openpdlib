<h3>{!!trans('total.last_books')!!}</h3>

<ul>
@forelse ($config['books'] as $book)


<li>@foreach($book->authors as $author)
<a href="/author/{{$author->id}}">{{ $author->short_name() }}</a>,
@endforeach
<a href="/book/{{$book->id}}">{{ $book->name }}</a>. - {{ $book->location }}: {{ $book->publisher }},
{{ $book->year }}. - {{ $book->pages }} {{trans("library.p")}}
</li>

@empty

@endforelse
</ul>

