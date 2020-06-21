<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'body',
        'price',
        'slug'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getFormatPriceAttribute()
    {
        return 'R$ ' . number_format($this->price, 2, ',', '.');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

}
