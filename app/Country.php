<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Notifications\Notifiable;


class Country extends Model
{
//    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cc_fips', 'cc_iso', 'tld', 'country_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
