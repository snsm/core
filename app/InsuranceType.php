<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class InsuranceType extends Model
{
    protected $fillable = [
        'insurance_type_name',
        'insurance_type_coding',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
