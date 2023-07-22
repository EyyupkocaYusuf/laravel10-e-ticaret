<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{

    use Sluggable;
    protected $fillable = [
        'name',
        'image',
        'thumbnail',
        'cat_ust',
        'content',
        'status',
        'slug',
    ];

    public function product_relation()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class,'cat_ust','id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','cat_ust');
    }

    public function getTotalProductCount()
    {
        $total = $this->product_relation()->count();

        foreach ($this->subcategory as $childcategory)
        {
            $total += $childcategory->product_relation()->count();
        }

        return $total;
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


}
