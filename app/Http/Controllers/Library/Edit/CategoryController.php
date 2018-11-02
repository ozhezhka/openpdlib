<?php

namespace App\Http\Controllers\Library\Edit;

use App\Models;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CategoryController extends DictionaryController
{

    protected $dict='BCategory';
    protected $class='App\Models\BCategory';
    protected $is_descr=false;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function show($id)
    {  
       $id=intval($id);
       if ($id==0) return redirect('/library/edit/');
       $Category = $this->class::findOrFail($id);
       return view('library.edit.dictionaries.category')->with(['category'=>$Category,'dict'=>$this->dict]);
    }

    public function parents(Request $request, $id)
    {
     
        $id = intval($id);
        if ($id==0) return redirect('/library/edit/');
	$data=$request->all();

	$Category=$this->class::findOrFail($id);
	$Category->parents()->detach();
	if (isset($data["parent_id"])&&is_array($data["parent_id"]))
                foreach ($data["parent_id"] as $parent_id) {
                        $parent_id=intval($parent_id);
                        if ($parent_id>0&&!$Category->hasParent($parent_id)) $Category->parents()->attach($parent_id);
                        }
          
	return redirect('/library/edit/'.$this->dict.'/'.$id);
    }

    public function children(Request $request, $id)
    {
     
        $id = intval($id);
        if ($id==0) return redirect('/library/edit/');
	$data=$request->all();

	$Category=$this->class::findOrFail($id);
	$Category->children()->detach();
	if (isset($data["child_id"])&&is_array($data["child_id"]))
                foreach ($data["child_id"] as $child_id) {
                        $child_id=intval($child_id);
                        if ($child_id>0&&!$Category->hasChild($child_id)) $Category->children()->attach($child_id);
                        }
          
	return redirect('/library/edit/'.$this->dict.'/'.$id);
    }

    public function elements(Request $request, $id)
    {
     
        $id = intval($id);
        if ($id==0) return redirect('/library/edit/');
	$data=$request->all();

	$Category=$this->class::findOrFail($id);
	$Category->elements()->detach();
	if (isset($data["element_id"])&&is_array($data["element_id"]))
                foreach ($data["element_id"] as $element_id) {
                        $element_id=intval($element_id);
                        if ($element_id>0&&!$Category->hasElement($element_id)) $Category->elements()->attach($element_id);
                        }
          
	return redirect('/library/edit/'.$this->dict.'/'.$id);
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
        if (sizeof($item->elements)==0&&sizeof($item->children)==0) $item->delete();
        return redirect('/library/edit/'.$this->dict.'/');

    }


}

