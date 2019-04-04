<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subcategories';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category_id'];

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }    

    public function products()
    {
        return $this->hasMany('App\Product');
    }   
    
}
