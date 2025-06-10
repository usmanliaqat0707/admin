<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipApplication extends Model
{
    /** @use HasFactory<\Database\Factories\MentorshipApplicationFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'email',
        'is_eligible',
        'username',
        'password',
    ];
}
