<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'location',
        'latitude',
        'longitude',
        'email',
        'phone',
        'web',
        'zip',
        'address',
        'neighborhood',
        'municipality',
        'city',
        'country',
        'start_time',
        'end_time',
        'logo'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'location' => "required",
            'latitude' => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'location' => "required",
            'latitude' => "required",
        ]);
    }

    /*
    |------------------------------------------------------------------------------------
    | relations
    |------------------------------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------------------------------
    | functions
    |------------------------------------------------------------------------------------
    */
    
}
