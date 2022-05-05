<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "roles";
     
    protected $fillable = [
        'tipo','created_at','updated_at','active'
    ];

     public static function scopeSearch($query, $search)
    {
        if (trim($search) != ""){ 
        return $query->where('tipo', 'like', "%$search%")

        ;
    }
}
    
}
