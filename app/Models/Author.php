<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authors';

    protected $fillable = ['name', 'patronimic', 'surname', 'birth_year', 'death_year', 'repressed', 'rehabilitated_year', 'WD'];

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

    public function categories()
    {
        return $this->belongsToMany('App\Models\ACategory')->orderby('name');
    }

    public function hasCategory($category_id) {
        return ! is_null($this->categories()->where('a_category_id', $category_id)->first());
    }

    public function short_name() {
	return $this->surname.($this->name>""?" ".mb_substr($this->name,0,1,"UTF-8").".":"").($this->patronimic>""?" ".mb_substr($this->patronimic,0,1,"UTF-8").".":"");
    }

}
