<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $casts = [
        'manv' => 'int',

    ];

    protected $fillable = [
        'manv',
        'department'

    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'manv');
    }
}
