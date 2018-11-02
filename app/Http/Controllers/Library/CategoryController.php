<?php

namespace App\Http\Controllers\Library;

use App\Models;
use Validator;
use Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CategoryController
{

    protected $dict='BCategory';
    protected $class='App\Models\BCategory';
    protected $is_descr=false;

    /**
     * Display all alphabet-listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index0()
    {

        $items = $this->class::where('id','>','0')->orderBy('name', 'asc')->get();
        $itemsalpha=array();
        foreach ($items as $item) {
                $firstletter=mb_substr(trim($item->name),0,1);
                $firstletter.="...";
                if (!isset($itemsalpha[$firstletter])) $itemsalpha[$firstletter]=array();
                $itemsalpha[$firstletter][]=$item;
        }
        return view('library.category0')->with(['dictionary'=>$this->dict,'itemsalpha'=> $itemsalpha, 'is_descr'=>$this->is_descr]);
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
       if ($id==0) return redirect('/'.$this->dict);
       $Category = $this->class::findOrFail($id);
       return view('library.category')->with(['category'=>$Category,'dict'=>$this->dict]);
    }

}

