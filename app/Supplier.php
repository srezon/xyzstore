<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

}

