<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;
    protected $fillable =[
        'name',
        'image',
        'slug',
        'category_id',
        'short_text',
        'price'     ,
        'size',
        'color',
        'qty',
        'status',
        'content',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category_relation()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}