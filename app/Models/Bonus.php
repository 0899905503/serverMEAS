<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;
    protected $table = 'bonus';
    protected $fillable = ['hinhthuc'];

    public function bonus()
    {
        return $this->hasMany(EmployeeBonus::class, 'makhenthuong');
    }
}
