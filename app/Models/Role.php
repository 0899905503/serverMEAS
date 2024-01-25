<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Discipline
 * 
 * @property int $machucvu
 * @property string $tenchucvu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Role extends Model
{

    protected $table = 'roles';
    protected $primaryKey = 'machucvu';

    protected $fillable = [
        'tenchucvu'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'machucvu');
    }
}
