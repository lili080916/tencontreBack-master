<?php
# @Author: Codeals
# @Date:   19-10-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 26-11-2019
# @Copyright: Codeals

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin', 'status', 'accumulated', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'name' => "required",
            'email' => "required",
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'name' => "required",
            'email' => "required",
        ]);
    }

    /**
     * Relation with Token and User
     */
    public function token()
    {
        return $this->hasMany('App\Token');
    }

    /*
    |------------------------------------------------------------------------------------
    | relations
    |------------------------------------------------------------------------------------
    */
    // 1:m
    public function reports()
    {
        return $this->hasMany(Reports::class);
    }

    // 1:m
    public function favorites()
    {
        return $this->hasMany(Favorites::class);
    }

    // 1:m
    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    // 1:m
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /*
    |------------------------------------------------------------------------------------
    | functions
    |------------------------------------------------------------------------------------
    */
    /**
     * get Social
     */
    public function getSocial()
    {
        $user = $this->id;
        $social = Social::where('user_id', $user)->first();

        return $social;
    }

}
