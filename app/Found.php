<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Found extends Model
{
    /*
      |------------------------------------------------------------------------------------
      | Table
      |------------------------------------------------------------------------------------
      */
      protected $table = 'founds';

      /*
      |------------------------------------------------------------------------------------
      | Primary Key
      |------------------------------------------------------------------------------------
      */
      protected $primaryKey = 'id';

      /*
      |------------------------------------------------------------------------------------
      | Attributes
      |------------------------------------------------------------------------------------
      */
      protected $fillable = [
          'id',
          'product_id',
          'longitude',
          'latitude',
          'quantity',
          'status',
          'image',
          'description',
          'first',
          'last'
      ];

      protected $appends = ['product'];

      /*
      |------------------------------------------------------------------------------------
      | Validations
      |------------------------------------------------------------------------------------
      */
      public static function rules($update = false, $id = null)
      {
          $commun = [
              'product_id' => "required",
              'longitude' => "required",
              'latitude' => "required",
              'status' => "required",
          ];

          if ($update) {
              return $commun;
          }

          return array_merge($commun, [
              'product_id' => "required",
              'longitude' => "required",
              'latitude' => "required",
              'status' => "required",
          ]);
      }

      /*
      |------------------------------------------------------------------------------------
      | relations
      |------------------------------------------------------------------------------------
      */
      // m:1
      public function product()
      {
          return $this->belongsTo(Product::class);
      }

      // 1:m
      public function reports()
      {
          return $this->hasMany(Reports::class);
      }

      /*
      |------------------------------------------------------------------------------------
      | functions
      |------------------------------------------------------------------------------------
      */
      public function getProductAttribute()
      {
          return Product::where('id', $this->product_id)->first();
      }
}
