<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DishCategory extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
