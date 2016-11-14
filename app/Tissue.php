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
        'parent_id',
        'tissue_level',
        'tissue_order',
    ];



    const TYPE_NAME_A = 10;
    const TYPE_NAME_B = 20;


    public static function typeLabelList()
    {
        return [
            self::TYPE_NAME_A => '公司机构',
            self::TYPE_NAME_B => '出单机构'
        ];
    }

    public function getTypeTextAttribute()
    {
        return empty($this->tissue_type) ? '' : self::typeLabelList()[$this->tissue_type];
    }

}
