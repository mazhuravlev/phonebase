<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public $fillable = [
        'number'
    ];

    public function phoneInfos()
    {
        return $this->hasMany(PhoneInfo::class);
    }

}
