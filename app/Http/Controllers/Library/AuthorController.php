<?php

namespace App\Http\Controllers\Library;

use App\Models\Author;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class AuthorController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$authors = Author::where('id','>','0')->orderBy('surname', 'asc')->get();
	return view('library.authors.authors')->with('authors', $authors);
    }


    /**
     * Display a surname-alphabet listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexalpha_surname()
    {
        $authors =  Author::where('id','>','0')->orderBy('surname', 'asc')->get();
        $authorsalpha=array();
        foreach ($authors as $author) {
                $firstletter=mb_substr(trim($author->surname),0,1);
                $firstletter.="...";
                if (!isset($authorsalpha[$firstletter])) $authorsalpha[$firstletter]=array();
                $authorsalpha[$firstletter][]=$author;
        }
        return view('library.authors.authorsalpha')->with('authorsalpha', $authorsalpha);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id=intval($id);
        if ($id==0) return redirect('/');
        $author = Author::findOrFail($id);
        return view('library.authors.author')->with('author', $author);
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
	if (isset($data['surname'])&&$data['surname']!='') {
		$authors = Author::where('surname', 'LIKE', '%'.$data['surname'].'%')->orderBy('surname', 'asc')->get();
	        return view('library.authors.authors')->with('authors', $authors);
	}
	else return redirect('/');
   }

}
