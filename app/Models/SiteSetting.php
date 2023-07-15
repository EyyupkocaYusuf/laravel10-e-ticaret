<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    //protected $table = 'sitesettings';
    protected $fillable = [
        'name',
        'data',
    ];
}
