<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Tissue extends Model
{
    protected $fillable = [
        'tissue_company_name',
        'tissue_company_coding',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
