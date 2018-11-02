<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    protected $fillable = ['name', 'name_orig', 'annotation', 'WD', 'location', 'publisher', 'volume', 'pages', 'terach', 'year', 
'year_firstpub', 'PD_from_year', 'p_d_template_id', 'filename'];
       
    /**
     * The attributes excluded from the model's JSON form.
     * 
     * @var array
     */
    protected $guarded = ['id'];


    public function first_author()
    {
        return $this->belongsToMany('App\Models\Author')->orderby('prior')->first();
    }


    public function authors()
    {
	return $this->belongsToMany('App\Models\Author')->orderby('prior');
    }


    public function hasAuthor($author_id) {
	return ! is_null($this->authors()->where('author_id', $author_id)->first());
    }

    public function categories()
    {
	return $this->belongsToMany('App\Models\BCategory')->orderby('name');
    }

    public function hasCategory($category_id) {
	return ! is_null($this->categories()->where('b_category_id', $category_id)->first());
    }

    public function PD_template() 
    {
	return $this->belongsTo('App\Models\PD_template');
    }

    public function short_name() {
	$ret="";
	foreach($this->authors as $author) $ret.=$author->short_name().", ";
	$ret.=$this->name;
	return $ret;
    }
    //
}
