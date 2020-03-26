<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type'
    ];

    protected $attributes = [
        'type' => '1'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function privilegioDocente($type)
    {   
        if($type == '1' || $type == '3'){
            return true;
        }
        
        return false;

    }

    public static function privilegioDirectivo($type)
    {   
        if($type == '2' || $type == '3'){
            return true;
        }
        
        return false;

    }

    public static function privilegioAdministrador($type)
    {   
        if($type == '3'){
            return true;
        }
        
        return false;

    }

    public static function privilegioDocenteExclusivo($type)
    {   
        if($type == '1'){
            return true;
        }
        
        return false;

    }

    public static function privilegioDirectivoExclusivo($type)
    {   
        if($type == '2'){
            return true;
        }
        
        return false;

    }

}
