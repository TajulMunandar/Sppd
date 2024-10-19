<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    protected $table = 'api_token';
    protected $fillable = ['app_name', 'token'];
}
