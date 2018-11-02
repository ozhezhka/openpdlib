<!DOCTYPE html>
<html>
    <head>
        <title>OpenPDLib</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- jQuery & jQuery UI -->

        <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="/js/jquery-ui.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="/css/jquery-ui.css"> 

        <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>

	<link href="/css/dashboard.css" rel="stylesheet">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="/js/html5shiv.js" type="text/javascript"></script>
        <script src="/js/respond.min.js" type="text/javascript"></script>
        <![endif]-->
        @yield('headExtra')
    </head>


<body>
<div class="navbar navbar-fixed-top" role="navigation">
      <div class="container-fluid">
	<div class="row">
<table width=100% border=1 cellspacing=0 cellpadding=0 style="border-collapse: collapse; border: 1px solid #083a62">
<tr><td colspan=2 background=/images/bg1.gif>
        <table border=0 cellspacing=0 cellpadding=0 width=100%>
        <tr><td rowspan=2><img src="/images/null.gif" height=105 width=1></td><td align=center><h1>{{trans('total.openpdlib')}}</h1>
</td></tr></table></td></tr></table>
	</div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse">

	    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a class="nav navbar-nav navbar-left" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
		<img border=0 alt="{{ $properties['native'] }}" src="/images/{{ $localeCode }}.png" vspace=9 hspace=10></a>
    	    @endforeach


                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

		    <li><a href="/">{{trans('total.home')}}</a></li>
		    <li><a href="/about">{{trans('total.about')}}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                           {{trans('total.books')}} <span class="caret"></span>
                        </a>
                        
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/booksalphaname">{{trans('total.by_name')}}</a></li>
                            <li><a href="/booksalphaauthor">{{trans('total.by_author')}}</a></li>
                            <li><a href="/BCategory">{{trans('total.by_categories')}}</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                           {{trans('total.authors')}} <span class="caret"></span>
                        </a>
                        
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/authorsalpha">{{trans('total.by_surname')}}</a></li>
                            <li><a href="/ACategory">{{trans('total.by_categories')}}</a></li>
                        </ul>
                    </li>



            @if (Auth::check() && Auth::user()->status=="admin")
            <li><a href="/admin">{{trans("admin.panel")}}</a></li>
            @endif
            @if (Auth::check() && (Auth::user()->status=="admin"||Auth::user()->status=="user"))
            <li><a href="/library/edit">{{trans("library.library_edit")}}</a></li>
            @endif

	  </ul>

                    @if (!Auth::check())
             <span class='nav navbar-nav navbar-right'><a href="/login" class='btn btn-link btn-lg' role='button'><span class="glyphicon glyphicon-log-in"></span></a></span>
                    @else
             <span class='nav navbar-nav navbar-right'><a href="/logout" class='btn btn-link btn-lg' role='button'><span class="glyphicon glyphicon-log-out"></span></a></span>
                    @endif


<!--          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>-->
        </div>
      </div>
    </div>

<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
{{--
{!! View::make('widgets.mainmenu')->with(['branch'=>(isset($branch)?$branch:0)]) !!}
--}}
	</div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h1 class="page-header">@yield('title')</h1>
		@yield('content')

	</div>
</div>

<div id="footer">
      <div class="container">
        <p class="text-muted"><p><span class="copy-left">&copy;</span> <a href=http://openpdlib.krc.karelia.ru>{{trans('total.openpdlib')}}</a></p>
      </div>
    </div>
</body></html>
