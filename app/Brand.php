<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;

class Brand extends Model
{
    protected $table = 'brands';


    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'brand_id');
    }

    
}
