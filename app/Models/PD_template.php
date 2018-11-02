<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PD_template extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'p_d_templates';

    protected $fillable = ['name', 'descr'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function books()
    { 
        return $this->hasMany('App\Models\Book');
    } 

    //
}
