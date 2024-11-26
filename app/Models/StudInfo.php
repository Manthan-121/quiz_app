<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StudInfo extends Model
{
    use HasFactory;

    protected $table = 'stud_info'; // Table name

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'gender',
        'email',
        'mobile',
    ];
}
