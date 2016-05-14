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

    public function forms()
    {
        if (preg_match('/^7/', $this->number)) {
            $p = substr($this->number, 1);
            return [$p, '8' . $p];
        } elseif (preg_match('/^380/', $this->number)) {
            return [substr($this->number, 2)];
        } else {
            return [];
        }
    }

}
