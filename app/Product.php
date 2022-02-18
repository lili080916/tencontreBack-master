<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'product', 'brand', 'category_id', 'quantity'
    ];

    protected $appends = ['category'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'product' => "required",
            'category_id' => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'product' => "required",
            'category_id' => "required",
        ]);
    }

    /*
    |------------------------------------------------------------------------------------
    | relations
    |------------------------------------------------------------------------------------
    */
    // 1:m
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // m:1
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*
    |------------------------------------------------------------------------------------
    | functions
    |------------------------------------------------------------------------------------
    */
    public function getCategoryAttribute()
    {
        return Category::where('id', $this->category_id)->first();
    }
}
