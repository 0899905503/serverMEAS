<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBonus extends Model
{
    protected $table = 'employeebonus';

    protected $casts = [
        'manv' => 'int',
        'makhenthuong' => 'int',
        'ngaykhenthuong' => 'datetime',
        'tienthuong' => 'float' // Thêm dòng này
    ];

    protected $fillable = [
        'manv',
        'makhenthuong',
        'lydo',
        'ngaykhenthuong',
        'tienthuong' // Thêm dòng này
    ];
    public function bonus()
    {
        return $this->belongsTo(Bonus::class, 'makhenthuong');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'manv');
    }
}
