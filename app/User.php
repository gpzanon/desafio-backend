<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'image'
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

    /**
     * Filter Users
     * 
     * @param Array $data
     * @return Array $results
     */
    public function getResults(Array $data)
    {
        $results = $this->where(function ($query) use ($data) {
            if (isset($data['name']))
                $query->where('name', 'LIKE', "{$data['name']}%");
            
            if (isset($data['cpf']))
                $query->where('cpf', $data['cpf']);

            if (isset($data['email']))
                $query->where('email', $data['email']);
        })
        ->get();

        return $results;
    }
}
