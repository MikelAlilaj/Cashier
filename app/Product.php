<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        return asset('storage/image/'.$value);
    }

//    protected $location = '/storage/image/';
//    public function getImageAttribute($image){
//        if ($image) {
//            return $this->location.$image;
//        }
//
//    }
}
