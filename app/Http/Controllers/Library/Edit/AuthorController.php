<?php

namespace App\Http\Controllers\Library\Edit;

use App\Models\Author;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class AuthorController extends Controller
{

    public function autocomplete(Request $request){
        $term = $request->get('term');
        $authors = Author::where('surname',$term)->orWhere('surname', 'LIKE', '%'.$term.'%')->orderBy('surname','asc')->take(5)->get();
	$result=array();
	foreach ($authors as $author) $result[]=["id"=>$author->id, "value"=>$author->short_name()];
    return $result;
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$authors = Author::where('id','>','0')->orderBy('surname', 'asc')->get();
	return view('library.edit.authors.authors')->with('authors', $authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	return view('library.edit.authors.create');
    }


    protected function validator(array $data)
    { 
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'patronimic' => 'string|max:255|nullable',
            'surname' => 'required|string|max:255',
            'birth_year' => 'digits_between:1,4|nullable',
            'death_year' => 'digits_between:1,4||nullable',
            'repressed' => 'boolean',
            'rehabilitated_year' => 'digits_between:1,4|nullable',
	    'WD' => 'string|max:255|nullable',
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

	$author=Author::create($data);
        $author->save();
	
        if (isset($data["category_id"])&&is_array($data["category_id"])) {
                foreach ($data["category_id"] as $category_id) {
                        $category_id=intval($category_id);
                        if ($category_id>0&&!$author->hasCategory($category_id)) $author->categories()->attach($category_id);
                        }
        }


        return redirect('/library/edit/author/'.($author->id).'/edit');
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
	if (isset($data['surname'])&&$data['surname']!='') {
		$authors = Author::where('surname', 'LIKE', '%'.$data['surname'].'%')->orderBy('surname', 'asc')->get();
	        return view('library.edit.authors.authors')->with('authors', $authors);
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
	if ($id==0) return redirect('/library/edit/');
	$author = Author::findOrFail($id);
        return view('library.edit.authors.update')->with('author', $author);
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

        $author=Author::findOrFail($id);
	$author->fill($data);
        $author->save();

        $author->categories()->detach();
        if (isset($data["category_id"])&&is_array($data["category_id"]))
                foreach ($data["category_id"] as $category_id) {
                        $category_id=intval($category_id);
                        if ($category_id>0&&!$author->hasCategory($category_id)) $author->categories()->attach($category_id);
                        }


        return redirect('/library/edit/author/'.($author->id).'/edit');
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
        $author = Author::findOrFail($id);
	if (sizeof($author->books)==0) {
	        $author->categories()->detach();
		$author->delete();
		}
        return redirect('/library/edit/author');
    }
}
