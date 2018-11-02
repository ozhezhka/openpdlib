<?php

namespace App\Http\Controllers\Library\Edit;

use App\Models;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class DictionaryController extends Controller
{

    protected $dict='BCategory';
    protected $class='App\Models\BCategory';
    protected $is_descr=false;

    public function autocomplete(Request $request){
	$term = $request->get('term');
	$result = $this->class::whereName($term)->orWhere('name', 'LIKE', '%'.$term.'%')->orderBy('name','asc')->take(5)->get(['id','name as value']);
    return $result;
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$items = $this->class::where('id','>','0')->orderBy('name', 'asc')->get();
	return view('library.edit.dictionaries.index')->with(['dictionary'=>$this->dict,'items'=> $items, 'is_descr'=>$this->is_descr]);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	return view('library.edit.dictionaries.create')->with(['dictionary'=>$this->dict,'is_descr'=>$this->is_descr]);
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
        $items = $this->class::where('id','>','0')->orderBy('name', 'asc')->get();
        return view('library.edit.dictionaries.index')->with(['dictionary'=>$this->dict,'items'=> $items, 'is_descr'=>$this->is_descr, 'id'=>$id]);
    }


    protected function validator(array $data)
    {
	$controlled_fields = [
            'name' => 'required|string|max:255',
        ];
	if ($this->is_descr) $controlled_fields['descr']='string';
        return Validator::make($data, $controlled_fields);
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

	if ($this->class::where('name',$data["name"])->first()==NULL) {
		$item=$this->class::create($data);
	        $item->save();
	}
	
        return redirect('/library/edit/'.$this->dict.'/');
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
       
        $item=$this->class::findOrFail($id);
        $item->fill($data);
        $item->save();
     
        return redirect('/library/edit/'.$this->dict.'/');
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
        if ($id==0) return redirect('/library/edit/'.$this->dict.'/');
        $item = $this->class::findOrFail($id);
	$item->delete();
        return redirect('/library/edit/'.$this->dict.'/');

    }
}
