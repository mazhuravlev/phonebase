<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneInfo extends Model
{

    public $fillable = [
        'data', 'source_id', 'id_source'
    ];
    protected $touches = [
        'phone'
    ];

    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }


}
