<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ACategory extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'a_categories';
    protected $fillable = ['name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function authors()
    {
	return $this->belongsToMany('App\Models\Author')->orderby('surname');
    }

    public function elements()
    {
        return $this->authors();                         
    }


    public function hasAuthor($author_id) {
        return ! is_null($this->authors()->where('author_id', $author_id)->first());
    }
        
    public function hasElement($element_id) {
        return $this->hasAuthor($element_id);
    }


    public function element()
    { 
        return 'author';
    }  

    public function parents()
    {
	return $this->belongsToMany('App\Models\ACategory','a_category_a_category','a_category_id','parent_id')->orderby('name');
    }

    public function hasParent($parent_id) {
        return ! is_null($this->parents()->where('parent_id', $parent_id)->first());
    }   

    public function children()
    {  
        return $this->belongsToMany('App\Models\ACategory','a_category_a_category','parent_id','a_category_id')->orderby('name');
    } 

    public function hasChild($child_id) {  
        return ! is_null($this->children()->where('a_category_id', $child_id)->first());
    }   

}
