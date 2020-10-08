<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'first_name', 'lastname', 'companies_id', 'email', 'phone'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Companies','companies_id');
    }
}
