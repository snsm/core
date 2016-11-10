<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Tissue extends Model
{
    protected $fillable = [
        'tissue_name',
        'tissue_coding',
        'tissue_type',
        'tissue_class',
        'tissue_id',
    ];



    /*const TYPE_NAME_A = 1;
    const TYPE_NAME_B = 2;


    public static function typeLabelList()
    {
        return [
            self::TYPE_NAME_A => '',
            self::TYPE_NAME_B => ''
        ];
    }

    public function getTypeTextAttribute()
    {
        return empty($this->type) ? '' : self::typeLabelList()[$this->type];
    }*/

}
