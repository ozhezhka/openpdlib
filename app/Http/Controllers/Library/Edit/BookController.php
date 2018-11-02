<?php

namespace App\Http\Controllers\Library\Edit;

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

    public function autocomplete(Request $request){
        $term = $request->get('term');
        $books = Book::where('name',$term)->orWhere('name', 'LIKE', '%'.$term.'%')->orderBy('name','asc')->take(5)->get();
        $result=array();
        foreach ($books as $book) $result[]=["id"=>$book->id, "value"=>$book->short_name()];
    return $result;
}


    protected $path='/www/openpdlib/storage/app/public/books/';  // абсолютный путь к книгам библиотеки

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$books = Book::where('id','>','0')->orderBy('name', 'asc')->get();
	return view('library.edit.books.books')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	return view('library.edit.books.create');
    }


    protected function validator(array $data)
    { 
        return Validator::make($data, [
            'name' => 'required|string',
            'name_orig' => 'string|nullable',
            'WD' => 'string|max:255|nullable',
            'location' => 'string|max:255|nullable',
            'publisher' => 'string|max:255|nullable',
            'year' => 'digits_between:1,4|nullable',
	    'volume' => 'numeric|nullable',
	    'pages' => 'numeric|nullable',
	    'terach' => 'numeric|nullable',
            'year_firstpub' => 'digits_between:1,4||nullable',
            'PD_from_year' => 'digits_between:1,4||nullable',
	    'annotation' => 'string|nullable',
	    'PD_template' => 'string|max:255|nullable',
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

	$data=$request->all();
	$this->validator($data)->validate();


	if (isset($data["PD_template"])&&$data["PD_template"]>"") {
		$PD_template=PD_template::where('name',$data["PD_template"])->first();
		if ($PD_template==NULL) {
			$PD_template=PD_template::create(["name"=>$data["PD_template"]]);
			$PD_template->save();
		}
		$data["p_d_template_id"]=$PD_template->id;
		unset($data["PD_template"]);
	}

        if ($file=$request->file()) {
                $data["filename"]=time().'_'.$file["file"]->getClientOriginalName();
                $file["file"]->move($this->path,$data["filename"]);
        }

	$book=Book::create($data);
        $book->save();

	if (isset($data["author_id"])&&is_array($data["author_id"])) {
		$prior=0;
		foreach ($data["author_id"] as $author_id) {
			$author_id=intval($author_id); 
                        if ($author_id>0&&!$book->hasAuthor($author_id)) {
				$book->authors()->attach($author_id, ['prior'=>$prior]);
				$prior++;
				}
			}
	}


	if (isset($data["category_id"])&&is_array($data["category_id"])) {
		foreach ($data["category_id"] as $category_id) {
			$category_id=intval($category_id); 
                        if ($category_id>0&&!$book->hasCategory($category_id)) $book->categories()->attach($category_id);
			}
	}
	
        return redirect('/library/edit/book/'.($book->id).'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
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
                return view('library.edit.books.books')->with('books', $books);
        }
        else return redirect('/library/edit/');
   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id=intval($id);
        if ($id==0) return redirect('/library/edit');
        $book = Book::findOrFail($id);
        return view('library.edit.books.update')->with(['book'=>$book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

	$id = intval($id);
	if ($id==0) return redirect('/library/edit/');

        $data=$request->all();
        $this->validator($data)->validate();

        $book=Book::findOrFail($id);

        if (isset($data["PD_template"])&&$data["PD_template"]>"") {
                $PD_template=PD_template::where('name',$data["PD_template"])->first();
                if ($PD_template==NULL) {
                        $PD_template=PD_template::create(["name"=>$data["PD_template"]]);
                        $PD_template->save();
                }
                $data["p_d_template_id"]=$PD_template->id;
                unset($data["PD_template"]);
        }       

        if ($file=$request->file()) {
		if (trim($book->filename)>"") File::delete($this->path.$book->filename);
                $data["filename"]=time().'_'.$file["file"]->getClientOriginalName();
                $file["file"]->move($this->path,$data["filename"]);
        }

	$book->fill($data);
        $book->save();

	$book->authors()->detach();
        if (isset($data["author_id"])&&is_array($data["author_id"])) {
		$prior=0;
                foreach ($data["author_id"] as $author_id) {
                        $author_id=intval($author_id);
                        if ($author_id>0&&!$book->hasAuthor($author_id)) {
				$book->authors()->attach($author_id,['prior'=>$prior]);
				$prior++;
				}
                        }
	}

	$book->categories()->detach();
        if (isset($data["category_id"])&&is_array($data["category_id"])) 
                foreach ($data["category_id"] as $category_id) {
                        $category_id=intval($category_id);
                        if ($category_id>0&&!$book->hasCategory($category_id)) $book->categories()->attach($category_id);
                        }
	        

        return redirect('/library/edit/book/'.($book->id).'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=intval($id);
        if ($id==0) return redirect('/library/edit/');
        $book = Book::findOrFail($id);
	if (trim($book->filename)>"") File::delete($this->path.$book->filename);
	$book->authors()->detach();
	$book->categories()->detach();
	$book->delete();
        return redirect('/library/edit/book');
    }
}
