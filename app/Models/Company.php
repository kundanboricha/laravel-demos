<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company_type',
        'gender',
        'interests', // optional if you're storing it as JSON
        'image',
    ];

    protected $casts = [
        'interests' => 'array', // convert JSON to array automatically
    ];
}
