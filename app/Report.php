<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /*
      |------------------------------------------------------------------------------------
      | Table
      |------------------------------------------------------------------------------------
      */
      protected $table = 'reports';

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
          'user_id',
          'found_id'
      ];

      protected $appends = ['user', 'found'];

      /*
      |------------------------------------------------------------------------------------
      | Validations
      |------------------------------------------------------------------------------------
      */
      public static function rules($update = false, $id = null)
      {
          $commun = [
              'user_id' => "required",
              'found_id' => "required",
          ];

          if ($update) {
              return $commun;
          }

          return array_merge($commun, [
              'user_id' => "required",
              'found_id' => "required",
          ]);
      }

      /*
      |------------------------------------------------------------------------------------
      | relations
      |------------------------------------------------------------------------------------
      */
      // m:1
      public function user()
      {
          return $this->belongsTo(User::class);
      }

      // m:1
      public function found()
      {
          return $this->belongsTo(Found::class);
      }

      /*
      |------------------------------------------------------------------------------------
      | functions
      |------------------------------------------------------------------------------------
      */
      public function getUserAttribute()
      {
          return User::where('id', $this->user_id)->first();
      }

      public function getFoundAttribute()
      {
          return Found::where('id', $this->found_id)->first();
      }
}
