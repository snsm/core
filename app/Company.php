<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companys';

    protected $fillable = [
        'company_name',
        'company_coding',
        'insurance_type_id',
        'parent_id',
        'company_order',
        'insurance_id',
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
