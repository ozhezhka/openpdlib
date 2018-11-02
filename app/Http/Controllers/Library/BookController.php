<?php

namespace App\Http\Controllers\Library;

use App\Models\Book;
use App\Models\PD_template;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use File;

class BookController extends Controller
{


    protected $path='/www/openpdlib/storage/app/public/books/';  // абсолютный путь к книгам библиотеки

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$books = Book::where('id','>','0')->orderBy('name', 'asc')->get();
	return view('library.books.books')->with('books', $books);
    }


    public function indexlast()
    {
	$books = Book::where('id','>','0')->order_by('created_at','desc')->limit(10)->get();
	return view('library.books.books')->with('books', $books);
    }


    /**
     * Display a name-alphabet listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexalpha_name()
    {
	$books = Book::where('id','>','0')->orderBy('name', 'asc')->get();
	$booksalpha=array();
	foreach ($books as $book) {
		$firstletter=mb_substr(trim($book->name),0,1);
		$firstletter.="...";
		if (!isset($booksalpha[$firstletter])) $booksalpha[$firstletter]=array();
		$booksalpha[$firstletter][]=$book;
	}
	return view('library.books.booksalpha')->with('booksalpha', $booksalpha);
    }

    /**
     * Display an author-alphabet listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexalpha_author()
    {
	$books = Book::where('id','>','0')->orderBy('name', 'asc')->get();
	$books=$books->sortBy(function ($book) {
	  return ($author = $book->first_author()) ? $author->surname : null;
	  });

	$booksalpha=array();
	foreach ($books as $book) {
		$author=$book->first_author();
		$firstletter="";
		if ($author!=null) $firstletter=mb_substr(trim($author->surname),0,1);
		$firstletter.="...";
		if (!isset($booksalpha[$firstletter])) $booksalpha[$firstletter]=array();
		$booksalpha[$firstletter][]=$book;
	}
	return view('library.books.booksalpha')->with('booksalpha', $booksalpha);
    }


    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id=intval($id);
        if ($id==0) return redirect('/');
        $book = Book::findOrFail($id);
        return view('library.books.book')->with(['book'=>$book]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postFind(Request $request)
    {
        $data=$request->all();
        if (isset($data['name'])&&$data['name']!='') {
                $books = Book::where('name', 'LIKE', '%'.$data['name'].'%')->orderBy('name', 'asc')->get();
                return view('library.books.books')->with('books', $books);
        }
        else return redirect('/');
   }

   public function download($id){ 
	$id=intval($id);
        if ($id==0) return redirect('/');
        $book = Book::findOrFail($id);
    	$pathToFile=$this->path.($book->filename);
    	return response()->download($pathToFile);           
   }
}
