<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

  
    protected $fillable = [
        'name',
        'description',
        'voltage',
        'material',
        'department',
        'brand_id',
        'price'
    ];

    protected $with = ['brand'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


}
