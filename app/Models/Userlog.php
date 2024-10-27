<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Userlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'os',
        'browser',
        'country',
        'city',
        'isp',
    ];
}
