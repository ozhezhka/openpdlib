<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BCategory extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'b_categories';

    protected $fillable = ['name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function books()
    {
	return $this->belongsToMany('App\Models\Book')->orderby('name');
    }

    public function elements()
    {
	return $this->books();
    }

    public function hasBook($book_id) {
        return ! is_null($this->books()->where('book_id', $book_id)->first());
    }

    public function hasElement($element_id) {
        return $this->hasBook($element_id);
    }

    public function element()
    {
	return 'book';
    }


    public function parents()
    {
	return $this->belongsToMany('App\Models\BCategory','b_category_b_category','b_category_id','parent_id')->orderby('name');
    }

    public function hasParent($parent_id) {
        return ! is_null($this->parents()->where('parent_id', $parent_id)->first());
    }

    public function children()
    {  
        return $this->belongsToMany('App\Models\BCategory','b_category_b_category','parent_id','b_category_id')->orderby('name');
    } 

    public function hasChild($child_id) {
        return ! is_null($this->children()->where('b_category_id', $child_id)->first());
    }

}
