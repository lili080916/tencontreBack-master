<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*
      |------------------------------------------------------------------------------------
      | Table
      |------------------------------------------------------------------------------------
      */
      protected $table = 'categories';

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
          'category'
      ];

      /*
      |------------------------------------------------------------------------------------
      | Validations
      |------------------------------------------------------------------------------------
      */
      public static function rules($update = false, $id = null)
      {
          $commun = [
              'category' => "required",
          ];

          if ($update) {
              return $commun;
          }

          return array_merge($commun, [
              'category' => "required",
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

      /*
      |------------------------------------------------------------------------------------
      | functions
      |------------------------------------------------------------------------------------
      */
}
