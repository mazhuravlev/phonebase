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
        $forms = [];
        if (preg_match('/^7/', $this->number)) {
            $p = substr($this->number, 1);
            array_push($forms, $p);
            array_push($forms, '8' . $p);
        }
        return $forms;
    }

}
